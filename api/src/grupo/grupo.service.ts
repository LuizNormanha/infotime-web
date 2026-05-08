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
import { AtualizarGrupoDto } from './dto/atualizar-grupo.dto';
import { CriarGrupoDto } from './dto/criar-grupo.dto';
import { RespostaGrupoDto } from './dto/resposta-grupo.dto';
import { RespostaListagemGrupoDto } from './dto/resposta-listagem-grupo.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

@Injectable()
export class GrupoService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisaGrupo(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_grupoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_grupo: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoGrupo(
    jsonBruto: string | undefined,
  ): Prisma.infolab_grupoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_grupoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemGrupoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_grupoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_grupo: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_grupo,
      baseWhere,
      camposPesquisaWhitelist: GrupoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaGrupo(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoGrupo(j),
      orderBy: { id_grupo: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as { id_grupo: bigint; descricao: string | null };
        return {
          id: r.id_grupo.toString(),
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_grupo.findMany({
          where: where as Prisma.infolab_grupoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaGrupoDto }> {
    const registro = await this.prisma.infolab_grupo.findUnique({
      where: { id_grupo: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Grupo ${id} não encontrado.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarGrupoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_grupo.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        descricao: dto.descricao,
      },
      select: { id_grupo: true },
    });
    return { id: criado.id_grupo.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarGrupoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_grupo.findUnique({
      where: { id_grupo: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Grupo ${id} não encontrado.`);
    }
    await this.prisma.infolab_grupo.update({
      where: { id_grupo: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
      },
    });
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_grupo.findUnique({
      where: { id_grupo: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Grupo ${id} não encontrado.`);
    }
    try {
      await this.prisma.infolab_grupo.delete({
        where: { id_grupo: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este grupo.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_grupo: bigint;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaGrupoDto {
    return {
      id: registro.id_grupo.toString(),
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
