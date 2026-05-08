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
import { AtualizarEtniaDto } from './dto/atualizar-etnia.dto';
import { CriarEtniaDto } from './dto/criar-etnia.dto';
import { RespostaEtniaDto } from './dto/resposta-etnia.dto';
import { RespostaListagemEtniaDto } from './dto/resposta-listagem-etnia.dto';

@Injectable()
export class EtniaService {
  private static readonly CAMPOS_PESQUISA = new Set(['nome', 'id', 'id_raca']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaEtnia(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_etniaWhereInput {
    if (campoPesquisa === 'nome') {
      return {
        nome: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_etnia: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'id_raca') {
      try {
        return { id_raca: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoEtnia(
    jsonBruto: string | undefined,
  ): Prisma.infolab_etniaWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome']);
    const partes: Prisma.infolab_etniaWhereInput[] = [];

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

      if (campo === 'nome' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            nome: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemEtniaDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_etniaWhereInput = {};

    const select = {
      id_etnia: true,
      nome: true,
      id_raca: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_etnia,
      baseWhere,
      camposPesquisaWhitelist: EtniaService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaEtnia(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoEtnia(j),
      orderBy: { id_etnia: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_etnia: bigint;
          nome: string | null;
          id_raca: bigint | null;
        };
        return {
          id: r.id_etnia.toString(),
          nome: r.nome ?? null,
          id_raca: r.id_raca?.toString() ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_etnia.findMany({
          where: where as Prisma.infolab_etniaWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaEtniaDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_etnia.findUnique({
      where: { id_etnia: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Etnia ${id} não encontrada.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarEtniaDto,
    tenantContexto: TenantContexto,
  ): Promise<{ id: string }> {
    void tenantContexto;
    const criado = await this.prisma.infolab_etnia.create({
      data: {
        nome: dto.nome,
        id_raca: dto.id_raca !== undefined ? BigInt(dto.id_raca) : null,
      },
      select: { id_etnia: true },
    });

    return { id: criado.id_etnia.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarEtniaDto,
    tenantContexto: TenantContexto,
  ): Promise<{ id: string }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_etnia.findUnique({
      where: { id_etnia: BigInt(id) },
      select: { id_etnia: true },
    });

    if (!existente) {
      throw new NotFoundException(`Etnia ${id} não encontrada.`);
    }

    await this.prisma.infolab_etnia.update({
      where: { id_etnia: BigInt(id) },
      data: {
        ...(dto.nome !== undefined && { nome: dto.nome }),
        ...(dto.id_raca !== undefined && {
          id_raca: dto.id_raca === null ? null : BigInt(dto.id_raca),
        }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_etnia.findUnique({
      where: { id_etnia: BigInt(id) },
      select: { id_etnia: true },
    });

    if (!existente) {
      throw new NotFoundException(`Etnia ${id} não encontrada.`);
    }

    try {
      await this.prisma.infolab_etnia.delete({
        where: { id_etnia: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta etnia.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_etnia: bigint;
    nome: string | null;
    id_raca: bigint | null;
  }): RespostaEtniaDto {
    return {
      id: registro.id_etnia.toString(),
      nome: registro.nome ?? null,
      id_raca: registro.id_raca?.toString() ?? null,
    };
  }
}
