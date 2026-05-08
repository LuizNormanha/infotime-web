import { Injectable, NotFoundException } from '@nestjs/common';
import { Prisma } from '@prisma/client';

import { executarListagemCrudCatalogo } from '../comum/listagem/executar-listagem-crud-catalogo';
import {
  parseJsonFiltroRefinado,
  type QueryListagemCrudPadrao,
} from '../comum/listagem/query-listagem-crud';
import { PrismaService } from '../prisma/prisma.service';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { CriarFeriadoDto } from './dto/criar-feriado.dto';
import { AtualizarFeriadoDto } from './dto/atualizar-feriado.dto';
import { RespostaFeriadoDto } from './dto/resposta-feriado.dto';
import { RespostaListagemFeriadoDto } from './dto/resposta-listagem-feriado.dto';
import type { infolab_feriado, infolab_usuario } from '@prisma/client';

type FeriadoComUsuario = infolab_feriado & {
  infolab_usuario: Pick<infolab_usuario, 'nome' | 'login'> | null;
};

@Injectable()
export class FeriadoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'id',
    'data_feriado',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private parseDataBuscaIso(qTexto: string): Date | null {
    const s = qTexto.trim();
    const m = /^(\d{4})-(\d{2})-(\d{2})$/.exec(s);
    if (!m) return null;
    const y = Number(m[1]);
    const mo = Number(m[2]);
    const d = Number(m[3]);
    if (!Number.isFinite(y) || !Number.isFinite(mo) || !Number.isFinite(d)) {
      return null;
    }
    const dt = new Date(Date.UTC(y, mo - 1, d));
    return Number.isNaN(dt.getTime()) ? null : dt;
  }

  private whereCampoPesquisaFeriado(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_feriadoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_feriado: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'data_feriado') {
      const dt = this.parseDataBuscaIso(qTexto);
      if (!dt) return {};
      return { data_feriado: dt };
    }
    return {};
  }

  private whereFiltroRefinadoFeriado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_feriadoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_feriadoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemFeriadoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_feriadoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_feriado: true,
      descricao: true,
      data_feriado: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_feriado,
      baseWhere,
      camposPesquisaWhitelist: FeriadoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaFeriado(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoFeriado(j),
      orderBy: { id_feriado: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_feriado: bigint;
          descricao: string | null;
          data_feriado: Date | null;
        };
        return {
          id: r.id_feriado.toString(),
          descricao: r.descricao ?? null,
          data_feriado: r.data_feriado
            ? r.data_feriado.toISOString().slice(0, 10)
            : null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_feriado.findMany({
          where: where as Prisma.infolab_feriadoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaFeriadoDto }> {
    const registro = await this.prisma.infolab_feriado.findUnique({
      where: { id_feriado: BigInt(id) },
      include: {
        infolab_usuario: { select: { nome: true, login: true } },
      },
    });

    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Feriado ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro as FeriadoComUsuario) };
  }

  async criar(
    dto: CriarFeriadoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const ipAud = ip.slice(0, 20);
    const criado = await this.prisma.infolab_feriado.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ipAud,
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
        data_feriado: dto.data_feriado ? new Date(dto.data_feriado) : null,
      },
      select: { id_feriado: true },
    });

    return { id: criado.id_feriado.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarFeriadoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_feriado.findUnique({
      where: { id_feriado: BigInt(id) },
      select: { id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Feriado ${id} não encontrado.`);
    }

    const ipAud = ip.slice(0, 20);
    await this.prisma.infolab_feriado.update({
      where: { id_feriado: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ipAud,
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.data_feriado !== undefined && {
          data_feriado: dto.data_feriado ? new Date(dto.data_feriado) : null,
        }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_feriado.findUnique({
      where: { id_feriado: BigInt(id) },
      select: { id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Feriado ${id} não encontrado.`);
    }

    await this.prisma.infolab_feriado.delete({
      where: { id_feriado: BigInt(id) },
    });

    return { ok: true };
  }

  private formatarUsuarioAuditoria(
    u: Pick<infolab_usuario, 'nome' | 'login'> | null | undefined,
    idUsuario: bigint | null,
  ): string | null {
    if (!u && idUsuario == null) return null;
    if (!u) return idUsuario?.toString() ?? null;
    const partes = [u.nome, u.login].filter((s): s is string =>
      Boolean(s?.trim()),
    );
    if (partes.length > 0) return partes.join(' · ');
    return idUsuario?.toString() ?? null;
  }

  private mapearResposta(row: FeriadoComUsuario): RespostaFeriadoDto {
    return {
      id: row.id_feriado.toString(),
      id_tenacidade: row.id_tenacidade?.toString() ?? null,
      descricao: row.descricao ?? null,
      data_feriado: row.data_feriado
        ? row.data_feriado.toISOString().slice(0, 10)
        : null,
      id_usuario_auditoria: row.id_usuario_auditoria?.toString() ?? null,
      usuario_auditoria: this.formatarUsuarioAuditoria(
        row.infolab_usuario,
        row.id_usuario_auditoria,
      ),
      endereco_ip_auditoria: row.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: row.nome_aplicacao_auditoria ?? null,
    };
  }
}
