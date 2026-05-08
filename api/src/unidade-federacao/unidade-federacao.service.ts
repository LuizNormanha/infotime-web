import {
  ConflictException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { PrismaService } from '../prisma/prisma.service';
import { AtualizarUnidadeFederacaoDto } from './dto/atualizar-unidade-federacao.dto';
import { CriarUnidadeFederacaoDto } from './dto/criar-unidade-federacao.dto';
import { RespostaListagemUnidadeFederacaoDto } from './dto/resposta-listagem-unidade-federacao.dto';
import { RespostaUnidadeFederacaoDto } from './dto/resposta-unidade-federacao.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

@Injectable()
export class UnidadeFederacaoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'codigo',
    'sigla',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_unidade_federacaoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'codigo') {
      const n = Number.parseInt(qTexto.trim(), 10);
      if (!Number.isFinite(n)) return {};
      return { codigo: n };
    }
    if (campoPesquisa === 'sigla') {
      return {
        sigla: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_unidade_federacao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_unidade_federacaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'codigo', 'sigla']);
    const partes: Prisma.infolab_unidade_federacaoWhereInput[] = [];

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
      const tipo = typeof val.tipo === 'string' ? val.tipo : '';
      if (tipo !== 'texto') continue;
      const contem =
        typeof val['contem'] === 'string' ? val['contem'].trim() : '';
      if (!contem) continue;

      if (campo === 'descricao') {
        partes.push({
          descricao: { contains: contem, mode: 'insensitive' },
        });
      }
      if (campo === 'codigo') {
        const n = Number.parseInt(contem, 10);
        if (Number.isFinite(n)) {
          partes.push({ codigo: n });
        }
      }
      if (campo === 'sigla') {
        partes.push({
          sigla: { contains: contem, mode: 'insensitive' },
        });
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemUnidadeFederacaoDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_unidade_federacaoWhereInput = {};

    const select = {
      id_unidade_federacao: true,
      codigo: true,
      sigla: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_unidade_federacao,
      baseWhere,
      camposPesquisaWhitelist: UnidadeFederacaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_unidade_federacao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_unidade_federacao: bigint;
          codigo: number | null;
          sigla: string | null;
          descricao: string | null;
        };
        return {
          id: r.id_unidade_federacao.toString(),
          codigo: r.codigo ?? null,
          sigla: r.sigla ?? null,
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_unidade_federacao.findMany({
          where: where as Prisma.infolab_unidade_federacaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaUnidadeFederacaoDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_unidade_federacao.findUnique({
      where: { id_unidade_federacao: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Unidade da federação ${id} não encontrada.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarUnidadeFederacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_unidade_federacao.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.codigo !== undefined && { codigo: dto.codigo }),
        ...(dto.sigla !== undefined && { sigla: dto.sigla }),
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
      },
      select: { id_unidade_federacao: true },
    });

    return { id: criado.id_unidade_federacao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarUnidadeFederacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_unidade_federacao.findUnique({
      where: { id_unidade_federacao: BigInt(id) },
      select: { id_unidade_federacao: true },
    });

    if (!existente) {
      throw new NotFoundException(`Unidade da federação ${id} não encontrada.`);
    }

    await this.prisma.infolab_unidade_federacao.update({
      where: { id_unidade_federacao: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.codigo !== undefined && { codigo: dto.codigo }),
        ...(dto.sigla !== undefined && { sigla: dto.sigla }),
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_unidade_federacao.findUnique({
      where: { id_unidade_federacao: BigInt(id) },
      select: { id_unidade_federacao: true },
    });

    if (!existente) {
      throw new NotFoundException(`Unidade da federação ${id} não encontrada.`);
    }

    try {
      await this.prisma.infolab_unidade_federacao.delete({
        where: { id_unidade_federacao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta unidade da federação.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_unidade_federacao: bigint;
    codigo: number | null;
    sigla: string | null;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaUnidadeFederacaoDto {
    return {
      id: registro.id_unidade_federacao.toString(),
      codigo: registro.codigo ?? null,
      sigla: registro.sigla ?? null,
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
