import {
  BadRequestException,
  Injectable,
  NotFoundException,
  NotImplementedException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';
import * as crypto from 'node:crypto';

import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { mergeWhereAnd } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  modoListagemCrudNovo,
  parseJsonFiltroRefinado,
  parsePaginaETamanhoPagina,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarColaboradorDto } from './dto/atualizar-colaborador.dto';
import { CriarColaboradorDto } from './dto/criar-colaborador.dto';

const APP = 'infotime-web';
const IP_MAX = 50;

const selectLista = {
  id_colaborador: true,
  nome: true,
  cpf: true,
  email: true,
  celular: true,
  sexo: true,
  data_nascimento: true,
  data_admissao: true,
  id_cargo_classificacao_nivel: true,
  id_tipo_colaborador: true,
  infotime_tipo_colaborador: { select: { descricao: true } },
  id_situacao_colaborador: true,
  infotime_situacao_colaborador: { select: { descricao: true } },
} as const;

/**
 * Detalhe para bases legadas sem colunas geo no `infotime_colaborador` (evita Prisma P2022).
 * Quando latitude/longitude existirem no Postgres, pode alinhar ao schema completo / migration.
 */
const selectColaboradorDetalheSemGeo = {
  id_colaborador: true,
  id_tenacidade: true,
  id_tipo_colaborador: true,
  id_situacao_colaborador: true,
  id_banco: true,
  id_agencia: true,
  id_cargo_classificacao_nivel: true,
  id_empresa: true,
  id_tipo_estado_civil: true,
  id_usuario_auditoria: true,
  numero_conta: true,
  nome: true,
  apelido: true,
  login: true,
  senha: true,
  sexo: true,
  data_nascimento: true,
  data_admissao: true,
  data_demissao: true,
  data_estagio: true,
  cpf: true,
  carteira_identidade: true,
  carteira_trabalho: true,
  numero_pis: true,
  cep: true,
  tipo_logradouro: true,
  logradouro: true,
  numero: true,
  complemento: true,
  bairro: true,
  cidade: true,
  estado: true,
  telefone: true,
  celular: true,
  pix: true,
  email: true,
  contatos: true,
  hora_trabalho_entrada: true,
  hora_trabalho_saida: true,
  hora_almoco_inicio: true,
  hora_almoco_fim: true,
  trabalha_sabado: true,
  trabalha_domingo: true,
  regime_trabalho: true,
  vale_alimentacao: true,
  vale_transporte: true,
  foto: true,
  numero_antigo: true,
  observacoes: true,
  salario: true,
  comissao: true,
  insalubridade: true,
  implanta: true,
  lider_implantacao: true,
  consultor_implantacao: true,
  lista_pop_documento: true,
  endereco_ip_auditoria: true,
  nome_aplicacao_auditoria: true,
} satisfies Prisma.infotime_colaboradorSelect;

export type ColaboradorListaItemDto = {
  idColaborador: string;
  nome: string | null;
  cpf: string | null;
  email: string | null;
  celular: string | null;
  sexo: string | null;
  dataNascimento: string | null;
  dataAdmissao: string | null;
  idCargoClassificacaoNivel: string | null;
  cargoDescricao: string | null;
  idTipoColaborador: string | null;
  tipoColaboradorDescricao: string | null;
  idSituacaoColaborador: string | null;
  situacaoColaboradorDescricao: string | null;
};

@Injectable()
export class ColaboradorService {
  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private decParaNumero(v: unknown): number | null {
    if (v === null || v === undefined) return null;
    const n = Number(v);
    return Number.isFinite(n) ? n : null;
  }

  private parseIdBigintOpcional(
    value: string | undefined | null,
  ): bigint | null | undefined {
    if (value === undefined) return undefined;
    const t = (value ?? '').trim();
    if (t === '') return null;
    try {
      return BigInt(t);
    } catch {
      throw new BadRequestException('Identificador numérico inválido.');
    }
  }

  private parseDataSomenteDia(
    value: string | null | undefined,
  ): Date | null | undefined {
    if (value === undefined) return undefined;
    if (value === null || value.trim() === '') return null;
    const d = new Date(`${value.trim()}T12:00:00.000Z`);
    return Number.isNaN(d.getTime()) ? null : d;
  }

