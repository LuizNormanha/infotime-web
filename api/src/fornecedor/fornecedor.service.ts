import {
  BadRequestException,
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma, type infotime_fornecedor } from '@prisma/client';

import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { mergeWhereAnd } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  modoListagemCrudNovo,
  parseJsonFiltroRefinado,
  parsePaginaETamanhoPagina,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarFornecedorDto } from './dto/atualizar-fornecedor.dto';
import { CriarFornecedorDto } from './dto/criar-fornecedor.dto';

const APP = 'infotime-web';
const IP_MAX = 50;

const selectLista = {
  id_fornecedor: true,
  tipo_pessoa: true,
  nome_fantasia: true,
  cnpj: true,
  cidade: true,
  estado: true,
  telefone: true,
  celular: true,
  email: true,
  id_situacao_fornecedor: true,
  fabricante: true,
  contatos: true,
} as const;

/** Leitura quando o banco ainda não recebeu a migration de latitude/longitude. */
const fornecedorSelectSemCoordenadas = {
  id_fornecedor: true,
  id_tenacidade: true,
  id_situacao_fornecedor: true,
  id_usuario_auditoria: true,
  tipo_pessoa: true,
  razao_social: true,
  nome_fantasia: true,
  cnpj: true,
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
  email: true,
  home_page: true,
  contatos: true,
  numero_antigo: true,
  observacoes: true,
  fabricante: true,
  endereco_ip_auditoria: true,
  nome_aplicacao_auditoria: true,
} as const satisfies Prisma.infotime_fornecedorSelect;

export type FornecedorListaItemDto = {
  idFornecedor: string;
  nomeFantasia: string | null;
  tipoPessoa: string | null;
  cnpj: string | null;
  cidade: string | null;
  estado: string | null;
  telefone: string | null;
  celular: string | null;
  email: string | null;
  idSituacaoFornecedor: string | null;
  situacaoFornecedorDescricao: string | null;
  fabricante: boolean;
  contatos: string | null;
};

@Injectable()
export class FornecedorService {
  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private apenasDigitos(s: string | null | undefined): string {
    if (!s) return '';
    return s.replace(/\D/g, '');
  }

  /**
   * Ambiente sem migration `latitude`/`longitude`: o Prisma inclui essas colunas no SELECT
   * e o Postgres responde com erro (ex.: 42703). Detectamos de forma conservadora para repetir a leitura sem as colunas.
   */
  private erroProvavelColunasCoordenadasAusentesNoBanco(e: unknown): boolean {
    const msg =
      e instanceof Error
        ? `${e.name} ${e.message}`
        : typeof e === 'object' && e !== null && 'message' in e
          ? String((e as { message?: unknown }).message)
          : String(e);
    const m = msg.toLowerCase();
    return (
      (m.includes('latitude') || m.includes('longitude')) &&
      (m.includes('does not exist') ||
        m.includes('não existe') ||
        m.includes('42703'))
    );
  }

  private async carregarFornecedorParaDetalhe(
    where: Prisma.infotime_fornecedorWhereInput,
  ): Promise<infotime_fornecedor | null> {
    try {
      return await this.prisma.infotime_fornecedor.findFirst({ where });
    } catch (e: unknown) {
      if (!this.erroProvavelColunasCoordenadasAusentesNoBanco(e)) {
        throw e;
      }
      const parcial = await this.prisma.infotime_fornecedor.findFirst({
        where,
        select: fornecedorSelectSemCoordenadas,
      });
      if (!parcial) return null;
      return {
        ...parcial,
        latitude: null,
        longitude: null,
      } as infotime_fornecedor;
    }
  }

  private async assertCnpjUnicoNoTenant(
    idTenacidade: bigint,
    cnpjBruto: string,
    excetoIdFornecedor?: bigint,
  ): Promise<void> {
    const digitos = this.apenasDigitos(cnpjBruto);
    if (!digitos) return;

    const excl = excetoIdFornecedor != null;
    const rows = excl
      ? await this.prisma.$queryRaw<{ id: bigint }[]>`
          SELECT f.id_fornecedor
          FROM infotime_fornecedor f
          WHERE f.id_tenacidade = ${idTenacidade}
            AND regexp_replace(COALESCE(f.cnpj, ''), '[^0-9]', '', 'g') = ${digitos}
            AND f.id_fornecedor <> ${excetoIdFornecedor!}
          LIMIT 1
        `
      : await this.prisma.$queryRaw<{ id: bigint }[]>`
          SELECT f.id_fornecedor
          FROM infotime_fornecedor f
          WHERE f.id_tenacidade = ${idTenacidade}
            AND regexp_replace(COALESCE(f.cnpj, ''), '[^0-9]', '', 'g') = ${digitos}
          LIMIT 1
        `;

    if (rows.length > 0) {
      throw new ConflictException(
        'Atenção: CNPJ já cadastrado. Operação de inclusão cancelada.',
      );
    }
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infotime_fornecedorWhereInput {
    const q = qTexto.trim();
    const contains = { contains: q, mode: Prisma.QueryMode.insensitive } as const;
    switch (campoPesquisa) {
      case 'nomeFantasia':
        return { nome_fantasia: contains };
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
      case 'idFornecedor':
        try {
          return { id_fornecedor: BigInt(q) };
        } catch {
          return {};
        }
      default:
        return {};
    }
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infotime_fornecedorWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'nomeFantasia',
      'cnpj',
      'cidade',
      'estado',
      'telefone',
      'celular',
      'email',
    ]);
    const partes: Prisma.infotime_fornecedorWhereInput[] = [];

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
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  private async mapaSituacao(ids: bigint[]): Promise<Map<string, string>> {
    const map = new Map<string, string>();
    if (ids.length === 0) return map;
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >(Prisma.sql`
      SELECT id_situacao_fornecedor AS id, descricao
      FROM infotime_situacao_fornecedor
      WHERE id_situacao_fornecedor IN (${Prisma.join(ids)})
    `);
    for (const r of rows) {
      map.set(r.id.toString(), r.descricao?.trim() ?? '');
    }
    return map;
  }

