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
import { AtualizarRacaDto } from './dto/atualizar-raca.dto';
import { CriarRacaDto } from './dto/criar-raca.dto';
import { RespostaRacaDto } from './dto/resposta-raca.dto';
import { RespostaListagemRacaDto } from './dto/resposta-listagem-raca.dto';

const IP_AUDITORIA_MAX = 255;

@Injectable()
export class RacaService {
  private static readonly CAMPOS_PESQUISA = new Set(['nome', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIpAuditoria(ip: string): string {
    return ip.slice(0, IP_AUDITORIA_MAX);
  }

  private whereCampoPesquisaRaca(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_racaWhereInput {
    if (campoPesquisa === 'nome') {
      return {
        nome: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_raca: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoRaca(
    jsonBruto: string | undefined,
  ): Prisma.infolab_racaWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome']);
    const partes: Prisma.infolab_racaWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemRacaDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_racaWhereInput = {};

    const select = {
      id_raca: true,
      nome: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_raca,
      baseWhere,
      camposPesquisaWhitelist: RacaService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaRaca(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoRaca(j),
      orderBy: { id_raca: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as { id_raca: bigint; nome: string | null };
        return {
          id: r.id_raca.toString(),
          nome: r.nome ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_raca.findMany({
          where: where as Prisma.infolab_racaWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaRacaDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_raca.findUnique({
      where: { id_raca: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Raça ${id} não encontrada.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarRacaDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_raca.create({
      data: {
        nome: dto.nome,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIpAuditoria(ip),
        nome_aplicacao_auditoria: 'infotime-web',
      },
      select: { id_raca: true },
    });

    return { id: criado.id_raca.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarRacaDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_raca.findUnique({
      where: { id_raca: BigInt(id) },
      select: { id_raca: true },
    });

    if (!existente) {
      throw new NotFoundException(`Raça ${id} não encontrada.`);
    }

    await this.prisma.infolab_raca.update({
      where: { id_raca: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIpAuditoria(ip),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.nome !== undefined && { nome: dto.nome }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_raca.findUnique({
      where: { id_raca: BigInt(id) },
      select: { id_raca: true },
    });

    if (!existente) {
      throw new NotFoundException(`Raça ${id} não encontrada.`);
    }

    try {
      await this.prisma.infolab_raca.delete({
        where: { id_raca: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta raça.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_raca: bigint;
    nome: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaRacaDto {
    return {
      id: registro.id_raca.toString(),
      nome: registro.nome ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
