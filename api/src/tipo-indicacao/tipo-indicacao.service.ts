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
import { AtualizarTipoIndicacaoDto } from './dto/atualizar-tipo-indicacao.dto';
import { CriarTipoIndicacaoDto } from './dto/criar-tipo-indicacao.dto';
import { RespostaListagemTipoIndicacaoDto } from './dto/resposta-listagem-tipo-indicacao.dto';
import { RespostaTipoIndicacaoDto } from './dto/resposta-tipo-indicacao.dto';

const NOME_APLICACAO_AUDITORIA = 'infotime-web';

function truncar(s: string, max: number): string {
  return s.length <= max ? s : s.slice(0, max);
}

@Injectable()
export class TipoIndicacaoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'codigo',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaTipoIndicacao(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_indicacaoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descicao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'codigo') {
      return {
        codigo: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tipo_indicacao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoTipoIndicacao(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_indicacaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'codigo', 'ativo']);
    const partes: Prisma.infolab_tipo_indicacaoWhereInput[] = [];

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
            descicao: { contains: contem, mode: 'insensitive' },
          });
        }
        continue;
      }

      if (campo === 'codigo' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            codigo: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemTipoIndicacaoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_tipo_indicacaoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_tipo_indicacao: true,
      codigo: true,
      descicao: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_indicacao,
      baseWhere,
      camposPesquisaWhitelist: TipoIndicacaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaTipoIndicacao(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoTipoIndicacao(j),
      orderBy: { id_tipo_indicacao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tipo_indicacao: bigint;
          codigo: string | null;
          descicao: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_tipo_indicacao.toString(),
          codigo: r.codigo ?? null,
          descricao: r.descicao ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_indicacao.findMany({
          where: where as Prisma.infolab_tipo_indicacaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoIndicacaoDto }> {
    const registro = await this.prisma.infolab_tipo_indicacao.findUnique({
      where: { id_tipo_indicacao: BigInt(id) },
    });

    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Tipo de indicação ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoIndicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_tipo_indicacao.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncar(ip, 255),
        nome_aplicacao_auditoria: truncar(NOME_APLICACAO_AUDITORIA, 20),
        codigo: dto.codigo ?? null,
        descicao: dto.descricao ?? null,
        ativo: dto.ativo ?? null,
      },
      select: { id_tipo_indicacao: true },
    });

    return { id: criado.id_tipo_indicacao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoIndicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_indicacao.findUnique({
      where: { id_tipo_indicacao: BigInt(id) },
      select: { id_tipo_indicacao: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Tipo de indicação ${id} não encontrado.`);
    }

    const data: Prisma.infolab_tipo_indicacaoUncheckedUpdateInput = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: truncar(ip, 255),
      nome_aplicacao_auditoria: truncar(NOME_APLICACAO_AUDITORIA, 20),
    };

    if (dto.codigo !== undefined) {
      data.codigo = dto.codigo ?? null;
    }
    if (dto.descricao !== undefined) {
      data.descicao = dto.descricao ?? null;
    }
    if (dto.ativo !== undefined) {
      data.ativo = dto.ativo ?? null;
    }

    await this.prisma.infolab_tipo_indicacao.update({
      where: { id_tipo_indicacao: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_tipo_indicacao.findUnique({
      where: { id_tipo_indicacao: BigInt(id) },
      select: { id_tipo_indicacao: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Tipo de indicação ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_indicacao.delete({
        where: { id_tipo_indicacao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de indicação.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_indicacao: bigint;
    id_tenacidade: bigint;
    codigo: string | null;
    descicao: string | null;
    ativo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoIndicacaoDto {
    return {
      id: registro.id_tipo_indicacao.toString(),
      codigo: registro.codigo ?? null,
      descricao: registro.descicao ?? null,
      ativo: registro.ativo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
