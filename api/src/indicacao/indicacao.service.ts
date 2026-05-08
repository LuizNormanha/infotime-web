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
import { AtualizarIndicacaoDto } from './dto/atualizar-indicacao.dto';
import { CriarIndicacaoDto } from './dto/criar-indicacao.dto';
import { RespostaIndicacaoDto } from './dto/resposta-indicacao.dto';
import { RespostaListagemIndicacaoDto } from './dto/resposta-listagem-indicacao.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

@Injectable()
export class IndicacaoService {
  private static readonly CAMPOS_PESQUISA = new Set(['nome', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisaIndicacao(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_indicacaoWhereInput {
    if (campoPesquisa === 'nome') {
      return {
        nome: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_indicacao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoIndicacao(
    jsonBruto: string | undefined,
  ): Prisma.infolab_indicacaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nome', 'ativo']);
    const partes: Prisma.infolab_indicacaoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemIndicacaoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_indicacaoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_indicacao: true,
      nome: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_indicacao,
      baseWhere,
      camposPesquisaWhitelist: IndicacaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaIndicacao(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoIndicacao(j),
      orderBy: { id_indicacao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_indicacao: bigint;
          nome: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_indicacao.toString(),
          nome: r.nome ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_indicacao.findMany({
          where: where as Prisma.infolab_indicacaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaIndicacaoDto }> {
    const registro = await this.prisma.infolab_indicacao.findUnique({
      where: { id_indicacao: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Indicação ${id} não encontrada.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarIndicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_indicacao.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        nome: dto.nome,
        ativo: dto.ativo ?? null,
      },
      select: { id_indicacao: true },
    });
    return { id: criado.id_indicacao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarIndicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_indicacao.findUnique({
      where: { id_indicacao: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Indicação ${id} não encontrada.`);
    }
    await this.prisma.infolab_indicacao.update({
      where: { id_indicacao: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        ...(dto.nome !== undefined && { nome: dto.nome }),
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
      },
    });
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_indicacao.findUnique({
      where: { id_indicacao: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Indicação ${id} não encontrada.`);
    }
    try {
      await this.prisma.infolab_indicacao.delete({
        where: { id_indicacao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta indicação.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_indicacao: bigint;
    nome: string | null;
    ativo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaIndicacaoDto {
    return {
      id: registro.id_indicacao.toString(),
      nome: registro.nome ?? null,
      ativo: registro.ativo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
