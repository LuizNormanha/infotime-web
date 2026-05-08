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
import { AtualizarConselhoRegionalDto } from './dto/atualizar-conselho-regional.dto';
import { CriarConselhoRegionalDto } from './dto/criar-conselho-regional.dto';
import { RespostaConselhoRegionalDto } from './dto/resposta-conselho-regional.dto';
import { RespostaListagemConselhoRegionalDto } from './dto/resposta-listagem-conselho-regional.dto';

@Injectable()
export class ConselhoRegionalService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'sigla',
    'descricao',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_conselho_regionalWhereInput {
    if (campoPesquisa === 'sigla') {
      return {
        sigla: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_conselho_regional: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_conselho_regionalWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['sigla', 'descricao']);
    const partes: Prisma.infolab_conselho_regionalWhereInput[] = [];

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

      if (campo === 'sigla') {
        partes.push({
          sigla: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemConselhoRegionalDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_conselho_regionalWhereInput = {};

    const select = {
      id_conselho_regional: true,
      sigla: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_conselho_regional,
      baseWhere,
      camposPesquisaWhitelist: ConselhoRegionalService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_conselho_regional: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_conselho_regional: bigint;
          sigla: string | null;
          descricao: string | null;
        };
        return {
          id: r.id_conselho_regional.toString(),
          sigla: r.sigla ?? null,
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_conselho_regional.findMany({
          where: where as Prisma.infolab_conselho_regionalWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaConselhoRegionalDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_conselho_regional.findUnique({
      where: { id_conselho_regional: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Conselho regional ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarConselhoRegionalDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_conselho_regional.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
        sigla: dto.sigla ?? null,
      },
      select: { id_conselho_regional: true },
    });

    return { id: criado.id_conselho_regional.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarConselhoRegionalDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_conselho_regional.findUnique({
      where: { id_conselho_regional: BigInt(id) },
      select: { id_conselho_regional: true },
    });

    if (!existente) {
      throw new NotFoundException(`Conselho regional ${id} não encontrado.`);
    }

    await this.prisma.infolab_conselho_regional.update({
      where: { id_conselho_regional: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.sigla !== undefined && { sigla: dto.sigla ?? null }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_conselho_regional.findUnique({
      where: { id_conselho_regional: BigInt(id) },
      select: { id_conselho_regional: true },
    });

    if (!existente) {
      throw new NotFoundException(`Conselho regional ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_conselho_regional.delete({
        where: { id_conselho_regional: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este conselho regional.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_conselho_regional: bigint;
    sigla: string | null;
    descricao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaConselhoRegionalDto {
    return {
      id: registro.id_conselho_regional.toString(),
      sigla: registro.sigla ?? null,
      descricao: registro.descricao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
