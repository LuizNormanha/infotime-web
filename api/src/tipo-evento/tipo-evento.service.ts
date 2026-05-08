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
import { AtualizarTipoEventoDto } from './dto/atualizar-tipo-evento.dto';
import { CriarTipoEventoDto } from './dto/criar-tipo-evento.dto';
import { RespostaListagemTipoEventoDto } from './dto/resposta-listagem-tipo-evento.dto';
import { RespostaTipoEventoDto } from './dto/resposta-tipo-evento.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

@Injectable()
export class TipoEventoService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaTipoEvento(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_eventoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        const id = BigInt(qTexto.trim());
        return { id_tipo_evento: id };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoTipoEvento(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_eventoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_tipo_eventoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemTipoEventoDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_tipo_eventoWhereInput = {};

    const select = {
      id_tipo_evento: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_evento,
      baseWhere,
      camposPesquisaWhitelist: TipoEventoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaTipoEvento(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoTipoEvento(j),
      orderBy: { id_tipo_evento: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as { id_tipo_evento: bigint; descricao: string | null };
        return {
          id: r.id_tipo_evento.toString(),
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_evento.findMany({
          where: where as Prisma.infolab_tipo_eventoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoEventoDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_tipo_evento.findUnique({
      where: { id_tipo_evento: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Tipo de evento ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoEventoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_tipo_evento.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
      },
      select: { id_tipo_evento: true },
    });

    return { id: criado.id_tipo_evento.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoEventoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_evento.findUnique({
      where: { id_tipo_evento: BigInt(id) },
      select: { id_tipo_evento: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de evento ${id} não encontrado.`);
    }

    await this.prisma.infolab_tipo_evento.update({
      where: { id_tipo_evento: BigInt(id) },
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
    const existente = await this.prisma.infolab_tipo_evento.findUnique({
      where: { id_tipo_evento: BigInt(id) },
      select: { id_tipo_evento: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de evento ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_evento.delete({
        where: { id_tipo_evento: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de evento.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_evento: bigint;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoEventoDto {
    return {
      id: registro.id_tipo_evento.toString(),
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
