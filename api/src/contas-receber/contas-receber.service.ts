import {
  BadRequestException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { mergeWhereAnd } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  modoListagemCrudNovo,
  parseJsonFiltroRefinado,
  parsePaginaETamanhoPagina,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarContasReceberDto } from './dto/atualizar-contas-receber.dto';
import { CriarContasReceberDto } from './dto/criar-contas-receber.dto';

const APP = 'infotime-web';
const IP_MAX = 50;
/** Situação “Pago” no legado Scriptcase (RN-03). */
const ID_SITUACAO_DOCUMENTO_PAGO = 4n;
/** Situação “Pago parcial” (Infolab) — mesmas validações de recebimento que o pago. */
const ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL = 24n;

const selectLista = {
  id_lancamento_receita: true,
  id_tipo_agente: true,
  id_cliente: true,
  id_fornecedor: true,
  id_colaborador: true,
  data_previsao: true,
  valor_previsao: true,
  valor_original: true,
  data_realizacao: true,
  valor_realizacao: true,
  id_tipo_especie: true,
  historico: true,
  data_competencia: true,
  id_conta_caixa: true,
  id_situacao_documento: true,
  id_empresa: true,
  id_plano_conta: true,
  id_nota_fiscal: true,
  nota_fiscal: true,
  data_baixa: true,
  data_inclusao: true,
  numero_documento: true,
  parcela: true,
  unidade_origem: true,
  usuario_externo: true,
  infotime_cliente: {
    select: { nome_fantasia: true, cnpj: true, razao_social: true },
  },
  infotime_fornecedor: {
    select: { nome_fantasia: true, cnpj: true },
  },
} as const satisfies Prisma.infotime_lancamento_receitaSelect;

export type ContasReceberListaItemDto = Record<string, unknown>;

@Injectable()
export class ContasReceberService {
  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private apenasDigitos(s: string | null | undefined): string {
    if (!s) return '';
    return s.replace(/\D/g, '');
  }

  private decParaJson(v: Prisma.Decimal | null | undefined): string | null {
    if (v == null) return null;
    return v.toString();
  }

  private parseDataHoraOpcional(
    s: string | undefined,
    nomeCampo: string,
  ): Date | null {
    if (s == null || s.trim() === '') return null;
    const d = new Date(s);
    if (Number.isNaN(d.getTime())) {
      throw new BadRequestException(`${nomeCampo}: data ou data/hora inválida.`);
    }
    return d;
  }

  private parseDataObrigatoria(s: string | undefined, nomeCampo: string): Date {
    const d = this.parseDataHoraOpcional(s, nomeCampo);
    if (!d) {
      throw new BadRequestException(`${nomeCampo}: obrigatório.`);
    }
    return d;
  }

  private parseDecimalOpcional(
    s: string | undefined,
    nomeCampo: string,
  ): Prisma.Decimal | null {
    if (s == null || s.trim() === '') return null;
    try {
      return new Prisma.Decimal(s.replace(',', '.').trim());
    } catch {
      throw new BadRequestException(`${nomeCampo}: valor numérico inválido.`);
    }
  }

  private parseDecimalObrigatorio(
    s: string | undefined,
    nomeCampo: string,
  ): Prisma.Decimal {
    const v = this.parseDecimalOpcional(s, nomeCampo);
    if (v == null) {
      throw new BadRequestException(`${nomeCampo}: obrigatório.`);
    }
    return v;
  }

  private parseBigIntOpcional(
    s: string | undefined,
    nomeCampo: string,
  ): bigint | null {
    if (s == null || s.trim() === '') return null;
    try {
      return BigInt(s.trim());
    } catch {
      throw new BadRequestException(`${nomeCampo}: identificador inválido.`);
    }
  }

  private parseBigIntObrigatorio(
    s: string | undefined,
    nomeCampo: string,
  ): bigint {
    const v = this.parseBigIntOpcional(s, nomeCampo);
    if (v == null) {
      throw new BadRequestException(`${nomeCampo}: obrigatório.`);
    }
    return v;
  }

  private parseDataDeFiltro(val: unknown): Date | null {
    if (val == null) return null;
    if (val instanceof Date && !Number.isNaN(val.getTime())) return val;
    if (typeof val === 'string' || typeof val === 'number') {
      const d = new Date(val);
      return Number.isNaN(d.getTime()) ? null : d;
    }
    return null;
  }

  private async idsColaboradorNomeOuCpfContem(
    idTenacidade: bigint,
    q: string,
    modo: 'nome' | 'cpf',
  ): Promise<bigint[]> {
    const t = q.trim();
    if (!t) return [];
    const esc = t.replace(/\\/g, '\\\\').replace(/%/g, '\\%').replace(/_/g, '\\_');
    const like = `%${esc}%`;
    if (modo === 'nome') {
      const rows = await this.prisma.$queryRaw<{ id: bigint }[]>`
        SELECT id_colaborador AS id FROM infotime_colaborador
        WHERE id_tenacidade = ${idTenacidade}
          AND COALESCE(nome, '') ILIKE ${like}
        LIMIT 300
      `;
      return rows.map((r) => r.id);
    }
    const digitos = this.apenasDigitos(t);
    if (!digitos) return [];
    const rows = await this.prisma.$queryRaw<{ id: bigint }[]>`
      SELECT id_colaborador AS id FROM infotime_colaborador
      WHERE id_tenacidade = ${idTenacidade}
        AND regexp_replace(COALESCE(cpf, ''), '[^0-9]', '', 'g') LIKE ${'%' + digitos + '%'}
      LIMIT 300
    `;
    return rows.map((r) => r.id);
  }

