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
import { AtualizarCboDto } from './dto/atualizar-cbo.dto';
import { CriarCboDto } from './dto/criar-cbo.dto';
import { RespostaCboDto } from './dto/resposta-cbo.dto';
import { RespostaListagemCboDto } from './dto/resposta-listagem-cbo.dto';

@Injectable()
export class CboService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'codigo_externo',
    'codigo_cbo',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_cboWhereInput {
    if (campoPesquisa === 'descricao') {
      return { descricao: { contains: qTexto, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'codigo_externo') {
      return { codigo_externo: { contains: qTexto, mode: 'insensitive' } };
    }
    if (campoPesquisa === 'codigo_cbo') {
      const n = parseInt(qTexto, 10);
      if (!Number.isFinite(n)) return {};
      return { codigo_cbo: n };
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_cboWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_cboWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemCboDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_cboWhereInput = {};

    const select = {
      id_cbo: true,
      descricao: true,
      codigo_externo: true,
      codigo_cbo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_cbo,
      baseWhere,
      camposPesquisaWhitelist: CboService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_cbo: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_cbo: bigint;
          descricao: string | null;
          codigo_externo: string | null;
          codigo_cbo: number | null;
        };
        return {
          id: r.id_cbo.toString(),
          descricao: r.descricao ?? null,
          codigo_externo: r.codigo_externo ?? null,
          codigo_cbo: r.codigo_cbo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_cbo.findMany({
          where: where as Prisma.infolab_cboWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaCboDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_cbo.findUnique({
      where: { id_cbo: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`CBO ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarCboDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_cbo.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao ?? null,
        codigo_externo: dto.codigo_externo ?? null,
        codigo_cbo: dto.codigo_cbo ?? null,
      },
      select: { id_cbo: true },
    });

    return { id: criado.id_cbo.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarCboDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_cbo.findUnique({
      where: { id_cbo: BigInt(id) },
      select: { id_cbo: true },
    });

    if (!existente) {
      throw new NotFoundException(`CBO ${id} não encontrado.`);
    }

    await this.prisma.infolab_cbo.update({
      where: { id_cbo: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.codigo_externo !== undefined && {
          codigo_externo: dto.codigo_externo,
        }),
        ...(dto.codigo_cbo !== undefined && { codigo_cbo: dto.codigo_cbo }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_cbo.findUnique({
      where: { id_cbo: BigInt(id) },
      select: { id_cbo: true },
    });

    if (!existente) {
      throw new NotFoundException(`CBO ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_cbo.delete({
        where: { id_cbo: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este CBO.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_cbo: bigint;
    descricao: string | null;
    codigo_externo: string | null;
    codigo_cbo: number | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaCboDto {
    return {
      id: registro.id_cbo.toString(),
      descricao: registro.descricao ?? null,
      codigo_externo: registro.codigo_externo ?? null,
      codigo_cbo: registro.codigo_cbo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
