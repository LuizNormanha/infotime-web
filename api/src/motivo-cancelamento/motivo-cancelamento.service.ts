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
import { AtualizarMotivoCancelamentoDto } from './dto/atualizar-motivo-cancelamento.dto';
import { CriarMotivoCancelamentoDto } from './dto/criar-motivo-cancelamento.dto';
import { RespostaListagemMotivoCancelamentoDto } from './dto/resposta-listagem-motivo-cancelamento.dto';
import { RespostaMotivoCancelamentoDto } from './dto/resposta-motivo-cancelamento.dto';

@Injectable()
export class MotivoCancelamentoService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaMotivoCancelamento(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_motivo_cancelamentoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_motivo_cancelamento: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoMotivoCancelamento(
    jsonBruto: string | undefined,
  ): Prisma.infolab_motivo_cancelamentoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_motivo_cancelamentoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemMotivoCancelamentoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_motivo_cancelamentoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_motivo_cancelamento: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_motivo_cancelamento,
      baseWhere,
      camposPesquisaWhitelist: MotivoCancelamentoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaMotivoCancelamento(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoMotivoCancelamento(j),
      orderBy: { id_motivo_cancelamento: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_motivo_cancelamento: bigint;
          descricao: string | null;
        };
        return {
          id: r.id_motivo_cancelamento.toString(),
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_motivo_cancelamento.findMany({
          where: where as Prisma.infolab_motivo_cancelamentoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaMotivoCancelamentoDto }> {
    const registro = await this.prisma.infolab_motivo_cancelamento.findUnique({
      where: { id_motivo_cancelamento: BigInt(id) },
    });

    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(
        `Motivo de cancelamento ${id} não encontrado.`,
      );
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarMotivoCancelamentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_motivo_cancelamento.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
      },
      select: { id_motivo_cancelamento: true },
    });

    return { id: criado.id_motivo_cancelamento.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarMotivoCancelamentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_motivo_cancelamento.findUnique({
      where: { id_motivo_cancelamento: BigInt(id) },
      select: { id_motivo_cancelamento: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(
        `Motivo de cancelamento ${id} não encontrado.`,
      );
    }

    await this.prisma.infolab_motivo_cancelamento.update({
      where: { id_motivo_cancelamento: BigInt(id) },
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
    const existente = await this.prisma.infolab_motivo_cancelamento.findUnique({
      where: { id_motivo_cancelamento: BigInt(id) },
      select: { id_motivo_cancelamento: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(
        `Motivo de cancelamento ${id} não encontrado.`,
      );
    }

    try {
      await this.prisma.infolab_motivo_cancelamento.delete({
        where: { id_motivo_cancelamento: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este motivo de cancelamento.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_motivo_cancelamento: bigint;
    id_tenacidade: bigint;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaMotivoCancelamentoDto {
    return {
      id: registro.id_motivo_cancelamento.toString(),
      id_tenacidade: registro.id_tenacidade.toString(),
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
