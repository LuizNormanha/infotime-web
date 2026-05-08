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
import { AtualizarCidDto } from './dto/atualizar-cid.dto';
import { CriarCidDto } from './dto/criar-cid.dto';
import { RespostaCidDto } from './dto/resposta-cid.dto';
import { RespostaListagemCidDto } from './dto/resposta-listagem-cid.dto';

@Injectable()
export class CidService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'codigo_cid',
    'descricao',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_cidWhereInput {
    if (campoPesquisa === 'codigo_cid') {
      return {
        codigo_cid: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_cid: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_cidWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['codigo_cid', 'descricao']);
    const partes: Prisma.infolab_cidWhereInput[] = [];

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

      if (campo === 'codigo_cid') {
        partes.push({
          codigo_cid: { contains: contem, mode: 'insensitive' },
        });
      }
      if (campo === 'descricao') {
        partes.push({
          descricao: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemCidDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_cidWhereInput = {};

    const select = {
      id_cid: true,
      codigo_cid: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_cid,
      baseWhere,
      camposPesquisaWhitelist: CidService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_cid: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_cid: bigint;
          codigo_cid: string | null;
          descricao: string | null;
        };
        return {
          id: r.id_cid.toString(),
          codigo_cid: r.codigo_cid ?? null,
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_cid.findMany({
          where: where as Prisma.infolab_cidWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaCidDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_cid.findUnique({
      where: { id_cid: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`CID ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarCidDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_cid.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        codigo_cid: dto.codigo_cid,
        descricao: dto.descricao ?? null,
        descricao_cap: dto.descricao_cap ?? null,
        descricao_categoria: dto.descricao_categoria ?? null,
        observacao: dto.observacao ?? null,
      },
      select: { id_cid: true },
    });

    return { id: criado.id_cid.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarCidDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_cid.findUnique({
      where: { id_cid: BigInt(id) },
      select: { id_cid: true },
    });

    if (!existente) {
      throw new NotFoundException(`CID ${id} não encontrado.`);
    }

    await this.prisma.infolab_cid.update({
      where: { id_cid: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.codigo_cid !== undefined && { codigo_cid: dto.codigo_cid }),
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.descricao_cap !== undefined && {
          descricao_cap: dto.descricao_cap,
        }),
        ...(dto.descricao_categoria !== undefined && {
          descricao_categoria: dto.descricao_categoria,
        }),
        ...(dto.observacao !== undefined && { observacao: dto.observacao }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_cid.findUnique({
      where: { id_cid: BigInt(id) },
      select: { id_cid: true },
    });

    if (!existente) {
      throw new NotFoundException(`CID ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_cid.delete({
        where: { id_cid: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este CID.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_cid: bigint;
    codigo_cid: string | null;
    descricao: string | null;
    descricao_cap: string | null;
    descricao_categoria: string | null;
    observacao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaCidDto {
    return {
      id: registro.id_cid.toString(),
      codigo_cid: registro.codigo_cid ?? null,
      descricao: registro.descricao ?? null,
      descricao_cap: registro.descricao_cap ?? null,
      descricao_categoria: registro.descricao_categoria ?? null,
      observacao: registro.observacao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
