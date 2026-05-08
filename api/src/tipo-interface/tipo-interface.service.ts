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
import { AtualizarTipoInterfaceDto } from './dto/atualizar-tipo-interface.dto';
import { CriarTipoInterfaceDto } from './dto/criar-tipo-interface.dto';
import { RespostaListagemTipoInterfaceDto } from './dto/resposta-listagem-tipo-interface.dto';
import { RespostaTipoInterfaceDto } from './dto/resposta-tipo-interface.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

const NOME_APLICACAO_AUDITORIA = 'infotime-web'.slice(0, 20);

@Injectable()
export class TipoInterfaceService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaTipoInterface(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_interfaceWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tipo_interface: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoTipoInterface(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_interfaceWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'ativo']);
    const partes: Prisma.infolab_tipo_interfaceWhereInput[] = [];

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
  ): Promise<{ dados: RespostaListagemTipoInterfaceDto[]; total: number }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_tipo_interfaceWhereInput = {};

    const select = {
      id_tipo_interface: true,
      descricao: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_interface,
      baseWhere,
      camposPesquisaWhitelist: TipoInterfaceService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaTipoInterface(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoTipoInterface(j),
      orderBy: { id_tipo_interface: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tipo_interface: bigint;
          descricao: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_tipo_interface.toString(),
          descricao: r.descricao ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_interface.findMany({
          where: where as Prisma.infolab_tipo_interfaceWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoInterfaceDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_tipo_interface.findUnique({
      where: { id_tipo_interface: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Tipo de interface ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoInterfaceDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_tipo_interface.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: NOME_APLICACAO_AUDITORIA,
        descricao: dto.descricao,
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
      },
      select: { id_tipo_interface: true },
    });

    return { id: criado.id_tipo_interface.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoInterfaceDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_interface.findUnique({
      where: { id_tipo_interface: BigInt(id) },
      select: { id_tipo_interface: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de interface ${id} não encontrado.`);
    }

    await this.prisma.infolab_tipo_interface.update({
      where: { id_tipo_interface: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 255),
        nome_aplicacao_auditoria: NOME_APLICACAO_AUDITORIA,
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
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
    const existente = await this.prisma.infolab_tipo_interface.findUnique({
      where: { id_tipo_interface: BigInt(id) },
      select: { id_tipo_interface: true },
    });

    if (!existente) {
      throw new NotFoundException(`Tipo de interface ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_interface.delete({
        where: { id_tipo_interface: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de interface.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_interface: bigint;
    descricao: string | null;
    ativo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoInterfaceDto {
    return {
      id: registro.id_tipo_interface.toString(),
      descricao: registro.descricao ?? null,
      ativo: registro.ativo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