  /** Horário HH:mm → timestamp no dia base (1970-01-01 UTC) para colunas `timestamp` legadas. */
  private parseHoraDia(value: string | null | undefined): Date | null | undefined {
    if (value === undefined) return undefined;
    const s = (value ?? '').trim();
    if (s === '') return null;
    const m = /^(\d{1,2}):(\d{2})(?::(\d{2}))?$/.exec(s);
    if (!m) return null;
    const hh = Math.min(23, Math.max(0, parseInt(m[1], 10)));
    const mm = Math.min(59, Math.max(0, parseInt(m[2], 10)));
    const ss = m[3] ? Math.min(59, Math.max(0, parseInt(m[3], 10))) : 0;
    return new Date(Date.UTC(1970, 0, 1, hh, mm, ss));
  }

  private async mapaCargoDescricao(
    ids: bigint[],
  ): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_cargo_classificacao_nivel AS id, descricao
      FROM infotime_cargo_classificacao_nivel
      WHERE id_cargo_classificacao_nivel IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      map.set(r.id.toString(), r.descricao?.trim() ?? '');
    }
    return map;
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infotime_colaboradorWhereInput {
    const q = qTexto.trim();
    const contains = {
      contains: q,
      mode: Prisma.QueryMode.insensitive,
    } as const;
    if (campoPesquisa === 'buscaRapida') {
      return {
        OR: [
          { nome: contains },
          { cpf: contains },
          { email: contains },
          { celular: contains },
        ],
      };
    }
    switch (campoPesquisa) {
      case 'nome':
        return { nome: contains };
      case 'cpf':
        return { cpf: contains };
      case 'email':
        return { email: contains };
      case 'celular':
        return { celular: contains };
      case 'sexo':
        return { sexo: q.slice(0, 1).toUpperCase() };
      case 'idColaborador':
        try {
          return { id_colaborador: BigInt(q) };
        } catch {
          return {};
        }
      default:
        return {};
    }
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infotime_colaboradorWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'nome',
      'cpf',
      'idTipoColaborador',
      'idSituacaoColaborador',
      'idCargoClassificacaoNivel',
      'email',
      'idColaborador',
    ]);
    const partes: Prisma.infotime_colaboradorWhereInput[] = [];

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
        (campo === 'nome' || campo === 'cpf' || campo === 'email') &&
        tipo === 'texto'
      ) {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (!contem) continue;
        const contains = {
          contains: contem,
          mode: Prisma.QueryMode.insensitive,
        } as const;
        if (campo === 'nome') partes.push({ nome: contains });
        if (campo === 'cpf') partes.push({ cpf: contains });
        if (campo === 'email') partes.push({ email: contains });
      }

      if (
        (campo === 'idTipoColaborador' ||
          campo === 'idSituacaoColaborador' ||
          campo === 'idCargoClassificacaoNivel' ||
          campo === 'idColaborador') &&
        tipo === 'inteiro'
      ) {
        const n =
          typeof val['valor'] === 'number'
            ? val['valor']
            : parseInt(String(val['valor'] ?? ''), 10);
        if (!Number.isFinite(n)) continue;
        const b = BigInt(n);
        if (campo === 'idTipoColaborador')
          partes.push({ id_tipo_colaborador: b });
        if (campo === 'idSituacaoColaborador')
          partes.push({ id_situacao_colaborador: b });
        if (campo === 'idCargoClassificacaoNivel')
          partes.push({ id_cargo_classificacao_nivel: b });
        if (campo === 'idColaborador') partes.push({ id_colaborador: b });
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0] : { AND: partes };
  }

  private mapRow(
    r: {
      id_colaborador: bigint;
      nome: string | null;
      cpf: string | null;
      email: string | null;
      celular: string | null;
      sexo: string | null;
      data_nascimento: Date | null;
      data_admissao: Date | null;
      id_cargo_classificacao_nivel: bigint | null;
      id_tipo_colaborador: bigint | null;
      infotime_tipo_colaborador: { descricao: string | null } | null;
      id_situacao_colaborador: bigint | null;
      infotime_situacao_colaborador: { descricao: string | null } | null;
    },
    cargos: Map<string, string>,
  ): ColaboradorListaItemDto {
    const fmtDia = (d: Date | null) =>
      d == null
        ? null
        : `${d.getUTCFullYear()}-${String(d.getUTCMonth() + 1).padStart(2, '0')}-${String(d.getUTCDate()).padStart(2, '0')}`;
    return {
      idColaborador: r.id_colaborador.toString(),
      nome: r.nome,
      cpf: r.cpf,
      email: r.email,
      celular: r.celular,
      sexo: r.sexo,
      dataNascimento: fmtDia(r.data_nascimento),
      dataAdmissao: fmtDia(r.data_admissao),
      idCargoClassificacaoNivel:
        r.id_cargo_classificacao_nivel?.toString() ?? null,
      cargoDescricao:
        r.id_cargo_classificacao_nivel != null
          ? (cargos.get(r.id_cargo_classificacao_nivel.toString()) ?? null)
          : null,
      idTipoColaborador: r.id_tipo_colaborador?.toString() ?? null,
      tipoColaboradorDescricao:
        r.infotime_tipo_colaborador?.descricao?.trim() ?? null,
      idSituacaoColaborador: r.id_situacao_colaborador?.toString() ?? null,
      situacaoColaboradorDescricao:
        r.infotime_situacao_colaborador?.descricao?.trim() ?? null,
    };
  }

  async listarLookups(idTenacidade: bigint): Promise<{
    tiposColaborador: { id: string; descricao: string | null }[];
    situacoesColaborador: { id: string; descricao: string | null }[];
    cargosClassificacaoNivel: { id: string; descricao: string | null }[];
    empresas: { id: string; rotulo: string | null }[];
    bancos: { id: string; nome: string | null }[];
    agencias: { id: string; rotulo: string | null; idBanco: string | null }[];
  }> {
    const [tipos, situacoes, cargos, empresas, bancos, agencias] =
      await Promise.all([
        this.prisma.infotime_tipo_colaborador.findMany({
          where: { id_tenacidade: idTenacidade },
          select: { id_tipo_colaborador: true, descricao: true },
          orderBy: { descricao: 'asc' },
        }),
        this.prisma.infotime_situacao_colaborador.findMany({
          where: { id_tenacidade: idTenacidade },
          select: { id_situacao_colaborador: true, descricao: true },
          orderBy: { descricao: 'asc' },
        }),
        this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
          SELECT id_cargo_classificacao_nivel AS id, descricao
          FROM infotime_cargo_classificacao_nivel
          WHERE id_tenacidade = ${idTenacidade}
          ORDER BY descricao NULLS LAST
        `,
        this.prisma.$queryRaw<{ id: bigint; rotulo: string | null }[]>`
          SELECT id_empresa AS id,
            NULLIF(TRIM(COALESCE(nome_fantasia, '')), '') AS rotulo
          FROM infotime_empresa
          WHERE id_tenacidade = ${idTenacidade} AND COALESCE(ativo, 'N') = 'S'
          ORDER BY nome_fantasia NULLS LAST
        `,
        this.prisma.$queryRaw<{ id: bigint; nome: string | null }[]>`
          SELECT id_banco AS id, nome
          FROM infotime_banco
          WHERE id_tenacidade = ${idTenacidade}
          ORDER BY nome NULLS LAST
        `,
        this.prisma.$queryRaw<
          { id: bigint; codigo: string | null; nome: string | null; id_banco: bigint | null }[]
        >`
          SELECT id_agencia AS id, codigo, nome, id_banco
          FROM infotime_agencia
          WHERE id_tenacidade = ${idTenacidade}
          ORDER BY nome NULLS LAST
        `,
      ]);

    return {
      tiposColaborador: tipos.map((t) => ({
        id: t.id_tipo_colaborador.toString(),
        descricao: t.descricao,
      })),
      situacoesColaborador: situacoes.map((s) => ({
        id: s.id_situacao_colaborador.toString(),
        descricao: s.descricao,
      })),
      cargosClassificacaoNivel: cargos.map((c) => ({
        id: c.id.toString(),
        descricao: c.descricao,
      })),
      empresas: empresas.map((e) => ({
        id: e.id.toString(),
        rotulo: e.rotulo,
      })),
      bancos: bancos.map((b) => ({
        id: b.id.toString(),
        nome: b.nome,
      })),
      agencias: agencias.map((a) => ({
        id: a.id.toString(),
        idBanco: a.id_banco?.toString() ?? null,
        rotulo: [a.codigo?.trim(), a.nome?.trim()].filter(Boolean).join(' / '),
      })),
    };
  }

  emailsEmLote(): never {
    throw new NotImplementedException(
      'Envio de e-mails em lote ainda não está disponível na web.',
    );
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: ColaboradorListaItemDto[]; total: number }> {
    const baseWhere: Prisma.infotime_colaboradorWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const takeLegado = 500;

    if (!modoListagemCrudNovo(query)) {
      const linhas = await this.prisma.infotime_colaborador.findMany({
        where: baseWhere,
        orderBy: [{ nome: 'asc' }],
        select: selectLista,
        ...(todos === true ? {} : { take: takeLegado }),
      });
      const idsCargo = [
        ...new Set(
          linhas
            .map((x) => x.id_cargo_classificacao_nivel)
            .filter((x): x is bigint => x != null),
        ),
      ];
      const cargos = await this.mapaCargoDescricao(idsCargo);
      const dados = linhas.map((r) => this.mapRow(r, cargos));
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
      'buscaRapida',
      'nome',
      'cpf',
      'email',
      'celular',
      'sexo',
      'idColaborador',
    ]);

    let whereExtra: Prisma.infotime_colaboradorWhereInput = {};
    if (qTexto !== '' && campoPesquisa !== '') {
      if (!camposPesquisa.has(campoPesquisa)) {
        throw new BadRequestException(
          `campoPesquisa inválido: ${campoPesquisa}`,
        );
      }
      whereExtra = this.whereCampoPesquisa(campoPesquisa, qTexto);
    }

    const whereFiltro = this.whereFiltroRefinado(query?.filtroRefinado);
    const where = mergeWhereAnd(baseWhere, whereExtra, whereFiltro);

    const total = await this.prisma.infotime_colaborador.count({ where });

    const linhas = await this.prisma.infotime_colaborador.findMany({
      where,
      orderBy: [{ nome: 'asc' }],
      skip: pagina * tamanhoPagina,
      take: tamanhoPagina,
      select: selectLista,
    });

    const idsCargo = [
      ...new Set(
        linhas
          .map((x) => x.id_cargo_classificacao_nivel)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const cargos = await this.mapaCargoDescricao(idsCargo);

    return {
      dados: linhas.map((r) => this.mapRow(r, cargos)),
      total,
    };
  }

  private async assertExigeDataClt(
    idTenacidade: bigint,
    idTipoColaborador: bigint,
    dataAdmissao: Date | null | undefined,
  ): Promise<void> {
    const tipo = await this.prisma.infotime_tipo_colaborador.findFirst({
      where: {
        id_tipo_colaborador: idTipoColaborador,
        id_tenacidade: idTenacidade,
      },
      select: { exige_data_clt: true },
    });
    if ((tipo?.exige_data_clt ?? '').trim().toUpperCase() === 'S') {
      if (dataAdmissao == null) {
        throw new BadRequestException(
          'Atenção: data de admissão CLT obrigatória para esse tipo de funcionário!',
        );
      }
    }
  }

  private async assertDependenciasExclusao(
    idColaborador: bigint,
  ): Promise<void> {
    const [rowsTar, rowsTel] = await Promise.all([
      this.prisma.$queryRaw<{ n_tar: bigint }[]>`
        SELECT COUNT(*)::bigint AS n_tar FROM infotime_colaborador_tarifa
        WHERE id_colaborador = ${idColaborador}
      `,
      this.prisma.$queryRaw<{ n_tel: bigint }[]>`
        SELECT COUNT(*)::bigint AS n_tel FROM infotime_colaborador_telefone
        WHERE id_colaborador = ${idColaborador}
      `,
    ]);
    const nTar = rowsTar[0]?.n_tar ?? 0n;
    const nTel = rowsTel[0]?.n_tel ?? 0n;
    if (nTar > 0n || nTel > 0n) {
      throw new BadRequestException(
        'Não é possível excluir o colaborador pois existem registros vinculados.',
      );
    }
  }

  private montarDadosGravacao(
    dto: CriarColaboradorDto | AtualizarColaboradorDto,
  ): Record<string, unknown> {
    const row: Record<string, unknown> = {};
    if (dto.nome !== undefined) row['nome'] = dto.nome.trim();
    if (dto.apelido !== undefined) row['apelido'] = dto.apelido ?? null;
    if (dto.login !== undefined) row['login'] = dto.login?.trim() || null;
    if (dto.sexo !== undefined) row['sexo'] = dto.sexo?.trim() || null;
    if (dto.email !== undefined) row['email'] = dto.email?.trim() || null;
    if (dto.contatos !== undefined) row['contatos'] = dto.contatos ?? null;
    if (dto.idTipoColaborador !== undefined) {
      row['id_tipo_colaborador'] = this.parseIdBigintOpcional(dto.idTipoColaborador);
    }
    if (dto.idSituacaoColaborador !== undefined) {
      row['id_situacao_colaborador'] = this.parseIdBigintOpcional(
        dto.idSituacaoColaborador,
      );
    }
    if (dto.idEmpresa !== undefined) {
      row['id_empresa'] = this.parseIdBigintOpcional(dto.idEmpresa);
    }
    if (dto.implanta !== undefined) row['implanta'] = dto.implanta ?? null;
    if (dto.liderImplantacao !== undefined) {
      row['lider_implantacao'] = dto.liderImplantacao ?? null;
    }
    if (dto.consultorImplantacao !== undefined) {
      row['consultor_implantacao'] = dto.consultorImplantacao ?? null;
    }
    if (dto.cpf !== undefined) row['cpf'] = dto.cpf?.replace(/\D/g, '') || null;
    if (dto.carteiraIdentidade !== undefined) {
      row['carteira_identidade'] = dto.carteiraIdentidade ?? null;
    }
    if (dto.carteiraTrabalho !== undefined) {
      row['carteira_trabalho'] = dto.carteiraTrabalho ?? null;
    }
    if (dto.numeroPis !== undefined) row['numero_pis'] = dto.numeroPis ?? null;
    if (dto.idCargoClassificacaoNivel !== undefined) {
      row['id_cargo_classificacao_nivel'] = this.parseIdBigintOpcional(
        dto.idCargoClassificacaoNivel,
      );
    }
    if (dto.dataAdmissao !== undefined) {
      row['data_admissao'] = this.parseDataSomenteDia(dto.dataAdmissao);
    }
    if (dto.dataDemissao !== undefined) {
      row['data_demissao'] = this.parseDataSomenteDia(dto.dataDemissao);
    }
    if (dto.dataEstagio !== undefined) {
      row['data_estagio'] = this.parseDataSomenteDia(dto.dataEstagio);
    }
    if (dto.dataNascimento !== undefined) {
      row['data_nascimento'] = this.parseDataSomenteDia(dto.dataNascimento);
    }
    if (dto.regimeTrabalho !== undefined) {
      row['regime_trabalho'] = dto.regimeTrabalho ?? null;
    }
    if (dto.horaTrabalhoEntrada !== undefined) {
      row['hora_trabalho_entrada'] = this.parseHoraDia(dto.horaTrabalhoEntrada);
    }
    if (dto.horaTrabalhoSaida !== undefined) {
      row['hora_trabalho_saida'] = this.parseHoraDia(dto.horaTrabalhoSaida);
    }
    if (dto.horaAlmocoInicio !== undefined) {
      row['hora_almoco_inicio'] = this.parseHoraDia(dto.horaAlmocoInicio);
    }
    if (dto.horaAlmocoFim !== undefined) {
      row['hora_almoco_fim'] = this.parseHoraDia(dto.horaAlmocoFim);
    }
    if (dto.trabalhaSabado !== undefined) {
      row['trabalha_sabado'] = dto.trabalhaSabado ?? null;
    }
    if (dto.trabalhaDomingo !== undefined) {
      row['trabalha_domingo'] = dto.trabalhaDomingo ?? null;
    }
    if (dto.salario !== undefined) {
      row['salario'] =
        dto.salario === null || dto.salario === undefined
          ? null
          : dto.salario;
    }
    if (dto.comissao !== undefined) {
      row['comissao'] =
        dto.comissao === null || dto.comissao === undefined
          ? null
          : dto.comissao;
    }
    if (dto.insalubridade !== undefined) {
      row['insalubridade'] =
        dto.insalubridade === null || dto.insalubridade === undefined
          ? null
          : dto.insalubridade;
    }
    if (dto.valeAlimentacao !== undefined) {
      row['vale_alimentacao'] =
        dto.valeAlimentacao === null || dto.valeAlimentacao === undefined
          ? null
          : dto.valeAlimentacao;
    }
    if (dto.valeTransporte !== undefined) {
      row['vale_transporte'] =
        dto.valeTransporte === null || dto.valeTransporte === undefined
          ? null
          : dto.valeTransporte;
    }
    if (dto.idBanco !== undefined) {
      row['id_banco'] = this.parseIdBigintOpcional(dto.idBanco);
    }
    if (dto.idAgencia !== undefined) {
      row['id_agencia'] = this.parseIdBigintOpcional(dto.idAgencia);
    }
    if (dto.numeroConta !== undefined) {
      row['numero_conta'] = dto.numeroConta ?? null;
    }
    if (dto.cep !== undefined) row['cep'] = dto.cep?.replace(/\D/g, '') || null;
    if (dto.tipoLogradouro !== undefined) {
      row['tipo_logradouro'] = dto.tipoLogradouro ?? null;
    }
    if (dto.logradouro !== undefined) row['logradouro'] = dto.logradouro ?? null;
    if (dto.numero !== undefined) row['numero'] = dto.numero ?? null;
    if (dto.complemento !== undefined) {
      row['complemento'] = dto.complemento ?? null;
    }
    if (dto.bairro !== undefined) row['bairro'] = dto.bairro ?? null;
    if (dto.cidade !== undefined) row['cidade'] = dto.cidade ?? null;
    if (dto.estado !== undefined) row['estado'] = dto.estado ?? null;
    if (dto.latitude !== undefined) {
      row['latitude'] =
        dto.latitude === null || dto.latitude === undefined ? null : dto.latitude;
    }
    if (dto.longitude !== undefined) {
      row['longitude'] =
        dto.longitude === null || dto.longitude === undefined ? null : dto.longitude;
    }
    if (dto.telefone !== undefined) row['telefone'] = dto.telefone ?? null;
    if (dto.celular !== undefined) row['celular'] = dto.celular ?? null;
    if (dto.pix !== undefined) row['pix'] = dto.pix?.trim() || null;
    if (dto.observacoes !== undefined) row['observacoes'] = dto.observacoes ?? null;
    if (dto.idTipoEstadoCivil !== undefined) {
      row['id_tipo_estado_civil'] = this.parseIdBigintOpcional(
        dto.idTipoEstadoCivil,
      );
    }
    return row;
  }

  /** Evita 500 se o driver devolver timestamp como string/número ou valor inválido. */
  private horaParaHhMmSeguro(value: unknown): string | null {
    if (value == null) return null;
    let d: Date;
    if (value instanceof Date) {
      d = value;
    } else if (typeof value === 'string' || typeof value === 'number') {
      d = new Date(value);
    } else {
      return null;
    }
    if (Number.isNaN(d.getTime())) return null;
    const hh = String(d.getUTCHours()).padStart(2, '0');
    const mm = String(d.getUTCMinutes()).padStart(2, '0');
    return `${hh}:${mm}`;
  }

  private async serializarDetalhe(
    reg: Record<string, unknown>,
    idTenacidade: bigint,
  ): Promise<Record<string, unknown>> {
    const idCargo = reg['id_cargo_classificacao_nivel'] as bigint | null;
    let cargoDescricao: string | null = null;
    if (idCargo != null) {
      const m = await this.mapaCargoDescricao([idCargo]);
      cargoDescricao = m.get(idCargo.toString()) ?? null;
    }
    const idEmp = reg['id_empresa'] as bigint | null;
    let empresaRotulo: string | null = null;
    if (idEmp != null) {
      const [row] = await this.prisma.$queryRaw<{ rotulo: string | null }[]>`
        SELECT NULLIF(TRIM(COALESCE(nome_fantasia, '')), '') AS rotulo
        FROM infotime_empresa
        WHERE id_empresa = ${idEmp} AND id_tenacidade = ${idTenacidade}
        LIMIT 1
      `;
      empresaRotulo = row?.rotulo ?? null;
    }
    const idBanco = reg['id_banco'] as bigint | null;
    let bancoNome: string | null = null;
    if (idBanco != null) {
      const [b] = await this.prisma.$queryRaw<{ nome: string | null }[]>`
        SELECT nome FROM infotime_banco WHERE id_banco = ${idBanco} LIMIT 1
      `;
      bancoNome = b?.nome ?? null;
    }
    const idAg = reg['id_agencia'] as bigint | null;
    let agenciaRotulo: string | null = null;
    if (idAg != null) {
      const [a] = await this.prisma.$queryRaw<
        { codigo: string | null; nome: string | null }[]
      >`
        SELECT codigo, nome FROM infotime_agencia WHERE id_agencia = ${idAg} LIMIT 1
      `;
      if (a) {
        agenciaRotulo = [a.codigo?.trim(), a.nome?.trim()].filter(Boolean).join(' / ');
      }
    }

    const foto = reg['foto'] as Buffer | null | undefined;
    const temFoto = foto != null && Buffer.isBuffer(foto) && foto.length > 0;

    const out: Record<string, unknown> = {};
    for (const [k, v] of Object.entries(reg)) {
      if (k === 'senha' || k === 'foto') continue;
      out[k] = typeof v === 'bigint' ? v.toString() : v;
    }

    out['cargoDescricao'] = cargoDescricao;
    out['empresaRotulo'] = empresaRotulo;
    out['bancoNome'] = bancoNome;
    out['agenciaRotulo'] = agenciaRotulo;
    out['temFoto'] = temFoto;
    out['horaTrabalhoEntrada'] = this.horaParaHhMmSeguro(reg['hora_trabalho_entrada']);
    out['horaTrabalhoSaida'] = this.horaParaHhMmSeguro(reg['hora_trabalho_saida']);
    out['horaAlmocoInicio'] = this.horaParaHhMmSeguro(reg['hora_almoco_inicio']);
    out['horaAlmocoFim'] = this.horaParaHhMmSeguro(reg['hora_almoco_fim']);
    out['salario'] = this.decParaNumero(reg['salario']);
    out['comissao'] = this.decParaNumero(reg['comissao']);
    out['insalubridade'] = this.decParaNumero(reg['insalubridade']);
    out['valeAlimentacao'] = this.decParaNumero(reg['vale_alimentacao']);
    out['valeTransporte'] = this.decParaNumero(reg['vale_transporte']);
    /** Evita duplicar Decimal Prisma em snake_case — o front aceita camelCase e JSON fica estável. */
    delete out['vale_alimentacao'];
    delete out['vale_transporte'];
    /** Garante JSON estável (Decimal residual, etc.). */
    for (const key of Object.keys(out)) {
      const v = out[key];
      if (v instanceof Prisma.Decimal) {
        out[key] = this.decParaNumero(v);
      }
    }
    return out;
  }

  async obterPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: Record<string, unknown> }> {
    let idColaborador: bigint;
    try {
      idColaborador = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de colaborador inválido.');
    }

    const registro = await this.prisma.infotime_colaborador.findFirst({
      where: {
        id_colaborador: idColaborador,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: selectColaboradorDetalheSemGeo,
    });

    if (!registro) {
      throw new NotFoundException(`Colaborador ${id} não encontrado.`);
    }

    const json = Object.fromEntries(
      Object.entries(registro as object),
    ) as Record<string, unknown>;

    const dados = await this.serializarDetalhe(
      json,
      tenantContexto.idTenacidade,
    );
    return { dados };
  }

  async obterFotoBuffer(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ buffer: Buffer; contentType: string } | null> {
    let idColaborador: bigint;
    try {
      idColaborador = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de colaborador inválido.');
    }
    const row = await this.prisma.infotime_colaborador.findFirst({
      where: {
        id_colaborador: idColaborador,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { foto: true },
    });
    const foto = row?.foto;
    if (foto == null || !Buffer.isBuffer(foto) || foto.length === 0) {
      return null;
    }
    return { buffer: foto, contentType: 'image/jpeg' };
  }

  async criar(
    dto: CriarColaboradorDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const idTipo = BigInt(dto.idTipoColaborador);
    const idSit = BigInt(dto.idSituacaoColaborador);
    const dataAdm = this.parseDataSomenteDia(dto.dataAdmissao);
    await this.assertExigeDataClt(
      tenantContexto.idTenacidade,
      idTipo,
      dataAdm ?? null,
    );

    const dadosParciais = this.montarDadosGravacao(dto);
    if (dto.senha != null && dto.senha.length > 1) {
      dadosParciais['senha'] = crypto
        .createHash('md5')
        .update(dto.senha)
        .digest('hex');
    }

    const criacao = {
      ...(dadosParciais as object),
      id_tenacidade: tenantContexto.idTenacidade,
      id_tipo_colaborador: idTipo,
      id_situacao_colaborador: idSit,
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: this.fatiarIp(ip),
      nome_aplicacao_auditoria: APP,
    } satisfies Prisma.infotime_colaboradorUncheckedCreateInput;

    const criado = await this.prisma.infotime_colaborador.create({
      data: criacao,
      select: { id_colaborador: true },
    });

    return { id: criado.id_colaborador.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarColaboradorDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<void> {
    let idColaborador: bigint;
    try {
      idColaborador = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de colaborador inválido.');
    }

    const atual = await this.prisma.infotime_colaborador.findFirst({
      where: {
        id_colaborador: idColaborador,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: {
        id_tipo_colaborador: true,
        data_admissao: true,
      },
    });
    if (!atual) {
      throw new NotFoundException(`Colaborador ${id} não encontrado.`);
    }

    const idTipo =
      dto.idTipoColaborador !== undefined
        ? BigInt(dto.idTipoColaborador)
        : (atual.id_tipo_colaborador ?? 0n);
    const dataAdm =
      dto.dataAdmissao !== undefined
        ? this.parseDataSomenteDia(dto.dataAdmissao)
        : atual.data_admissao;
    if (idTipo > 0n) {
      await this.assertExigeDataClt(
        tenantContexto.idTenacidade,
        idTipo,
        dataAdm ?? null,
      );
    }

    const senhaParcial: Record<string, unknown> = {};
    if (dto.senha != null && dto.senha.length > 1) {
      senhaParcial['senha'] = crypto
        .createHash('md5')
        .update(dto.senha)
        .digest('hex');
    }

    const dadosParciais = this.montarDadosGravacao(dto);
    const updateData = {
      ...dadosParciais,
      ...senhaParcial,
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: this.fatiarIp(ip),
      nome_aplicacao_auditoria: APP,
    } as Prisma.infotime_colaboradorUncheckedUpdateInput;

    await this.prisma.infotime_colaborador.updateMany({
      where: {
        id_colaborador: idColaborador,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      data: updateData,
    });
  }

  async excluir(id: string, tenantContexto: TenantContexto): Promise<void> {
    let idColaborador: bigint;
    try {
      idColaborador = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de colaborador inválido.');
    }

    const existe = await this.prisma.infotime_colaborador.findFirst({
      where: {
        id_colaborador: idColaborador,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_colaborador: true },
    });
    if (!existe) {
      throw new NotFoundException(`Colaborador ${id} não encontrado.`);
    }

    await this.assertDependenciasExclusao(idColaborador);

    await this.prisma.infotime_colaborador.deleteMany({
      where: {
        id_colaborador: idColaborador,
        id_tenacidade: tenantContexto.idTenacidade,
      },
    });
  }
}