  private whereCampoPesquisa(
    idTenacidade: bigint,
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infotime_lancamento_receitaWhereInput {
    const q = qTexto.trim();
    const contains = { contains: q, mode: Prisma.QueryMode.insensitive } as const;
    switch (campoPesquisa) {
      case 'historico':
        return { historico: contains };
      case 'numeroDocumento':
        return { numero_documento: contains };
      case 'idLancamentoReceita':
        try {
          return { id_lancamento_receita: BigInt(q) };
        } catch {
          return {};
        }
      case 'idNotaFiscal':
        try {
          return { id_nota_fiscal: BigInt(q) };
        } catch {
          return {};
        }
      default:
        return {};
    }
  }

  private async whereCampoPesquisaAsync(
    idTenacidade: bigint,
    campoPesquisa: string,
    qTexto: string,
  ): Promise<Prisma.infotime_lancamento_receitaWhereInput> {
    const q = qTexto.trim();
    const contains = { contains: q, mode: Prisma.QueryMode.insensitive } as const;
    if (campoPesquisa === 'nomeAgente') {
      const idsCol = await this.idsColaboradorNomeOuCpfContem(
        idTenacidade,
        q,
        'nome',
      );
      const partes: Prisma.infotime_lancamento_receitaWhereInput[] = [
        { infotime_cliente: { nome_fantasia: contains } },
        { infotime_cliente: { razao_social: contains } },
        { infotime_fornecedor: { nome_fantasia: contains } },
      ];
      if (idsCol.length > 0) {
        partes.push({ id_colaborador: { in: idsCol } });
      }
      return { OR: partes };
    }
    if (campoPesquisa === 'cnpjCpf') {
      const idsCol = await this.idsColaboradorNomeOuCpfContem(
        idTenacidade,
        q,
        'cpf',
      );
      const partes: Prisma.infotime_lancamento_receitaWhereInput[] = [
        { infotime_cliente: { cnpj: contains } },
        { infotime_fornecedor: { cnpj: contains } },
      ];
      if (idsCol.length > 0) {
        partes.push({ id_colaborador: { in: idsCol } });
      }
      return { OR: partes };
    }
    return this.whereCampoPesquisa(idTenacidade, campoPesquisa, qTexto);
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infotime_lancamento_receitaWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'historico',
      'numeroDocumento',
      'idEmpresa',
      'idTipoAgente',
      'idPlanoConta',
      'idContaCaixa',
      'idTipoEspecie',
      'idSituacaoDocumento',
      'idNotaFiscal',
      'dataCompetencia',
      'dataInclusao',
      'dataPrevisao',
      'dataRealizacao',
      'dataBaixa',
    ]);
    const partes: Prisma.infotime_lancamento_receitaWhereInput[] = [];

    for (const [campo, valBruto] of Object.entries(root)) {
      if (!permitidos.has(campo)) continue;
      if (
        valBruto === null ||
        typeof valBruto !== 'object' ||
        Array.isArray(valBruto)
      ) {
        continue;
      }
      const val = valBruto as Record<string, unknown>;
      const tipo = typeof val['tipo'] === 'string' ? val['tipo'] : '';

      if (
        (campo === 'historico' || campo === 'numeroDocumento') &&
        tipo === 'texto'
      ) {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (!contem) continue;
        const c = {
          contains: contem,
          mode: Prisma.QueryMode.insensitive,
        } as const;
        if (campo === 'historico') partes.push({ historico: c });
        if (campo === 'numeroDocumento') {
          partes.push({ numero_documento: c });
        }
      }

      if (
        (campo === 'idEmpresa' ||
          campo === 'idTipoAgente' ||
          campo === 'idPlanoConta' ||
          campo === 'idContaCaixa' ||
          campo === 'idTipoEspecie' ||
          campo === 'idSituacaoDocumento' ||
          campo === 'idNotaFiscal') &&
        tipo === 'inteiro'
      ) {
        const igual =
          typeof val['igual'] === 'string' ? val['igual'].trim() : '';
        if (!igual) continue;
        try {
          const id = BigInt(igual);
          if (campo === 'idEmpresa') partes.push({ id_empresa: id });
          if (campo === 'idTipoAgente') partes.push({ id_tipo_agente: id });
          if (campo === 'idPlanoConta') partes.push({ id_plano_conta: id });
          if (campo === 'idContaCaixa') partes.push({ id_conta_caixa: id });
          if (campo === 'idTipoEspecie') {
            partes.push({ id_tipo_especie: id });
          }
          if (campo === 'idSituacaoDocumento') {
            partes.push({ id_situacao_documento: id });
          }
          if (campo === 'idNotaFiscal') {
            partes.push({ id_nota_fiscal: id });
          }
        } catch {
          continue;
        }
      }

      if (campo === 'idSituacaoDocumento' && tipo === 'enum') {
        const valores = Array.isArray(val['valores']) ? val['valores'] : [];
        const ids: bigint[] = [];
        for (const v of valores) {
          if (typeof v !== 'string' && typeof v !== 'number') continue;
          try {
            ids.push(BigInt(String(v).trim()));
          } catch {
            continue;
          }
        }
        if (ids.length > 0) {
          partes.push({ id_situacao_documento: { in: ids } });
        }
      }

      const ehData =
        (campo === 'dataCompetencia' ||
          campo === 'dataInclusao' ||
          campo === 'dataPrevisao' ||
          campo === 'dataRealizacao' ||
          campo === 'dataBaixa') &&
        (tipo === 'data' || tipo === 'dataIntervaloInclusao');

      if (ehData) {
        const de = this.parseDataDeFiltro(val['de']);
        const ate = this.parseDataDeFiltro(val['ate']);
        const entreDatas =
          val['entreDatas'] === true ||
          (de != null && ate != null && val['entreDatas'] !== false);
        const col =
          campo === 'dataCompetencia'
            ? 'data_competencia'
            : campo === 'dataInclusao'
              ? 'data_inclusao'
              : campo === 'dataPrevisao'
                ? 'data_previsao'
                : campo === 'dataRealizacao'
                  ? 'data_realizacao'
                  : 'data_baixa';

        if (entreDatas && de && ate) {
          const fim = new Date(ate);
          fim.setHours(23, 59, 59, 999);
          partes.push({
            [col]: { gte: de, lte: fim },
          } as Prisma.infotime_lancamento_receitaWhereInput);
        } else if (de) {
          const fimDia = new Date(de);
          fimDia.setHours(23, 59, 59, 999);
          partes.push({
            [col]: { gte: de, lte: fimDia },
          } as Prisma.infotime_lancamento_receitaWhereInput);
        }
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  private inicioDiaCivilAtual(): Date {
    const d = new Date();
    d.setHours(0, 0, 0, 0);
    return d;
  }

  private fimDiaCivilAtual(): Date {
    const d = new Date();
    d.setHours(23, 59, 59, 999);
    return d;
  }

  /** Filtro opcional vindo do cockpit (query string), nunca do body. */
  private whereReceitaListagemDrilldown(
    query?: QueryListagemCrudPadrao,
  ): Prisma.infotime_lancamento_receitaWhereInput {
    const vence = query?.venceHoje?.trim() === 'true';
    const atrasado = query?.atrasado?.trim() === 'true';
    if (!vence && !atrasado) return {};
    if (vence && atrasado) {
      throw new BadRequestException(
        'Não combine venceHoje=true com atrasado=true na mesma listagem.',
      );
    }
    const naoRecebido: Prisma.infotime_lancamento_receitaWhereInput = {
      OR: [
        { id_situacao_documento: null },
        {
          id_situacao_documento: {
            notIn: [ID_SITUACAO_DOCUMENTO_PAGO, ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL],
          },
        },
      ],
    };
    if (vence) {
      return {
        AND: [
          {
            data_previsao: {
              gte: this.inicioDiaCivilAtual(),
              lte: this.fimDiaCivilAtual(),
            },
          },
          naoRecebido,
        ],
      };
    }
    return {
      AND: [{ data_previsao: { lt: this.inicioDiaCivilAtual() } }, naoRecebido],
    };
  }

  private nomeAgenteLinha(
    r: {
      id_tipo_agente: bigint | null;
      infotime_cliente: {
        nome_fantasia: string | null;
        razao_social: string | null;
      } | null;
      infotime_fornecedor: { nome_fantasia: string | null } | null;
    },
    mapCol: Map<string, string>,
    idColaborador: bigint | null,
  ): string | null {
    const ta = r.id_tipo_agente;
    if (ta === 1n) {
      return (
        r.infotime_cliente?.nome_fantasia?.trim() ||
        r.infotime_cliente?.razao_social?.trim() ||
        null
      );
    }
    if (ta === 2n) {
      return r.infotime_fornecedor?.nome_fantasia?.trim() || null;
    }
    if (ta === 3n && idColaborador != null) {
      return mapCol.get(idColaborador.toString()) ?? null;
    }
    return null;
  }

  private cnpjCpfLinha(
    r: {
      id_tipo_agente: bigint | null;
      infotime_cliente: { cnpj: string | null } | null;
      infotime_fornecedor: { cnpj: string | null } | null;
    },
    mapColCpf: Map<string, string>,
    idColaborador: bigint | null,
  ): string | null {
    const ta = r.id_tipo_agente;
    if (ta === 1n) return r.infotime_cliente?.cnpj ?? null;
    if (ta === 2n) return r.infotime_fornecedor?.cnpj ?? null;
    if (ta === 3n && idColaborador != null) {
      return mapColCpf.get(idColaborador.toString()) ?? null;
    }
    return null;
  }

  private async mapColaboradores(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<{ nome: Map<string, string>; cpf: Map<string, string> }> {
    const nome = new Map<string, string>();
    const cpf = new Map<string, string>();
    const uniq = [...new Set(ids.map((x) => x.toString()))].map((s) => BigInt(s));
    if (uniq.length === 0) return { nome, cpf };
    const rows = await this.prisma.$queryRaw<
      { id: bigint; nome: string | null; cpf: string | null }[]
    >(Prisma.sql`
      SELECT id_colaborador AS id, nome, cpf
      FROM infotime_colaborador
      WHERE id_tenacidade = ${idTenacidade}
        AND id_colaborador IN (${Prisma.join(uniq)})
    `);
    for (const r of rows) {
      nome.set(r.id.toString(), r.nome?.trim() ?? '');
      cpf.set(r.id.toString(), r.cpf?.trim() ?? '');
    }
    return { nome, cpf };
  }

  private async mapaTipoEspecie(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_tipo_especie AS id, descricao
      FROM infotime_tipo_especie
      WHERE id_tenacidade = ${idTenacidade}
        AND id_tipo_especie IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      map.set(r.id.toString(), r.descricao?.trim() ?? '');
    }
    return map;
  }

  private async mapaSituacaoDocumento(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_situacao_documento AS id, descricao
      FROM infotime_situacao_documento
      WHERE id_tenacidade = ${idTenacidade}
        AND id_situacao_documento IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      map.set(r.id.toString(), r.descricao?.trim() ?? '');
    }
    return map;
  }

  private async mapaContaCaixa(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_conta_caixa AS id, descricao
      FROM infotime_conta_caixa
      WHERE id_tenacidade = ${idTenacidade}
        AND id_conta_caixa IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      map.set(r.id.toString(), r.descricao?.trim() ?? '');
    }
    return map;
  }

