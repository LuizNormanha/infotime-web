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
import { AtualizarMotivoRetificacaoDto } from './dto/atualizar-motivo-retificacao.dto';
import { CriarMotivoRetificacaoDto } from './dto/criar-motivo-retificacao.dto';
import { RespostaListagemMotivoRetificacaoDto } from './dto/resposta-listagem-motivo-retificacao.dto';
import { RespostaMotivoRetificacaoDto } from './dto/resposta-motivo-retificacao.dto';

@Injectable()
export class MotivoRetificacaoService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaMotivoRetificacao(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_motivo_retificacaoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        const id = BigInt(qTexto.trim());
        return { id_motivo_retificacao: id };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoMotivoRetificacao(
    jsonBruto: string | undefined,
  ): Prisma.infolab_motivo_retificacaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_motivo_retificacaoWhereInput[] = [];

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

      if (campo === 'descricao' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            descricao: { contains: contem, mode: 'insensitive' },
          });
        }
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0]! : { AND: partes };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemMotivoRetificacaoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_motivo_retificacaoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_motivo_retificacao: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_motivo_retificacao,
      baseWhere,
      camposPesquisaWhitelist: MotivoRetificacaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaMotivoRetificacao(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoMotivoRetificacao(j),
      orderBy: { id_motivo_retificacao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_motivo_retificacao: bigint;
          descricao: string | null;
        };
        return {
          id: r.id_motivo_retificacao.toString(),
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_motivo_retificacao.findMany({
          where: where as Prisma.infolab_motivo_retificacaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaMotivoRetificacaoDto }> {
    const registro = await this.prisma.infolab_motivo_retificacao.findUnique({
      where: { id_motivo_retificacao: BigInt(id) },
    });

    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(
        `Motivo de retificação ${id} não encontrado.`,
      );
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarMotivoRetificacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_motivo_retificacao.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
      },
      select: { id_motivo_retificacao: true },
    });

    return { id: criado.id_motivo_retificacao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarMotivoRetificacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_motivo_retificacao.findUnique({
      where: { id_motivo_retificacao: BigInt(id) },
      select: { id_motivo_retificacao: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(
        `Motivo de retificação ${id} não encontrado.`,
      );
    }

    await this.prisma.infolab_motivo_retificacao.update({
      where: { id_motivo_retificacao: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_motivo_retificacao.findUnique({
      where: { id_motivo_retificacao: BigInt(id) },
      select: { id_motivo_retificacao: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(
        `Motivo de retificação ${id} não encontrado.`,
      );
    }

    try {
      await this.prisma.infolab_motivo_retificacao.delete({
        where: { id_motivo_retificacao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este motivo de retificação.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_motivo_retificacao: bigint;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaMotivoRetificacaoDto {
    return {
      id: registro.id_motivo_retificacao.toString(),
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
