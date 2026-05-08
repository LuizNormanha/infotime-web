import {
  BadRequestException,
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
import { AtualizarTipoIntegracaoDto } from './dto/atualizar-tipo-integracao.dto';
import { CriarTipoIntegracaoDto } from './dto/criar-tipo-integracao.dto';
import { RespostaListagemTipoIntegracaoDto } from './dto/resposta-listagem-tipo-integracao.dto';
import { RespostaTipoIntegracaoDto } from './dto/resposta-tipo-integracao.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

function codigoMigracaoStringParaBigInt(
  valor: string | null | undefined,
): bigint | null {
  if (valor === undefined || valor === null) return null;
  const s = valor.trim();
  if (!s) return null;
  try {
    return BigInt(s);
  } catch {
    throw new BadRequestException(
      'codigo_migracao inválido: use apenas dígitos.',
    );
  }
}

@Injectable()
export class TipoIntegracaoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'id',
    'codigo_migracao',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaTipoIntegracao(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_integracaoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tipo_integracao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'codigo_migracao') {
      try {
        return { codigo_migracao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoTipoIntegracao(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_integracaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'ativo']);
    const partes: Prisma.infolab_tipo_integracaoWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemTipoIntegracaoDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_tipo_integracaoWhereInput = {};

    const select = {
      id_tipo_integracao: true,
      descricao: true,
      ativo: true,
      codigo_migracao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_integracao,
      baseWhere,
      camposPesquisaWhitelist: TipoIntegracaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaTipoIntegracao(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoTipoIntegracao(j),
      orderBy: { id_tipo_integracao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tipo_integracao: bigint;
          descricao: string | null;
          ativo: string | null;
          codigo_migracao: bigint | null;
        };
        return {
          id: r.id_tipo_integracao.toString(),
          descricao: r.descricao ?? null,
          ativo: r.ativo ?? null,
          codigo_migracao: r.codigo_migracao?.toString() ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_integracao.findMany({
          where: where as Prisma.infolab_tipo_integracaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoIntegracaoDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_tipo_integracao.findUnique({
      where: { id_tipo_integracao: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Tipo de integração ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoIntegracaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_tipo_integracao.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
        ...(dto.codigo_migracao !== undefined && {
          codigo_migracao: codigoMigracaoStringParaBigInt(dto.codigo_migracao),
        }),
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
      },
      select: { id_tipo_integracao: true },
    });

    return { id: criado.id_tipo_integracao.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoIntegracaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_integracao.findUnique({
      where: { id_tipo_integracao: BigInt(id) },
      select: { id_tipo_integracao: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de integração ${id} não encontrado.`);
    }

    await this.prisma.infolab_tipo_integracao.update({
      where: { id_tipo_integracao: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: 'infotime-web',
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.codigo_migracao !== undefined && {
          codigo_migracao: codigoMigracaoStringParaBigInt(dto.codigo_migracao),
        }),
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
      },
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_tipo_integracao.findUnique({
      where: { id_tipo_integracao: BigInt(id) },
      select: { id_tipo_integracao: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de integração ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_integracao.delete({
        where: { id_tipo_integracao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de integração.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_integracao: bigint;
    descricao: string | null;
    codigo_migracao: bigint | null;
    ativo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoIntegracaoDto {
    return {
      id: registro.id_tipo_integracao.toString(),
      descricao: registro.descricao ?? null,
      codigo_migracao: registro.codigo_migracao?.toString() ?? null,
      ativo: registro.ativo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