  async listarSituacoes(): Promise<{ id: string; descricao: string | null }[]> {
    const rows = await this.prisma.$queryRaw<
      { id: bigint; descricao: string | null }[]
    >`
      SELECT id_situacao_fornecedor AS id, descricao
      FROM infotime_situacao_fornecedor
      ORDER BY descricao NULLS LAST
    `;
    return rows.map((r) => ({ id: r.id.toString(), descricao: r.descricao }));
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: FornecedorListaItemDto[]; total: number }> {
    const baseWhere: Prisma.infotime_fornecedorWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const mapRow = (
      r: {
        id_fornecedor: bigint;
        tipo_pessoa: string | null;
        nome_fantasia: string | null;
        cnpj: string | null;
        cidade: string | null;
        estado: string | null;
        telefone: string | null;
        celular: string | null;
        email: string | null;
        id_situacao_fornecedor: bigint | null;
        fabricante: string | null;
        contatos: string | null;
      },
      situacao: Map<string, string>,
    ): FornecedorListaItemDto => ({
      idFornecedor: r.id_fornecedor.toString(),
      nomeFantasia: r.nome_fantasia,
      tipoPessoa: r.tipo_pessoa,
      cnpj: r.cnpj,
      cidade: r.cidade,
      estado: r.estado,
      telefone: r.telefone,
      celular: r.celular,
      email: r.email,
      idSituacaoFornecedor: r.id_situacao_fornecedor?.toString() ?? null,
      situacaoFornecedorDescricao:
        r.id_situacao_fornecedor != null
          ? situacao.get(r.id_situacao_fornecedor.toString()) ?? null
          : null,
      fabricante: (r.fabricante ?? '').trim().toUpperCase() === 'S',
      contatos: r.contatos,
    });

    const takeLegado = 500;

    if (!modoListagemCrudNovo(query)) {
      const linhas = await this.prisma.infotime_fornecedor.findMany({
        where: baseWhere,
        orderBy: [{ nome_fantasia: 'asc' }],
        select: selectLista,
        ...(todos === true ? {} : { take: takeLegado }),
      });
      const idsSit = [
        ...new Set(
          linhas
            .map((x) => x.id_situacao_fornecedor)
            .filter((x): x is bigint => x != null),
        ),
      ];
      const situacao = await this.mapaSituacao(idsSit);
      const dados = linhas.map((r) => mapRow(r, situacao));
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
      'cnpj',
      'cidade',
      'estado',
      'telefone',
      'celular',
      'email',
      'idFornecedor',
    ]);

    let whereExtra: Prisma.infotime_fornecedorWhereInput = {};
    if (qTexto !== '' && campoPesquisa !== '') {
      if (!camposPesquisa.has(campoPesquisa)) {
        throw new BadRequestException(`campoPesquisa inválido: ${campoPesquisa}`);
      }
      whereExtra = this.whereCampoPesquisa(campoPesquisa, qTexto);
    }

    const whereFiltro = this.whereFiltroRefinado(query?.filtroRefinado);
    const where = mergeWhereAnd(baseWhere, whereExtra, whereFiltro);

    const total = await this.prisma.infotime_fornecedor.count({ where });

    const linhas = await this.prisma.infotime_fornecedor.findMany({
      where,
      orderBy: [{ nome_fantasia: 'asc' }],
      skip: pagina * tamanhoPagina,
      take: tamanhoPagina,
      select: selectLista,
    });

    const idsSit = [
      ...new Set(
        linhas
          .map((x) => x.id_situacao_fornecedor)
          .filter((x): x is bigint => x != null),
      ),
    ];
    const situacao = await this.mapaSituacao(idsSit);

