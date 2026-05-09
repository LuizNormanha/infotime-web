import {
  BadRequestException,
  ForbiddenException,
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
import { AtualizarClienteDto } from './dto/atualizar-cliente.dto';
import { CriarClienteDto } from './dto/criar-cliente.dto';

const APP = 'infotime-web';
const IP_MAX = 50;
const TENANT_MASTER = BigInt(1);
const SITUACAO_ATIVO_PADRAO = BigInt(1);
/** Situação cliente legado em que CNPJ/CPF é opcional. */
const SITUACAO_SEM_DOCUMENTO_OBRIGATORIO = BigInt(3);

const selectLista = {
  id_cliente: true,
  id_tipo_cliente: true,
  razao_social: true,
  tipo_pessoa: true,
  nome_fantasia: true,
  contatos: true,
  id_situacao_cliente: true,
  cnpj: true,
  cidade: true,
  estado: true,
  telefone: true,
  celular: true,
  email: true,
  id_cliente_canal: true,
  numero_antigo: true,
  _count: { select: { unidades: true } },
} as const;

export type ClienteListaItemDto = {
  idCliente: string;
  nomeFantasia: string | null;
  razaoSocial: string | null;
  tipoPessoa: string | null;
  cnpj: string | null;
  cidade: string | null;
  estado: string | null;
  telefone: string | null;
  celular: string | null;
  email: string | null;
  contatos: string | null;
  idSituacaoCliente: string | null;
  situacaoClienteDescricao: string | null;
  idTipoCliente: string | null;
  tipoClienteDescricao: string | null;
  idClienteCanal: string | null;
  canalDescricao: string | null;
  unidades: number;
};

@Injectable()
export class ClienteService {
  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private parseIdOpcionalFk(value: unknown): bigint | null {
    if (value === '' || value === undefined) return null;
    if (value === null) return null;
    try {
      return BigInt(
        typeof value === 'number' ? Math.trunc(value) : String(value).trim(),
      );
    } catch {
      throw new BadRequestException('Identificador numérico inválido.');
    }
  }

  private apenasDigitos(s: string | null | undefined): string {
    if (!s) return '';
    return s.replace(/\D/g, '');
  }

  private parseDataSomenteDia(
    value: string | null | undefined,
  ): Date | null | undefined {
    if (value === undefined) return undefined;
    if (value === null || value.trim() === '') return null;
    const d = new Date(`${value.trim()}T12:00:00.000Z`);
    return Number.isNaN(d.getTime()) ? null : d;
  }

  private parseDataTimestamp(
    value: string | null | undefined,
  ): Date | null | undefined {
    if (value === undefined) return undefined;
    if (value === null || value.trim() === '') return null;
    const d = new Date(value.trim());
    return Number.isNaN(d.getTime()) ? null : d;
  }

  private validarDocumentoPorSituacao(
    idSituacaoCliente: bigint | undefined | null,
    cnpj: string | null | undefined,
  ): void {
    if (idSituacaoCliente === SITUACAO_SEM_DOCUMENTO_OBRIGATORIO) return;
    const doc = this.apenasDigitos(cnpj ?? '');
    if (doc.length === 0) {
      throw new BadRequestException(
        'CNPJ ou CPF é obrigatório para a situação informada.',
      );
    }
  }

  private async assertClienteDevedorNaoReduzExpiracao(opts: {
    idCliente: bigint;
    novaData: Date | null | undefined;
    dataAtual: Date | null;
    clientePublico: string | null | undefined;
    idTenacidadeJwt: bigint;
  }): Promise<void> {
    if (opts.idTenacidadeJwt !== TENANT_MASTER) return;
    if (opts.clientePublico === 'S') return;
    if (opts.novaData === undefined) return;
    const novo =
      opts.novaData === null
        ? null
        : new Date(
            Date.UTC(
              opts.novaData.getFullYear(),
              opts.novaData.getMonth(),
              opts.novaData.getDate(),
            ),
          );
    const atual =
      opts.dataAtual === null || opts.dataAtual === undefined
        ? null
        : new Date(
            Date.UTC(
              opts.dataAtual.getFullYear(),
              opts.dataAtual.getMonth(),
              opts.dataAtual.getDate(),
            ),
          );
    if (novo === null && atual === null) return;
    if (novo === null || atual === null) return;
    if (novo.getTime() >= atual.getTime()) return;

    const [{ n }] = await this.prisma.$queryRaw<[{ n: bigint }]>`
      SELECT COUNT(*)::bigint AS n
      FROM infotime_lancamento_receita lr
      WHERE lr.id_cliente = ${opts.idCliente}
        AND lr.id_tenacidade = ${TENANT_MASTER}
        AND lr.id_situacao_documento IN (238::bigint, 1::bigint, 73::bigint, 2::bigint)
        AND lr.data_previsao IS NOT NULL
        AND lr.data_previsao < NOW()
    `;
    if (n > 0n) {
      throw new ForbiddenException(
        'Alteração da data de expiração não permitida. Cliente devedor.',
      );
    }
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infotime_clienteWhereInput {
    const q = qTexto.trim();
    const contains = { contains: q, mode: Prisma.QueryMode.insensitive } as const;
    switch (campoPesquisa) {
      case 'nomeFantasia':
        return { nome_fantasia: contains };
      case 'razaoSocial':
        return { razao_social: contains };
      case 'tipoPessoa':
        return { tipo_pessoa: q.slice(0, 1).toUpperCase() };
      case 'cnpj':
        return { cnpj: contains };
      case 'cidade':
        return { cidade: contains };
      case 'estado':
        return { estado: q.slice(0, 2).toUpperCase() };
      case 'telefone':
        return { telefone: contains };
      case 'celular':
        return { celular: contains };
      case 'email':
        return { email: contains };
      case 'idCliente':
        try {
          return { id_cliente: BigInt(q) };
        } catch {
          return {};
        }
      default:
        return {};
    }
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infotime_clienteWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'nomeFantasia',
      'idTipoCliente',
      'idSituacaoCliente',
      'cnpj',
      'cidade',
      'estado',
      'telefone',
      'celular',
      'email',
    ]);
    const partes: Prisma.infotime_clienteWhereInput[] = [];

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
        (campo === 'nomeFantasia' ||
          campo === 'cnpj' ||
          campo === 'cidade' ||
          campo === 'telefone' ||
          campo === 'celular' ||
          campo === 'email') &&
        tipo === 'texto'
      ) {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (!contem) continue;
        const contains = {
          contains: contem,
          mode: Prisma.QueryMode.insensitive,
        } as const;
        if (campo === 'nomeFantasia') partes.push({ nome_fantasia: contains });
        if (campo === 'cnpj') partes.push({ cnpj: contains });
        if (campo === 'cidade') partes.push({ cidade: contains });
        if (campo === 'telefone') partes.push({ telefone: contains });
        if (campo === 'celular') partes.push({ celular: contains });
        if (campo === 'email') partes.push({ email: contains });
      }

      if (campo === 'estado' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (!contem) continue;
        partes.push({ estado: contem.slice(0, 2).toUpperCase() });
      }

      if (
        (campo === 'idTipoCliente' || campo === 'idSituacaoCliente') &&
        tipo === 'inteiro'
      ) {
        const igual =
          typeof val['igual'] === 'string' ? val['igual'].trim() : '';
        if (!igual) continue;
        try {
          const id = BigInt(igual);
          if (campo === 'idTipoCliente') partes.push({ id_tipo_cliente: id });
          if (campo === 'idSituacaoCliente') {
            partes.push({ id_situacao_cliente: id });
          }
        } catch {
          continue;
        }
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  private async carregarMapasDescricao(opts: {
    idsSituacao: bigint[];
    idsTipo: bigint[];
    idsCanal: bigint[];
    idTenacidade: bigint;
  }): Promise<{
    situacao: Map<string, string>;
    tipo: Map<string, string>;
    canal: Map<string, string>;
  }> {
    const situacao = new Map<string, string>();
    const tipo = new Map<string, string>();
    const canal = new Map<string, string>();

    if (opts.idsSituacao.length > 0) {
      const rows = await this.prisma.$queryRaw<
        { id: bigint; descricao: string | null }[]
      >(Prisma.sql`
        SELECT id_situacao_cliente AS id, descricao
        FROM infotime_situacao_cliente
        WHERE id_situacao_cliente IN (${Prisma.join(opts.idsSituacao)})
          AND (id_tenacidade IS NULL OR id_tenacidade = ${opts.idTenacidade})
      `);
      for (const r of rows) {
        situacao.set(r.id.toString(), r.descricao?.trim() ?? '');
      }
    }

    if (opts.idsTipo.length > 0) {
      const rows = await this.prisma.$queryRaw<
        { id: bigint; descricao: string | null }[]
      >(Prisma.sql`
        SELECT id_tipo_cliente AS id, descricao
        FROM infotime_tipo_cliente
        WHERE id_tipo_cliente IN (${Prisma.join(opts.idsTipo)})
          AND (id_tenacidade IS NULL OR id_tenacidade = ${opts.idTenacidade})
      `);
      for (const r of rows) {
        tipo.set(r.id.toString(), r.descricao?.trim() ?? '');
      }
    }

    if (opts.idsCanal.length > 0) {
      const rows = await this.prisma.$queryRaw<
        { id: bigint; descricao: string | null }[]
      >(Prisma.sql`
        SELECT id_cliente_canal AS id, descricao
        FROM infotime_cliente_canal
        WHERE id_cliente_canal IN (${Prisma.join(opts.idsCanal)})
          AND (id_tenacidade IS NULL OR id_tenacidade = ${opts.idTenacidade})
      `);
      for (const r of rows) {
        canal.set(r.id.toString(), r.descricao?.trim() ?? '');
      }
    }

    return { situacao, tipo, canal };
  }

  async listarLookups(idTenacidade: bigint): Promise<{
    situacoesCliente: { id: string; descricao: string | null }[];
    tiposCliente: { id: string; descricao: string | null }[];
    contasCaixa: { id: string; rotulo: string | null }[];
    canais: { id: string; descricao: string | null }[];
    concorrentes: { id: string; rotulo: string | null }[];
    municipios: { id: string; rotulo: string | null }[];
    regioesEstaduais: { id: string; rotulo: string | null }[];
  }> {
    const [
      situacoesCliente,
      tiposCliente,
      contasCaixa,
      canais,
      concorrentes,
      municipios,
      regioesEstaduais,
    ] = await Promise.all([
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_situacao_cliente AS id, descricao
        FROM infotime_situacao_cliente
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_tipo_cliente AS id, descricao
        FROM infotime_tipo_cliente
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_conta_caixa AS id, descricao
        FROM infotime_conta_caixa
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_cliente_canal AS id, descricao
        FROM infotime_cliente_canal
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
      this.prisma.$queryRaw<
        { id: bigint; nome_fantasia: string | null; nome_sistema: string | null }[]
      >`
        SELECT id_concorrente AS id, nome_fantasia, nome_sistema
        FROM infotime_concorrente
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY nome_fantasia NULLS LAST
      `,
      this.prisma.$queryRaw<{ id: bigint; nome: string | null; uf: string | null }[]>`
        SELECT id_municipio AS id, nome, uf
        FROM infotime_municipio
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY nome NULLS LAST
        LIMIT 5000
      `,
      this.prisma.$queryRaw<{ id: bigint; descricao: string | null }[]>`
        SELECT id_regiao_estadual AS id, descricao
        FROM infotime_regiao_estadual
        WHERE id_tenacidade IS NULL OR id_tenacidade = ${idTenacidade}
        ORDER BY descricao NULLS LAST
      `,
    ]);

    return {
      situacoesCliente: situacoesCliente.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      tiposCliente: tiposCliente.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      contasCaixa: contasCaixa.map((r) => ({
        id: r.id.toString(),
        rotulo: r.descricao,
      })),
      canais: canais.map((r) => ({
        id: r.id.toString(),
        descricao: r.descricao,
      })),
      concorrentes: concorrentes.map((r) => ({
        id: r.id.toString(),
        rotulo:
          (r.nome_fantasia ?? '').trim() ||
          (r.nome_sistema ?? '').trim() ||
          r.id.toString(),
      })),
      municipios: municipios.map((r) => ({
        id: r.id.toString(),
        rotulo:
          [r.nome, r.uf].filter(Boolean).join(' / ') || r.id.toString(),
      })),
      regioesEstaduais: regioesEstaduais.map((r) => ({
        id: r.id.toString(),
        rotulo: r.descricao,
      })),
    };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: ClienteListaItemDto[]; total: number }> {
    // Escopo: sempre o tenant do JWT (`tenantId`). Se os clientes estão em id_tenacidade=1,
    // o usuário precisa estar logado com esse mesmo tenant no token (ver usuário / login).
    const baseWhere: Prisma.infotime_clienteWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const mapRow = (
      r: {
        id_cliente: bigint;
        id_tipo_cliente: bigint | null;
        razao_social: string | null;
        tipo_pessoa: string | null;
        nome_fantasia: string | null;
        contatos: string | null;
        id_situacao_cliente: bigint | null;
        cnpj: string | null;
        cidade: string | null;
        estado: string | null;
        telefone: string | null;
        celular: string | null;
        email: string | null;
        id_cliente_canal: bigint | null;
        numero_antigo: bigint | null;
        _count: { unidades: number };
      },
      maps: {
        situacao: Map<string, string>;
        tipo: Map<string, string>;
        canal: Map<string, string>;
      },
    ): ClienteListaItemDto => ({
      idCliente: r.id_cliente.toString(),
      nomeFantasia: r.nome_fantasia,
      razaoSocial: r.razao_social,
      tipoPessoa: r.tipo_pessoa,
      cnpj: r.cnpj,
      cidade: r.cidade,
      estado: r.estado,
      telefone: r.telefone,
      celular: r.celular,
      email: r.email,
      contatos: r.contatos,
      idSituacaoCliente: r.id_situacao_cliente?.toString() ?? null,
      situacaoClienteDescricao:
        r.id_situacao_cliente != null
          ? maps.situacao.get(r.id_situacao_cliente.toString()) ?? null
          : null,
      idTipoCliente: r.id_tipo_cliente?.toString() ?? null,
      tipoClienteDescricao:
        r.id_tipo_cliente != null
          ? maps.tipo.get(r.id_tipo_cliente.toString()) ?? null
          : null,
      idClienteCanal: r.id_cliente_canal?.toString() ?? null,
      canalDescricao:
        r.id_cliente_canal != null
          ? maps.canal.get(r.id_cliente_canal.toString()) ?? null
          : null,
      unidades: r._count.unidades,
    });

    const takeLegado = 500;

    if (!modoListagemCrudNovo(query)) {
      const linhas = await this.prisma.infotime_cliente.findMany({
        where: baseWhere,
        orderBy: [{ nome_fantasia: 'asc' }],
        select: selectLista,
        ...(todos === true ? {} : { take: takeLegado }),
      });
      const idsSituacao = [
        ...new Set(
          linhas
            .map((x) => x.id_situacao_cliente)
            .filter((x): x is bigint => x != null),
        ),
      ];
      const idsTipo = [
        ...new Set(
          linhas
            .map((x) => x.id_tipo_cliente)
            .filter((x): x is bigint => x != null),
        ),
      ];
      const idsCanal = [
        ...new Set(
          linhas
            .map((x) => x.id_cliente_canal)
            .filter((x): x is bigint => x != null),
        ),
      ];
      const maps = await this.carregarMapasDescricao({
        idsSituacao,
        idsTipo,
        idsCanal,
        idTenacidade: tenantContexto.idTenacidade,
      });
      const dados = linhas.map((r) => mapRow(r, maps));
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
      'nomeFantasia',
      'razaoSocial',
      'tipoPessoa',
      'cnpj',
      'cidade',
      'estado',
      'telefone',
      'celular',
      'email',
      'idCliente',
    ]);

    let whereExtra: Prisma.infotime_clienteWhereInput = {};
    if (qTexto !== '' && campoPesquisa !== '') {
      if (!camposPesquisa.has(campoPesquisa)) {
        throw new BadRequestException(`campoPesquisa inválido: ${campoPesquisa}`);
      }
      whereExtra = this.whereCampoPesquisa(campoPesquisa, qTexto);
    }

    const whereFiltro = this.whereFiltroRefinado(query?.filtroRefinado);
    const where = mergeWhereAnd(baseWhere, whereExtra, whereFiltro);

    const total = await this.prisma.infotime_cliente.count({ where });

    const linhas = await this.prisma.infotime_cliente.findMany({
      where,
      orderBy: [{ nome_fantasia: 'asc' }],
      skip: pagina * tamanhoPagina,
      take: tamanhoPagina,
      select: selectLista,
    });

    const idsSituacao = [
      ...new Set(
        linhas
          .map((x) => x.id_situacao_cliente)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsTipo = [
      ...new Set(
        linhas
          .map((x) => x.id_tipo_cliente)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const idsCanal = [
      ...new Set(
        linhas
          .map((x) => x.id_cliente_canal)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const maps = await this.carregarMapasDescricao({
      idsSituacao,
      idsTipo,
      idsCanal,
      idTenacidade: tenantContexto.idTenacidade,
    });

    return {
      dados: linhas.map((r) => mapRow(r, maps)),
      total,
    };
  }

  private montarDadosGravacao(
    dto: CriarClienteDto | AtualizarClienteDto,
    incluirDefaultsTipoPessoa: boolean,
  ): Record<string, unknown> {
    const tipo =
      dto.tipoPessoa?.trim().toUpperCase() ||
      (incluirDefaultsTipoPessoa ? 'J' : undefined);

    const row: Record<string, unknown> = {};
    if (dto.razaoSocial !== undefined) row['razao_social'] = dto.razaoSocial;
    if (dto.nomeFantasia !== undefined) row['nome_fantasia'] = dto.nomeFantasia;
    if (tipo !== undefined) row['tipo_pessoa'] = tipo;
    if (dto.sexo !== undefined) row['sexo'] = dto.sexo ?? null;
    const dn = this.parseDataTimestamp(dto.dataNascimento ?? undefined);
    if (dn !== undefined) row['data_nascimento'] = dn;
    if (dto.telefone !== undefined) row['telefone'] = dto.telefone ?? null;
    if (dto.celular !== undefined) row['celular'] = dto.celular ?? null;
    if (dto.email !== undefined) row['email'] = dto.email ?? null;
    if (dto.contatos !== undefined) row['contatos'] = dto.contatos ?? null;
    if (dto.idSituacaoCliente !== undefined) {
      row['id_situacao_cliente'] = BigInt(dto.idSituacaoCliente);
    }
    if (dto.idContaCaixa !== undefined) {
      row['id_conta_caixa'] = BigInt(dto.idContaCaixa);
    }
    if (dto.idMunicipio !== undefined) {
      row['id_municipio'] =
        dto.idMunicipio === null ? null : BigInt(dto.idMunicipio);
    }
    if (dto.idClienteCanal !== undefined) {
      row['id_cliente_canal'] = this.parseIdOpcionalFk(dto.idClienteCanal);
    }
    if (dto.idClientePai !== undefined) {
      row['id_cliente_pai'] = this.parseIdOpcionalFk(dto.idClientePai);
    }
    if (dto.idTipoCliente !== undefined) {
      row['id_tipo_cliente'] = this.parseIdOpcionalFk(dto.idTipoCliente);
    }
    if (dto.idConcorrente !== undefined) {
      row['id_concorrente'] = this.parseIdOpcionalFk(dto.idConcorrente);
    }
    if (dto.idRegiaoEstadual !== undefined) {
      row['id_regiao_estadual'] = this.parseIdOpcionalFk(dto.idRegiaoEstadual);
    }
    if (dto.cnpj !== undefined) row['cnpj'] = dto.cnpj ?? null;
    if (dto.inscricaoEstadual !== undefined) {
      row['inscricao_estadual'] = dto.inscricaoEstadual ?? null;
    }
    if (dto.inscricaoMunicipal !== undefined) {
      row['inscricao_municipal'] = dto.inscricaoMunicipal ?? null;
    }
    if (dto.cep !== undefined) row['cep'] = dto.cep ?? null;
    if (dto.tipoLogradouro !== undefined) {
      row['tipo_logradouro'] = dto.tipoLogradouro ?? null;
    }
    if (dto.logradouro !== undefined) row['logradouro'] = dto.logradouro ?? null;
    if (dto.numero !== undefined) row['numero'] = dto.numero ?? null;
    if (dto.complemento !== undefined) row['complemento'] = dto.complemento ?? null;
    if (dto.bairro !== undefined) row['bairro'] = dto.bairro ?? null;
    if (dto.cidade !== undefined) row['cidade'] = dto.cidade ?? null;
    if (dto.estado !== undefined) row['estado'] = dto.estado ?? null;
    if (dto.latitude !== undefined) row['latitude'] = dto.latitude;
    if (dto.longitude !== undefined) row['longitude'] = dto.longitude;
    if (dto.homepage !== undefined) row['home_page'] = dto.homepage ?? null;
    if (dto.emiteBoleto !== undefined) row['emite_boleto'] = dto.emiteBoleto ?? null;
    const dexp = this.parseDataSomenteDia(dto.dataExpiracao ?? undefined);
    if (dexp !== undefined) row['data_expiracao'] = dexp;
    if (dto.qtdLicenca !== undefined) row['qtd_licenca'] = dto.qtdLicenca;
    if (dto.clientePublico !== undefined) {
      row['cliente_publico'] = dto.clientePublico ?? null;
    }
    if (dto.observacoes !== undefined) row['observacoes'] = dto.observacoes ?? null;
    if (dto.certificadoRegistro !== undefined) {
      row['certificado_registro'] = dto.certificadoRegistro ?? null;
    }
    const dem = this.parseDataSomenteDia(dto.dataEmissaoCr ?? undefined);
    if (dem !== undefined) row['data_emissao_cr'] = dem;
    const dvm = this.parseDataSomenteDia(dto.dataValidadeCr ?? undefined);
    if (dvm !== undefined) row['data_validade_cr'] = dvm;

    return row;
  }

  async obterPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: Record<string, unknown> }> {
    let idCliente: bigint;
    try {
      idCliente = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de cliente inválido.');
    }

    const registro = await this.prisma.infotime_cliente.findFirst({
      where: {
        id_cliente: idCliente,
        id_tenacidade: tenantContexto.idTenacidade,
      },
    });

    if (!registro) {
      throw new NotFoundException(`Cliente ${id} não encontrado.`);
    }

    const maps = await this.carregarMapasDescricao({
      idsSituacao:
        registro.id_situacao_cliente != null ? [registro.id_situacao_cliente] : [],
      idsTipo: registro.id_tipo_cliente != null ? [registro.id_tipo_cliente] : [],
      idsCanal:
        registro.id_cliente_canal != null ? [registro.id_cliente_canal] : [],
      idTenacidade: tenantContexto.idTenacidade,
    });

    const json = Object.fromEntries(
      Object.entries(registro).map(([k, v]) => [
        k,
        typeof v === 'bigint' ? v.toString() : v,
      ]),
    ) as Record<string, unknown>;

    json['situacaoClienteDescricao'] =
      registro.id_situacao_cliente != null
        ? maps.situacao.get(registro.id_situacao_cliente.toString()) ?? null
        : null;
    json['tipoClienteDescricao'] =
      registro.id_tipo_cliente != null
        ? maps.tipo.get(registro.id_tipo_cliente.toString()) ?? null
        : null;
    json['canalDescricao'] =
      registro.id_cliente_canal != null
        ? maps.canal.get(registro.id_cliente_canal.toString()) ?? null
        : null;

    return { dados: json };
  }

  async criar(
    dto: CriarClienteDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const idSit = BigInt(dto.idSituacaoCliente);
    this.validarDocumentoPorSituacao(idSit, dto.cnpj ?? null);

    const dadosParciais = this.montarDadosGravacao(dto, true);

    const criacao = {
      ...(dadosParciais as object),
      id_tenacidade: tenantContexto.idTenacidade,
      tipo_pessoa: (dadosParciais['tipo_pessoa'] as string | undefined) ?? 'J',
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: this.fatiarIp(ip),
      nome_aplicacao_auditoria: APP,
      ...(tenantContexto.idTenacidade === TENANT_MASTER &&
      idSit === SITUACAO_ATIVO_PADRAO
        ? { chave_acesso: crypto.randomUUID() }
        : {}),
    } satisfies Prisma.infotime_clienteUncheckedCreateInput;

    const criado = await this.prisma.infotime_cliente.create({
      data: criacao,
      select: { id_cliente: true },
    });

    return { id: criado.id_cliente.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarClienteDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<void> {
    let idCliente: bigint;
    try {
      idCliente = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de cliente inválido.');
    }

    const atual = await this.prisma.infotime_cliente.findFirst({
      where: {
        id_cliente: idCliente,
        id_tenacidade: tenantContexto.idTenacidade,
      },
    });
    if (!atual) {
      throw new NotFoundException(`Cliente ${id} não encontrado.`);
    }

    const idSitFinal =
      dto.idSituacaoCliente !== undefined
        ? BigInt(dto.idSituacaoCliente)
        : atual.id_situacao_cliente;
    const cnpjFinal =
      dto.cnpj !== undefined ? dto.cnpj : atual.cnpj;
    this.validarDocumentoPorSituacao(idSitFinal, cnpjFinal);

    await this.assertClienteDevedorNaoReduzExpiracao({
      idCliente,
      novaData: this.parseDataSomenteDia(dto.dataExpiracao ?? undefined),
      dataAtual: atual.data_expiracao,
      clientePublico:
        dto.clientePublico !== undefined
          ? dto.clientePublico
          : atual.cliente_publico,
      idTenacidadeJwt: tenantContexto.idTenacidade,
    });

    const patch = this.montarDadosGravacao(dto, false);
    delete patch['tipo_pessoa'];
    if (dto.tipoPessoa !== undefined) {
      patch['tipo_pessoa'] =
        dto.tipoPessoa.trim() === '' ? null : dto.tipoPessoa.toUpperCase();
    }

    await this.prisma.infotime_cliente.update({
      where: { id_cliente: idCliente },
      data: {
        ...(patch as Prisma.infotime_clienteUncheckedUpdateInput),
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
      },
    });
  }

  async excluir(id: string, tenantContexto: TenantContexto): Promise<void> {
    let idCliente: bigint;
    try {
      idCliente = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de cliente inválido.');
    }

    const atual = await this.prisma.infotime_cliente.findFirst({
      where: {
        id_cliente: idCliente,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_cliente: true },
    });
    if (!atual) {
      throw new NotFoundException(`Cliente ${id} não encontrado.`);
    }

    try {
      await this.prisma.infotime_cliente.delete({
        where: { id_cliente: idCliente },
      });
    } catch (e: unknown) {
      const code =
        typeof e === 'object' && e !== null && 'code' in e
          ? String((e as { code?: string }).code)
          : '';
      if (code === 'P2003') {
        throw new BadRequestException(
          'Não é possível excluir: existem registros dependentes deste cliente.',
        );
      }
      throw e;
    }
  }

  async gerarChaveAcesso(
    id: string,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ chaveAcesso: string }> {
    if (tenantContexto.idTenacidade !== TENANT_MASTER) {
      throw new ForbiddenException(
        'Operação permitida apenas para o tenant principal.',
      );
    }

    let idCliente: bigint;
    try {
      idCliente = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de cliente inválido.');
    }

    const atual = await this.prisma.infotime_cliente.findFirst({
      where: {
        id_cliente: idCliente,
        id_tenacidade: tenantContexto.idTenacidade,
      },
    });
    if (!atual) {
      throw new NotFoundException(`Cliente ${id} não encontrado.`);
    }

    if (atual.id_situacao_cliente !== SITUACAO_ATIVO_PADRAO) {
      throw new BadRequestException(
        'Gerar chave só é permitido para cliente ativo (situação 1).',
      );
    }

    const chaveAtual = (atual.chave_acesso ?? '').trim();
    if (chaveAtual.length >= 5) {
      throw new BadRequestException('Cliente já possui chave de acesso.');
    }

    const chave = crypto.randomUUID();
    await this.prisma.infotime_cliente.update({
      where: { id_cliente: idCliente },
      data: {
        chave_acesso: chave,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
      },
    });

    return { chaveAcesso: chave };
  }

  emailsEmLote(): never {
    throw new NotImplementedException(
      'Envio de e-mails em lote para clientes ainda não está implementado.',
    );
  }

  downloadLicenca(): never {
    throw new NotImplementedException(
      'Download de licença ainda não está implementado nesta versão.',
    );
  }
}
