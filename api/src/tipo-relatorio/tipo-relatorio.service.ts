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
import { AtualizarTipoRelatorioDto } from './dto/atualizar-tipo-relatorio.dto';
import { CriarTipoRelatorioDto } from './dto/criar-tipo-relatorio.dto';
import { RespostaListagemTipoRelatorioDto } from './dto/resposta-listagem-tipo-relatorio.dto';
import { RespostaTipoRelatorioDto } from './dto/resposta-tipo-relatorio.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

@Injectable()
export class TipoRelatorioService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaTipoRelatorio(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_relatorioWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tipo_relatorio: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoTipoRelatorio(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_relatorioWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'ativo']);
    const partes: Prisma.infolab_tipo_relatorioWhereInput[] = [];

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
        continue;
      }

      if (campo === 'ativo' && tipo === 'enum') {
        const vals = val['valores'];
        if (!Array.isArray(vals) || vals.length === 0) continue;
        const letras = vals.filter(
          (x): x is string => typeof x === 'string' && (x === 'S' || x === 'N'),
        );
        if (letras.length > 0) {
          partes.push({ ativo: { in: letras } });
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
  ): Promise<{ dados: RespostaListagemTipoRelatorioDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_tipo_relatorioWhereInput = {};

    const select = {
      id_tipo_relatorio: true,
      descricao: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_relatorio,
      baseWhere,
      camposPesquisaWhitelist: TipoRelatorioService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaTipoRelatorio(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoTipoRelatorio(j),
      orderBy: { id_tipo_relatorio: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tipo_relatorio: bigint;
          descricao: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_tipo_relatorio.toString(),
          descricao: r.descricao ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_relatorio.findMany({
          where: where as Prisma.infolab_tipo_relatorioWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoRelatorioDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_tipo_relatorio.findUnique({
      where: { id_tipo_relatorio: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Tipo de relatório ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoRelatorioDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_tipo_relatorio.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao ?? null,
        ativo: dto.ativo ?? null,
      },
      select: { id_tipo_relatorio: true },
    });

    return { id: criado.id_tipo_relatorio.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoRelatorioDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_relatorio.findUnique({
      where: { id_tipo_relatorio: BigInt(id) },
      select: { id_tipo_relatorio: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de relatório ${id} não encontrado.`);
    }

    const data: Prisma.infolab_tipo_relatorioUncheckedUpdateInput = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: truncarIp(ip, 255),
      nome_aplicacao_auditoria: 'infotime-web',
    };

    if (dto.descricao !== undefined) {
      data.descricao = dto.descricao ?? null;
    }
    if (dto.ativo !== undefined) {
      data.ativo = dto.ativo ?? null;
    }

    await this.prisma.infolab_tipo_relatorio.update({
      where: { id_tipo_relatorio: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_tipo_relatorio.findUnique({
      where: { id_tipo_relatorio: BigInt(id) },
      select: { id_tipo_relatorio: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de relatório ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_relatorio.delete({
        where: { id_tipo_relatorio: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de relatório.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_relatorio: bigint;
    descricao: string | null;
    ativo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoRelatorioDto {
    return {
      id: registro.id_tipo_relatorio.toString(),
      descricao: registro.descricao ?? null,
      ativo: registro.ativo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