    return {
      dados: linhas.map((r) => mapRow(r, situacao)),
      total,
    };
  }

  private montarDadosGravacao(
    dto: CriarFornecedorDto | AtualizarFornecedorDto,
    incluirDefaultsTipoPessoa: boolean,
  ): Record<string, unknown> {
    const tipo =
      dto.tipoPessoa?.trim().toUpperCase() ||
      (incluirDefaultsTipoPessoa ? 'J' : undefined);

    const row: Record<string, unknown> = {};
    if (dto.razaoSocial !== undefined) row['razao_social'] = dto.razaoSocial;
    if (dto.nomeFantasia !== undefined) row['nome_fantasia'] = dto.nomeFantasia;
    if (tipo !== undefined) row['tipo_pessoa'] = tipo;
    if (dto.fabricante !== undefined) {
      row['fabricante'] = dto.fabricante ? 'S' : null;
    }
    if (dto.cnpj !== undefined) row['cnpj'] = dto.cnpj.trim();
    if (dto.idSituacaoFornecedor !== undefined) {
      row['id_situacao_fornecedor'] = BigInt(dto.idSituacaoFornecedor);
    }
    if (dto.telefone !== undefined) row['telefone'] = dto.telefone ?? null;
    if (dto.celular !== undefined) row['celular'] = dto.celular ?? null;
    if (dto.email !== undefined) row['email'] = dto.email ?? null;
    if (dto.contatos !== undefined) row['contatos'] = dto.contatos ?? null;
    if (dto.homepage !== undefined) row['home_page'] = dto.homepage ?? null;
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
    if (dto.observacoes !== undefined) row['observacoes'] = dto.observacoes ?? null;

    return row;
  }

  async obterPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: Record<string, unknown> }> {
    let idFornecedor: bigint;
    try {
      idFornecedor = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de fornecedor inválido.');
    }

    const registro = await this.carregarFornecedorParaDetalhe({
      id_fornecedor: idFornecedor,
      id_tenacidade: tenantContexto.idTenacidade,
    });

    if (!registro) {
      throw new NotFoundException(`Fornecedor ${id} não encontrado.`);
    }

    const situacao = await this.mapaSituacao(
      registro.id_situacao_fornecedor != null
        ? [registro.id_situacao_fornecedor]
        : [],
    );

    const json = Object.fromEntries(
      Object.entries(registro).map(([k, v]) => [
        k,
        typeof v === 'bigint' ? v.toString() : v,
      ]),
    ) as Record<string, unknown>;

    json['situacaoFornecedorDescricao'] =
      registro.id_situacao_fornecedor != null
        ? situacao.get(registro.id_situacao_fornecedor.toString()) ?? null
        : null;

    return { dados: json };
  }

  async criar(
    dto: CriarFornecedorDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    await this.assertCnpjUnicoNoTenant(
      tenantContexto.idTenacidade,
      dto.cnpj,
    );

    const dadosParciais = this.montarDadosGravacao(dto, true);

    const criacao = {
      ...(dadosParciais as object),
      id_tenacidade: tenantContexto.idTenacidade,
      tipo_pessoa: (dadosParciais['tipo_pessoa'] as string | undefined) ?? 'J',
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: this.fatiarIp(ip),
      nome_aplicacao_auditoria: APP,
    } satisfies Prisma.infotime_fornecedorUncheckedCreateInput;

    const criado = await this.prisma.infotime_fornecedor.create({
      data: criacao,
      select: { id_fornecedor: true },
    });

    return { id: criado.id_fornecedor.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarFornecedorDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<void> {
    let idFornecedor: bigint;
    try {
      idFornecedor = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de fornecedor inválido.');
    }

    const existe = await this.prisma.infotime_fornecedor.findFirst({
      where: {
        id_fornecedor: idFornecedor,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_fornecedor: true },
    });
    if (!existe) {
      throw new NotFoundException(`Fornecedor ${id} não encontrado.`);
    }

    if (dto.cnpj !== undefined) {
      await this.assertCnpjUnicoNoTenant(
        tenantContexto.idTenacidade,
        dto.cnpj.trim(),
        idFornecedor,
      );
    }

    const patch = this.montarDadosGravacao(dto, false);
    delete patch['tipo_pessoa'];
    if (dto.tipoPessoa !== undefined) {
      patch['tipo_pessoa'] =
        dto.tipoPessoa.trim() === '' ? null : dto.tipoPessoa.toUpperCase();
    }

    await this.prisma.infotime_fornecedor.update({
      where: { id_fornecedor: idFornecedor },
      data: {
        ...(patch as Prisma.infotime_fornecedorUncheckedUpdateInput),
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
      },
    });
  }

  async excluir(id: string, tenantContexto: TenantContexto): Promise<void> {
    let idFornecedor: bigint;
    try {
      idFornecedor = BigInt(id);
    } catch {
      throw new BadRequestException('Identificador de fornecedor inválido.');
    }

    const atual = await this.prisma.infotime_fornecedor.findFirst({
      where: {
        id_fornecedor: idFornecedor,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_fornecedor: true },
    });
    if (!atual) {
      throw new NotFoundException(`Fornecedor ${id} não encontrado.`);
    }

    try {
      await this.prisma.infotime_fornecedor.delete({
        where: { id_fornecedor: idFornecedor },
      });
    } catch (e: unknown) {
      const code =
        typeof e === 'object' && e !== null && 'code' in e
          ? String((e as { code?: string }).code)
          : '';
      if (code === 'P2003') {
        throw new BadRequestException(
          'Não é possível excluir: existem registros dependentes deste fornecedor.',
        );
      }
      throw e;
    }
  }
}
