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
import { AtualizarTipoAplicacaoDto } from './dto/atualizar-tipo-aplicacao.dto';
import { CriarTipoAplicacaoDto } from './dto/criar-tipo-aplicacao.dto';
import { RespostaListagemTipoAplicacaoDto } from './dto/resposta-listagem-tipo-aplicacao.dto';
import { RespostaTipoAplicacaoDto } from './dto/resposta-tipo-aplicacao.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

@Injectable()
export class TipoAplicacaoService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_aplicacaoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tipo_aplicacao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_aplicacaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_tipo_aplicacaoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemTipoAplicacaoDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_tipo_aplicacaoWhereInput = {};

    const select = {
      id_tipo_aplicacao: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_aplicacao,
      baseWhere,
      camposPesquisaWhitelist: TipoAplicacaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_tipo_aplicacao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tipo_aplicacao: bigint;
          descricao: string | null;
        };
        return {
          id: r.id_tipo_aplicacao.toString(),
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_aplicacao.findMany({
          where: where as Prisma.infolab_tipo_aplicacaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoAplicacaoDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_tipo_aplicacao.findUnique({
      where: { id_tipo_aplicacao: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Tipo de aplicação ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoAplicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_tipo_aplicacao.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
      },
      select: { id_tipo_aplicacao: true },
    });

    return { id: criado.id_tipo_aplicacao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoAplicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_aplicacao.findUnique({
      where: { id_tipo_aplicacao: BigInt(id) },
      select: { id_tipo_aplicacao: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de aplicação ${id} não encontrado.`);
    }

    await this.prisma.infolab_tipo_aplicacao.update({
      where: { id_tipo_aplicacao: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
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
    void tenantContexto;
    const existente = await this.prisma.infolab_tipo_aplicacao.findUnique({
      where: { id_tipo_aplicacao: BigInt(id) },
      select: { id_tipo_aplicacao: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de aplicação ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_aplicacao.delete({
        where: { id_tipo_aplicacao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de aplicação.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_aplicacao: bigint;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoAplicacaoDto {
    return {
      id: registro.id_tipo_aplicacao.toString(),
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