  private async mapaTipoAgente(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_tipo_agente AS id, descricao
      FROM infotime_tipo_agente
      WHERE id_tipo_agente IN (${Prisma.join(ids)})
        AND (id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade})
    `);
    for (const r of rows) {
      map.set(r.id.toString(), r.descricao?.trim() ?? '');
    }
    return map;
  }

  private async mapaPlanoConta(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; classificador: number | null; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_plano_conta AS id, classificador, descricao
      FROM infotime_plano_conta
      WHERE id_tenacidade = ${idTenacidade}
        AND id_plano_conta IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      const c = r.classificador != null ? String(r.classificador) : '';
      const d = r.descricao?.trim() ?? '';
      map.set(r.id.toString(), [c, d].filter(Boolean).join(' — ') || d || c);
    }
    return map;
  }

  private async mapaEmpresa(
    idTenacidade: bigint,
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      {
        id: bigint;
        nome_fantasia: string | null;
        tipo_empresa: string | null;
      }[]
    >(Prisma.sql`
      SELECT id_empresa AS id, nome_fantasia, tipo_empresa
      FROM infotime_empresa
      WHERE id_tenacidade = ${idTenacidade}
        AND id_empresa IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      const nf = r.nome_fantasia?.trim() ?? '';
      const te = (r.tipo_empresa ?? '').trim();
      map.set(r.id.toString(), te ? `${nf} — ${te}` : nf);
    }
    return map;
  }

  private async enriquecerLinhasLista(
    idTenacidade: bigint,
    linhas: Array<{
      id_lancamento_receita: bigint;
      id_tipo_agente: bigint | null;
      id_colaborador: bigint | null;
      id_tipo_especie: bigint | null;
      id_situacao_documento: bigint | null;
      id_conta_caixa: bigint | null;
      id_empresa: bigint | null;
      id_plano_conta: bigint | null;
      id_nota_fiscal: bigint | null;
      nota_fiscal: string | null;
      data_previsao: Date | null;
      valor_previsao: Prisma.Decimal | null;
      valor_original: Prisma.Decimal | null;
      data_realizacao: Date | null;
      valor_realizacao: Prisma.Decimal | null;
      historico: string | null;
      data_competencia: Date | null;
      data_baixa: Date | null;
      data_inclusao: Date | null;
      numero_documento: string | null;
      parcela: number | null;
      unidade_origem: string | null;
      usuario_externo: string | null;
      infotime_cliente: {
        nome_fantasia: string | null;
        cnpj: string | null;
        razao_social: string | null;
      } | null;
      infotime_fornecedor: { nome_fantasia: string | null; cnpj: string | null } | null;
    }>,
  ): Promise<ContasReceberListaItemDto[]> {
    const idsTipoEspecie = [
      ...new Set(
        linhas
          .map((x) => x.id_tipo_especie)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsSit = [
      ...new Set(
        linhas
          .map((x) => x.id_situacao_documento)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsCx = [
      ...new Set(
        linhas
          .map((x) => x.id_conta_caixa)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsEmp = [
      ...new Set(
        linhas.map((x) => x.id_empresa).filter((x): x is bigint => x != null),
      ),
    ];
    const idsPc = [
      ...new Set(
        linhas
          .map((x) => x.id_plano_conta)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsTa = [
      ...new Set(
        linhas
          .map((x) => x.id_tipo_agente)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsCol = [
      ...new Set(
        linhas
          .map((x) => x.id_colaborador)
          .filter((x): x is bigint => x != null),
      ),
    ];

    const [
      tipoEspecie,
      situacao,
      contaCaixa,
      empresa,
      planoConta,
      tipoAgente,
      colaboradores,
    ] = await Promise.all([
      this.mapaTipoEspecie(idTenacidade, idsTipoEspecie),
      this.mapaSituacaoDocumento(idTenacidade, idsSit),
      this.mapaContaCaixa(idTenacidade, idsCx),
      this.mapaEmpresa(idTenacidade, idsEmp),
      this.mapaPlanoConta(idTenacidade, idsPc),
      this.mapaTipoAgente(idTenacidade, idsTa),
      this.mapColaboradores(idTenacidade, idsCol),
    ]);

    return linhas.map((r) => {
      const idCol = r.id_colaborador;
      const nomeAgente = this.nomeAgenteLinha(r, colaboradores.nome, idCol);
      const cnpjCpf = this.cnpjCpfLinha(r, colaboradores.cpf, idCol);
      const cnpjFornecedor =
        r.id_tipo_agente === 2n ? r.infotime_fornecedor?.cnpj ?? null : null;
      return {
        idLancamentoReceita: r.id_lancamento_receita.toString(),
        dataPrevisao: r.data_previsao,
        valorPrevisao: this.decParaJson(r.valor_previsao),
        valorOriginal: this.decParaJson(r.valor_original),
        dataRealizacao: r.data_realizacao,
        valorRealizacao: this.decParaJson(r.valor_realizacao),
        idTipoEspecie: r.id_tipo_especie?.toString() ?? null,
        tipoEspecieDescricao:
          r.id_tipo_especie != null
            ? tipoEspecie.get(r.id_tipo_especie.toString()) ?? null
            : null,
        nomeAgente,
        cnpjCpf,
        historico: r.historico,
        dataCompetencia: r.data_competencia,
        idContaCaixa: r.id_conta_caixa?.toString() ?? null,
        contaCaixaDescricao:
          r.id_conta_caixa != null
            ? contaCaixa.get(r.id_conta_caixa.toString()) ?? null
            : null,
        idSituacaoDocumento: r.id_situacao_documento?.toString() ?? null,
        situacaoDocumentoDescricao:
          r.id_situacao_documento != null
            ? situacao.get(r.id_situacao_documento.toString()) ?? null
            : null,
        idEmpresa: r.id_empresa?.toString() ?? null,
        empresaDescricao:
          r.id_empresa != null ? empresa.get(r.id_empresa.toString()) ?? null : null,
        idPlanoConta: r.id_plano_conta?.toString() ?? null,
        planoContaDescricao:
          r.id_plano_conta != null
            ? planoConta.get(r.id_plano_conta.toString()) ?? null
            : null,
        idNotaFiscal: r.id_nota_fiscal?.toString() ?? null,
        notaFiscal: r.nota_fiscal,
        dataBaixa: r.data_baixa,
        idTipoAgente: r.id_tipo_agente?.toString() ?? null,
        tipoAgenteDescricao:
          r.id_tipo_agente != null
            ? tipoAgente.get(r.id_tipo_agente.toString()) ?? null
            : null,
        dataInclusao: r.data_inclusao,
        cnpj: cnpjFornecedor,
        numeroDocumento: r.numero_documento,
        parcela: r.parcela,
        unidadeOrigem: r.unidade_origem,
        usuarioExterno: r.usuario_externo,
      };
    });
  }

  async carregarLookups(idTenacidade: bigint): Promise<{
    situacoesDocumento: { id: string; descricao: string | null }[];
    tiposAgente: { id: string; descricao: string | null }[];
    empresasAtivas: { id: string; rotulo: string }[];
    contasCaixa: { id: string; descricao: string | null }[];
    tiposEspecie: { id: string; descricao: string | null }[];
    planosConta: { id: string; rotulo: string }[];
  }> {
    const [
      situacoesDocumento,
      tiposAgente,
      empresasAtivas,
      contasCaixa,
      tiposEspecie,
      planosConta,
    ] = await Promise.all([
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_situacao_documento AS id, descricao
        FROM infotime_situacao_documento
        WHERE id_tenacidade = ${idTenacidade}
        ORDER BY descricao DESC NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_tipo_agente AS id, descricao
        FROM infotime_tipo_agente
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<
        { id: bigint; nome_fantasia: string | null; tipo_empresa: string | null }[]
      >`
        SELECT id_empresa AS id, nome_fantasia, tipo_empresa
        FROM infotime_empresa
        WHERE id_tenacidade = ${idTenacidade}
          AND COALESCE(ativo, '') = 'S'
        ORDER BY nome_fantasia NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_conta_caixa AS id, descricao
        FROM infotime_conta_caixa
        WHERE id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_tipo_especie AS id, descricao
        FROM infotime_tipo_especie
        WHERE id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<
        { id: bigint; classificador: number | null; descricao: string | null }[]
      >`
        SELECT id_plano_conta AS id, classificador, descricao
        FROM infotime_plano_conta
        WHERE id_tenacidade = ${idTenacidade}
          AND COALESCE(tipo, '') = 'A'
          AND COALESCE(origem, '') = 'R'
        ORDER BY classificador NULLS LAST, descricao NULLS LAST
        LIMIT 500
      `,
    ]);

    return {
      situacoesDocumento: situacoesDocumento.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      tiposAgente: tiposAgente.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      empresasAtivas: empresasAtivas.map((r) => {
        const nf = r.nome_fantasia?.trim() ?? '';
        const te = (r.tipo_empresa ?? '').trim();
        return {
          id: r.id.toString(),
          rotulo: te ? `${nf} — ${te}` : nf,
        };
      }),
      contasCaixa: contasCaixa.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      tiposEspecie: tiposEspecie.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      planosConta: planosConta.map((r) => {
        const c = r.classificador != null ? String(r.classificador) : '';
        const d = r.descricao?.trim() ?? '';
        return {
          id: r.id.toString(),
          rotulo: [c, d].filter(Boolean).join(' — ') || d || c || r.id.toString(),
        };
      }),
    };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: ContasReceberListaItemDto[]; total: number }> {
    const baseWhere: Prisma.infotime_lancamento_receitaWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };
    const takeLegado = 500;

    if (!modoListagemCrudNovo(query)) {
      const linhas = await this.prisma.infotime_lancamento_receita.findMany({
        where: baseWhere,
        orderBy: [{ data_previsao: 'asc' }],
        select: selectLista,
        ...(todos === true ? {} : { take: takeLegado }),
      });
      const dados = await this.enriquecerLinhasLista(
        tenantContexto.idTenacidade,
        linhas,
      );
      return { dados, total: dados.length };
    }

    const cargaInicial = query?.cargaInicial?.trim();
    const qTexto = (query?.q ?? '').trim();
    const campoPesquisa = (query?.campoPesquisa ?? '').trim();
    const { pagina, tamanhoPagina } = parsePaginaETamanhoPagina(query);

    if (cargaInicial === 'vazio' && qTexto === '') {
      return { dados: [], total: 0 };
    }

    const camposPesquisa = new Set([
      'historico',
      'numeroDocumento',
      'idLancamentoReceita',
      'idNotaFiscal',
      'nomeAgente',
      'cnpjCpf',
    ]);

    let whereExtra: Prisma.infotime_lancamento_receitaWhereInput = {};
    if (qTexto !== '' && campoPesquisa !== '') {
      if (!camposPesquisa.has(campoPesquisa)) {
        throw new BadRequestException(`campoPesquisa inválido: ${campoPesquisa}`);
      }
      whereExtra = await this.whereCampoPesquisaAsync(
        tenantContexto.idTenacidade,
        campoPesquisa,
        qTexto,
      );
    }

    const whereFiltro = this.whereFiltroRefinado(query?.filtroRefinado);
    const whereDrilldown = this.whereReceitaListagemDrilldown(query);
    const where = mergeWhereAnd(baseWhere, whereExtra, whereFiltro, whereDrilldown);

    const total = await this.prisma.infotime_lancamento_receita.count({
      where,
    });

    const linhas = await this.prisma.infotime_lancamento_receita.findMany({
      where,
      orderBy: [{ data_previsao: 'asc' }],
      skip: pagina * tamanhoPagina,
      take: tamanhoPagina,
      select: selectLista,
    });

    const dados = await this.enriquecerLinhasLista(
      tenantContexto.idTenacidade,
      linhas,
    );
    return { dados, total };
  }

  /** RN-01 — alteração: registro já marcado com fechamento (todos os tenants). */
  private assertRegistroNaoFechadoParaAlteracao(
    _idTenacidade: bigint,
    fechamentoFinanceiroAtual: string | null | undefined,
  ): void {
    if ((fechamentoFinanceiroAtual ?? '').trim().toUpperCase() === 'S') {
      throw new BadRequestException(
        'Receita não pode ser alterada. Já houve fechamento financeiro para esse período.',
      );
    }
  }

  /** RN-01 — inclusão: período de `data_previsao` coberto por fechamento financeiro (todos os tenants). */
  private async assertPeriodoLivreParaInclusao(
    idTenacidade: bigint,
    dataPrevisao: Date,
  ): Promise<void> {
    const row = await this.prisma.$queryRaw<{ ok: bigint }[]>`
      SELECT 1::bigint AS ok
      FROM infotime_fechamento_financeiro
      WHERE id_tenacidade = ${idTenacidade}
        AND data_inicial IS NOT NULL
        AND data_final IS NOT NULL
        AND data_inicial <= ${dataPrevisao}::date
        AND data_final >= ${dataPrevisao}::date
      LIMIT 1
    `;
    if (row.length > 0) {
      throw new BadRequestException(
        'Receita não pode ser incluída. Já houve fechamento financeiro para esse período.',
      );
    }
  }

  private async assertAgentesETenant(
    idTenacidade: bigint,
    idTipoAgente: bigint,
    idCliente: bigint | null,
    idFornecedor: bigint | null,
    idColaborador: bigint | null,
  ): Promise<void> {
    if (idTipoAgente === 1n) {
      if (idCliente == null) {
        throw new BadRequestException('Cliente: Campo obrigatório');
      }
      const c = await this.prisma.infotime_cliente.findFirst({
        where: { id_cliente: idCliente, id_tenacidade: idTenacidade },
        select: { id_cliente: true },
      });
      if (!c) {
        throw new BadRequestException('Cliente inválido para esta tenacidade.');
      }
    } else if (idTipoAgente === 2n) {
      if (idFornecedor == null) {
        throw new BadRequestException('Fornecedor: Campo obrigatório');
      }
      const f = await this.prisma.infotime_fornecedor.findFirst({
        where: { id_fornecedor: idFornecedor, id_tenacidade: idTenacidade },
        select: { id_fornecedor: true },
      });
      if (!f) {
        throw new BadRequestException('Fornecedor inválido para esta tenacidade.');
      }
    } else if (idTipoAgente === 3n) {
      if (idColaborador == null) {
        throw new BadRequestException('Colaborador: Campo obrigatório');
      }
      const rows = await this.prisma.$queryRaw<{ ok: bigint }[]>`
        SELECT 1::bigint AS ok FROM infotime_colaborador
        WHERE id_colaborador = ${idColaborador} AND id_tenacidade = ${idTenacidade}
        LIMIT 1
      `;
      if (rows.length === 0) {
        throw new BadRequestException('Colaborador inválido para esta tenacidade.');
      }
    } else {
      throw new BadRequestException('Tipo de agente inválido.');
    }
  }

  private async assertPlanoContaTenant(
    idTenacidade: bigint,
    idPlanoConta: bigint,
  ): Promise<void> {
    const rows = await this.prisma.$queryRaw<{ ok: bigint }[]>`
      SELECT 1::bigint AS ok FROM infotime_plano_conta
      WHERE id_plano_conta = ${idPlanoConta}
        AND id_tenacidade = ${idTenacidade}
        AND COALESCE(tipo, '') = 'A'
        AND COALESCE(origem, '') = 'R'
      LIMIT 1
    `;
    if (rows.length === 0) {
      throw new BadRequestException(
        'Plano de Contas: deve ser analítico (Tipo A) e origem Receita (Origem R) para este tenant.',
      );
    }
  }

  private aplicarValidacoesPagamento(
    idSituacao: bigint,
    valorReal: Prisma.Decimal | null,
    dataRealizacao: Date | null,
    dataBaixa: Date | null,
    idTipoEspecie: bigint | null,
  ): void {
    const vr = valorReal != null ? Number(valorReal) : 0;
    if (vr > 0) {
      if (idTipoEspecie == null) {
        throw new BadRequestException('Espécie: Campo obrigatório');
      }
    }
    const exigeRecebimento =
      idSituacao === ID_SITUACAO_DOCUMENTO_PAGO ||
      idSituacao === ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL;
    if (exigeRecebimento) {
      if (valorReal == null || Number(valorReal) <= 0) {
        throw new BadRequestException('Valor pago: Campo obrigatório');
      }
      if (dataRealizacao == null) {
        throw new BadRequestException('Pago em: Campo obrigatório');
      }
      if (dataBaixa == null) {
        throw new BadRequestException('Baixado em: Campo obrigatório');
      }
      if (idTipoEspecie == null) {
        throw new BadRequestException('Espécie: Campo obrigatório');
      }
    }
  }

  private montarCreateData(
    dto: CriarContasReceberDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Prisma.infotime_lancamento_receitaUncheckedCreateInput {
    const idTipoAgente = this.parseBigIntObrigatorio(dto.idTipoAgente, 'idTipoAgente');
    const idCliente = this.parseBigIntOpcional(dto.idCliente, 'idCliente');
    const idFornecedor = this.parseBigIntOpcional(dto.idFornecedor, 'idFornecedor');
    const idColaborador = this.parseBigIntOpcional(dto.idColaborador, 'idColaborador');
    const idPlanoConta = this.parseBigIntObrigatorio(dto.idPlanoConta, 'idPlanoConta');
    const idSituacao = this.parseBigIntObrigatorio(
      dto.idSituacaoDocumento,
      'idSituacaoDocumento',
    );
    const dataPrevisao = this.parseDataObrigatoria(dto.dataPrevisao, 'dataPrevisao');
    const valorPrevisao = this.parseDecimalObrigatorio(dto.valorPrevisao, 'valorPrevisao');
    const valorReal = this.parseDecimalOpcional(dto.valorRealizacao, 'valorRealizacao');
    const idTipoEspecie = this.parseBigIntOpcional(dto.idTipoEspecie, 'idTipoEspecie');

    return {
      id_tenacidade: tenantContexto.idTenacidade,
      id_tipo_agente: idTipoAgente,
      id_cliente: idTipoAgente === 1n ? idCliente : null,
      id_fornecedor: idTipoAgente === 2n ? idFornecedor : null,
      id_colaborador: idTipoAgente === 3n ? idColaborador : null,
      id_empresa: this.parseBigIntOpcional(dto.idEmpresa, 'idEmpresa'),
      id_plano_conta: idPlanoConta,
      id_situacao_documento: idSituacao,
      id_conta_caixa: this.parseBigIntOpcional(dto.idContaCaixa, 'idContaCaixa'),
      valor_previsao: valorPrevisao,
      valor_original: this.parseDecimalOpcional(dto.valorOriginal, 'valorOriginal'),
      data_previsao: dataPrevisao,
      valor_realizacao: valorReal,
      data_realizacao: this.parseDataHoraOpcional(dto.dataRealizacao, 'dataRealizacao'),
      id_tipo_especie: idTipoEspecie,
      numero_documento: dto.numeroDocumento ?? null,
      data_competencia: this.parseDataHoraOpcional(dto.dataCompetencia, 'dataCompetencia'),
      conta_contabil: dto.contaContabil ?? null,
      historico: dto.historico ?? null,
      valor_acrescimo: this.parseDecimalOpcional(dto.valorAcrescimo, 'valorAcrescimo'),
      valor_desconto: this.parseDecimalOpcional(dto.valorDesconto, 'valorDesconto'),
      valor_multa: this.parseDecimalOpcional(dto.valorMulta, 'valorMulta'),
      valor_juros: this.parseDecimalOpcional(dto.valorJuros, 'valorJuros'),
      data_baixa: this.parseDataHoraOpcional(dto.dataBaixa, 'dataBaixa'),
      id_nota_fiscal: this.parseBigIntOpcional(dto.idNotaFiscal, 'idNotaFiscal'),
      nota_fiscal: dto.notaFiscal ?? null,
      observacoes: dto.observacoes ?? null,
      data_inclusao: new Date(),
      id_usuario_inclusao: tenantContexto.idUsuario,
      id_usuario_previsao: tenantContexto.idUsuario,
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: this.fatiarIp(ip),
      nome_aplicacao_auditoria: APP,
    };
  }

  private patchUpdate(
    dto: AtualizarContasReceberDto,
  ): Prisma.infotime_lancamento_receitaUncheckedUpdateInput {
    const patch: Prisma.infotime_lancamento_receitaUncheckedUpdateInput = {};
    if (dto.idTipoAgente !== undefined) {
      patch.id_tipo_agente = this.parseBigIntObrigatorio(dto.idTipoAgente, 'idTipoAgente');
    }
    if (dto.idCliente !== undefined) {
      patch.id_cliente = this.parseBigIntOpcional(dto.idCliente, 'idCliente');
    }
    if (dto.idFornecedor !== undefined) {
      patch.id_fornecedor = this.parseBigIntOpcional(dto.idFornecedor, 'idFornecedor');
    }
    if (dto.idColaborador !== undefined) {
      patch.id_colaborador = this.parseBigIntOpcional(dto.idColaborador, 'idColaborador');
    }
    if (dto.idEmpresa !== undefined) {
      patch.id_empresa = this.parseBigIntOpcional(dto.idEmpresa, 'idEmpresa');
    }
    if (dto.idPlanoConta !== undefined) {
      patch.id_plano_conta = this.parseBigIntObrigatorio(dto.idPlanoConta, 'idPlanoConta');
    }
    if (dto.idSituacaoDocumento !== undefined) {
      patch.id_situacao_documento = this.parseBigIntObrigatorio(
        dto.idSituacaoDocumento,
        'idSituacaoDocumento',
      );
    }
    if (dto.idContaCaixa !== undefined) {
      patch.id_conta_caixa = this.parseBigIntOpcional(dto.idContaCaixa, 'idContaCaixa');
    }
    if (dto.valorPrevisao !== undefined) {
      patch.valor_previsao = this.parseDecimalObrigatorio(
        dto.valorPrevisao,
        'valorPrevisao',
      );
    }
    if (dto.valorOriginal !== undefined) {
      patch.valor_original = this.parseDecimalOpcional(
        dto.valorOriginal,
        'valorOriginal',
      );
    }
    if (dto.dataPrevisao !== undefined) {
      patch.data_previsao = this.parseDataObrigatoria(dto.dataPrevisao, 'dataPrevisao');
    }
    if (dto.valorRealizacao !== undefined) {
      patch.valor_realizacao = this.parseDecimalOpcional(
        dto.valorRealizacao,
        'valorRealizacao',
      );
    }
    if (dto.dataRealizacao !== undefined) {
      patch.data_realizacao = this.parseDataHoraOpcional(
        dto.dataRealizacao,
        'dataRealizacao',
      );
    }
    if (dto.idTipoEspecie !== undefined) {
      patch.id_tipo_especie = this.parseBigIntOpcional(
        dto.idTipoEspecie,
        'idTipoEspecie',
      );
    }
    if (dto.numeroDocumento !== undefined) {
      patch.numero_documento = dto.numeroDocumento ?? null;
    }
    if (dto.idNotaFiscal !== undefined) {
      patch.id_nota_fiscal = this.parseBigIntOpcional(dto.idNotaFiscal, 'idNotaFiscal');
    }
    if (dto.notaFiscal !== undefined) {
      patch.nota_fiscal = dto.notaFiscal ?? null;
    }
    if (dto.dataCompetencia !== undefined) {
      patch.data_competencia = this.parseDataHoraOpcional(
        dto.dataCompetencia,
        'dataCompetencia',
      );
    }
    if (dto.contaContabil !== undefined) patch.conta_contabil = dto.contaContabil ?? null;
    if (dto.historico !== undefined) patch.historico = dto.historico ?? null;
    if (dto.valorAcrescimo !== undefined) {
      patch.valor_acrescimo = this.parseDecimalOpcional(
        dto.valorAcrescimo,
        'valorAcrescimo',
      );
    }
    if (dto.valorDesconto !== undefined) {
      patch.valor_desconto = this.parseDecimalOpcional(
        dto.valorDesconto,
        'valorDesconto',
      );
    }
    if (dto.valorMulta !== undefined) {
      patch.valor_multa = this.parseDecimalOpcional(dto.valorMulta, 'valorMulta');
    }
    if (dto.valorJuros !== undefined) {
      patch.valor_juros = this.parseDecimalOpcional(dto.valorJuros, 'valorJuros');
    }
    if (dto.dataBaixa !== undefined) {
      patch.data_baixa = this.parseDataHoraOpcional(dto.dataBaixa, 'dataBaixa');
    }
    if (dto.observacoes !== undefined) patch.observacoes = dto.observacoes ?? null;
    return patch;
  }

  async obterPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: Record<string, unknown> }> {
    let idLanc: bigint;
    try {
      idLanc = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador inválido.');
    }

    const registro = await this.prisma.infotime_lancamento_receita.findFirst({
      where: {
        id_lancamento_receita: idLanc,
        id_tenacidade: tenantContexto.idTenacidade,
      },
    });

    if (!registro) {
      throw new NotFoundException(`Lançamento ${id} não encontrado.`);
    }

    const json = Object.fromEntries(
      Object.entries(registro).map(([k, v]) => [
        k,
        typeof v === 'bigint' ? v.toString() : v instanceof Prisma.Decimal ? v.toString() : v,
      ]),
    ) as Record<string, unknown>;

    return { dados: json };
  }

  async criar(
    dto: CriarContasReceberDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const idTipoAgente = this.parseBigIntObrigatorio(dto.idTipoAgente, 'idTipoAgente');
    const idCliente = this.parseBigIntOpcional(dto.idCliente, 'idCliente');
    const idFornecedor = this.parseBigIntOpcional(dto.idFornecedor, 'idFornecedor');
    const idColaborador = this.parseBigIntOpcional(dto.idColaborador, 'idColaborador');
    const idPlanoConta = this.parseBigIntObrigatorio(dto.idPlanoConta, 'idPlanoConta');
    const dataPrevisao = this.parseDataObrigatoria(dto.dataPrevisao, 'dataPrevisao');
    const idSituacao = this.parseBigIntObrigatorio(
      dto.idSituacaoDocumento,
      'idSituacaoDocumento',
    );
    const valorReal = this.parseDecimalOpcional(dto.valorRealizacao, 'valorRealizacao');
    const idTipoEspecie = this.parseBigIntOpcional(dto.idTipoEspecie, 'idTipoEspecie');
    const dataRealizacao = this.parseDataHoraOpcional(dto.dataRealizacao, 'dataRealizacao');
    const dataBaixaVal = this.parseDataHoraOpcional(dto.dataBaixa, 'dataBaixa');

    await this.assertAgentesETenant(
      tenantContexto.idTenacidade,
      idTipoAgente,
      idCliente,
      idFornecedor,
      idColaborador,
    );
    await this.assertPlanoContaTenant(tenantContexto.idTenacidade, idPlanoConta);
    await this.assertPeriodoLivreParaInclusao(
      tenantContexto.idTenacidade,
      dataPrevisao,
    );
    this.aplicarValidacoesPagamento(
      idSituacao,
      valorReal,
      dataRealizacao,
      dataBaixaVal,
      idTipoEspecie,
    );

    const data = this.montarCreateData(dto, tenantContexto, ip);
    const criado = await this.prisma.infotime_lancamento_receita.create({
      data,
      select: { id_lancamento_receita: true },
    });
    return { id: criado.id_lancamento_receita.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarContasReceberDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<void> {
    let idLanc: bigint;
    try {
      idLanc = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador inválido.');
    }

    const atual = await this.prisma.infotime_lancamento_receita.findFirst({
      where: {
        id_lancamento_receita: idLanc,
        id_tenacidade: tenantContexto.idTenacidade,
      },
    });
    if (!atual) {
      throw new NotFoundException(`Lançamento ${id} não encontrado.`);
    }

    const patch = this.patchUpdate(dto);

    const idTipo =
      (patch.id_tipo_agente as bigint | undefined) ?? atual.id_tipo_agente;
    const idCli = (patch.id_cliente as bigint | null | undefined) ?? atual.id_cliente;
    const idForn =
      (patch.id_fornecedor as bigint | null | undefined) ?? atual.id_fornecedor;
    const idCol =
      (patch.id_colaborador as bigint | null | undefined) ?? atual.id_colaborador;
    const idPlano =
      (patch.id_plano_conta as bigint | undefined) ?? atual.id_plano_conta;
    const idSit =
      (patch.id_situacao_documento as bigint | undefined) ??
      atual.id_situacao_documento;
    const dataPrev =
      (patch.data_previsao as Date | undefined) ?? atual.data_previsao;
    const valorReal =
      (patch.valor_realizacao as Prisma.Decimal | null | undefined) ??
      atual.valor_realizacao;
    const idTipoEsp =
      (patch.id_tipo_especie as bigint | null | undefined) ?? atual.id_tipo_especie;
    const dataReal =
      patch.data_realizacao !== undefined
        ? (patch.data_realizacao as Date | null)
        : atual.data_realizacao;
    const dataBaixaVal =
      patch.data_baixa !== undefined
        ? (patch.data_baixa as Date | null)
        : atual.data_baixa;

    if (idTipo == null || idPlano == null || idSit == null || !dataPrev) {
      throw new BadRequestException('Dados incompletos para validação.');
    }

    await this.assertAgentesETenant(
      tenantContexto.idTenacidade,
      idTipo,
      idTipo === 1n ? idCli : null,
      idTipo === 2n ? idForn : null,
      idTipo === 3n ? idCol : null,
    );
    await this.assertPlanoContaTenant(tenantContexto.idTenacidade, idPlano);
    this.assertRegistroNaoFechadoParaAlteracao(
      tenantContexto.idTenacidade,
      atual.fechamento_financeiro,
    );
    this.aplicarValidacoesPagamento(
      idSit,
      valorReal,
      dataReal,
      dataBaixaVal,
      idTipoEsp,
    );

    if (
      idSit === ID_SITUACAO_DOCUMENTO_PAGO ||
      idSit === ID_SITUACAO_DOCUMENTO_PAGO_PARCIAL
    ) {
      patch.id_usuario_realizacao = tenantContexto.idUsuario;
      patch.idusuario_baixa = tenantContexto.idUsuario;
    }

    await this.prisma.infotime_lancamento_receita.update({
      where: { id_lancamento_receita: idLanc },
      data: {
        ...patch,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
      },
    });
  }

  async excluir(id: string, tenantContexto: TenantContexto): Promise<void> {
    let idLanc: bigint;
    try {
      idLanc = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador inválido.');
    }

    const existe = await this.prisma.infotime_lancamento_receita.findFirst({
      where: {
        id_lancamento_receita: idLanc,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_lancamento_receita: true },
    });
    if (!existe) {
      throw new NotFoundException(`Lançamento ${id} não encontrado.`);
    }

    try {
      await this.prisma.infotime_lancamento_receita.delete({
        where: { id_lancamento_receita: idLanc },
      });
    } catch (e: unknown) {
      const code =
        typeof e === 'object' && e !== null && 'code' in e
          ? String((e as { code?: string }).code)
          : '';
      if (code === 'P2003') {
        throw new BadRequestException(
          'Não é possível excluir: existem registros dependentes deste lançamento.',
        );
      }
      throw e;
    }
  }

  /**
   * Busca paginada de colaboradores do tenant (nome ou CPF) para lookup no formulário.
   * A tabela `infotime_colaborador` não possui módulo CRUD separado na API.
   */
  async listarColaboradoresLookup(
    idTenacidade: bigint,
    query?: QueryListagemCrudPadrao,
  ): Promise<{
    dados: { idColaborador: string; nome: string | null; cpf: string | null }[];
    total: number;
  }> {
    const q = (query?.q ?? '').trim();
    if (!q) {
      return { dados: [], total: 0 };
    }
    const { pagina, tamanhoPagina } = parsePaginaETamanhoPagina(query);
    const idsNome = await this.idsColaboradorNomeOuCpfContem(
      idTenacidade,
      q,
      'nome',
    );
    const idsCpf = await this.idsColaboradorNomeOuCpfContem(
      idTenacidade,
      q,
      'cpf',
    );
    const vistos = new Set<string>();
    const ordem: bigint[] = [];
    for (const id of [...idsNome, ...idsCpf]) {
      const s = id.toString();
      if (!vistos.has(s)) {
        vistos.add(s);
        ordem.push(id);
      }
    }
    const total = ordem.length;
    const offset = pagina * tamanhoPagina;
    const slice = ordem.slice(offset, offset + tamanhoPagina);
    if (slice.length === 0) {
      return { dados: [], total };
    }
    const rows = await this.prisma.$queryRaw<
      { id: bigint; nome: string | null; cpf: string | null }[]
    >(Prisma.sql`
      SELECT id_colaborador AS id, nome, cpf
      FROM infotime_colaborador
      WHERE id_tenacidade = ${idTenacidade}
        AND id_colaborador IN (${Prisma.join(slice)})
    `);
    const porId = new Map(rows.map((r) => [r.id.toString(), r]));
    const dados = slice.map((idB) => {
      const r = porId.get(idB.toString());
      return {
        idColaborador: idB.toString(),
        nome: r?.nome ?? null,
        cpf: r?.cpf ?? null,
      };
    });
    return { dados, total };
  }

  async obterColaboradorLookup(
    idTenacidade: bigint,
    id: string,
  ): Promise<{
    dados: { idColaborador: string; nome: string | null; cpf: string | null };
  }> {
    let idCol: bigint;
    try {
      idCol = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de colaborador inválido.');
    }
    const rows = await this.prisma.$queryRaw<
      { id: bigint; nome: string | null; cpf: string | null }[]
    >(Prisma.sql`
      SELECT id_colaborador AS id, nome, cpf
      FROM infotime_colaborador
      WHERE id_tenacidade = ${idTenacidade}
        AND id_colaborador = ${idCol}
      LIMIT 1
    `);
    const r = rows[0];
    if (!r) {
      throw new NotFoundException(`Colaborador ${id} não encontrado.`);
    }
    return {
      dados: {
        idColaborador: r.id.toString(),
        nome: r.nome,
        cpf: r.cpf,
      },
    };
  }
}
