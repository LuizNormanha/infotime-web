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
import { AtualizarMotivoDescontoDto } from './dto/atualizar-motivo-desconto.dto';
import { CriarMotivoDescontoDto } from './dto/criar-motivo-desconto.dto';
import { RespostaMotivoDescontoDto } from './dto/resposta-motivo-desconto.dto';
import { RespostaListagemMotivoDescontoDto } from './dto/resposta-listagem-motivo-desconto.dto';

function codigoExternoParaBigInt(valor: string | undefined): bigint | null {
  if (valor === undefined) return null;
  const s = valor.trim();
  if (!s) return null;
  try {
    return BigInt(s);
  } catch {
    throw new BadRequestException(
      'codigo_externo inválido: use apenas dígitos.',
    );
  }
}

@Injectable()
export class MotivoDescontoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'codigo_migracao',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaMotivoDesconto(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_motivo_descontoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'codigo_migracao') {
      const n = parseInt(qTexto, 10);
      if (!Number.isFinite(n)) return {};
      return { codigo_migracao: n };
    }
    return {};
  }

  private whereFiltroRefinadoMotivoDesconto(
    jsonBruto: string | undefined,
  ): Prisma.infolab_motivo_descontoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_motivo_descontoWhereInput[] = [];

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

  private mapearLinhaListagem(r: {
    id_motivo_desconto: bigint;
    descricao: string | null;
    codigo_migracao: number | null;
    codigo_externo: bigint | null;
  }): RespostaListagemMotivoDescontoDto {
    return {
      id: r.id_motivo_desconto.toString(),
      descricao: r.descricao ?? null,
      codigo_migracao: r.codigo_migracao ?? null,
      codigo_externo:
        r.codigo_externo !== null && r.codigo_externo !== undefined
          ? r.codigo_externo.toString()
          : null,
    };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemMotivoDescontoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_motivo_descontoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_motivo_desconto: true,
      descricao: true,
      codigo_migracao: true,
      codigo_externo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_motivo_desconto,
      baseWhere,
      camposPesquisaWhitelist: MotivoDescontoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaMotivoDesconto(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoMotivoDesconto(j),
      orderBy: { id_motivo_desconto: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) =>
        this.mapearLinhaListagem(
          row as {
            id_motivo_desconto: bigint;
            descricao: string | null;
            codigo_migracao: number | null;
            codigo_externo: bigint | null;
          },
        ),
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_motivo_desconto.findMany({
          where: where as Prisma.infolab_motivo_descontoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaMotivoDescontoDto }> {
    const registro = await this.prisma.infolab_motivo_desconto.findUnique({
      where: { id_motivo_desconto: BigInt(id) },
    });

    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Motivo de desconto ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarMotivoDescontoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const codigoExterno =
      dto.codigo_externo !== undefined
        ? codigoExternoParaBigInt(dto.codigo_externo)
        : null;

    const criado = await this.prisma.infolab_motivo_desconto.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao,
        codigo_migracao: dto.codigo_migracao ?? null,
        codigo_externo: codigoExterno,
      },
      select: { id_motivo_desconto: true },
    });

    return { id: criado.id_motivo_desconto.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarMotivoDescontoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_motivo_desconto.findUnique({
      where: { id_motivo_desconto: BigInt(id) },
      select: { id_motivo_desconto: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Motivo de desconto ${id} não encontrado.`);
    }

    const data: Prisma.infolab_motivo_descontoUncheckedUpdateInput = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: ip.slice(0, 20),
      nome_aplicacao_auditoria: 'infotime-web',
    };

    if (dto.descricao !== undefined) {
      data.descricao = dto.descricao;
    }
    if (dto.codigo_migracao !== undefined) {
      data.codigo_migracao = dto.codigo_migracao;
    }
    if (dto.codigo_externo !== undefined) {
      data.codigo_externo = codigoExternoParaBigInt(dto.codigo_externo);
    }

    await this.prisma.infolab_motivo_desconto.update({
      where: { id_motivo_desconto: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_motivo_desconto.findUnique({
      where: { id_motivo_desconto: BigInt(id) },
      select: { id_motivo_desconto: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Motivo de desconto ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_motivo_desconto.delete({
        where: { id_motivo_desconto: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este motivo de desconto.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_motivo_desconto: bigint;
    id_tenacidade: bigint;
    descricao: string | null;
    codigo_migracao: number | null;
    codigo_externo: bigint | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaMotivoDescontoDto {
    return {
      id: registro.id_motivo_desconto.toString(),
      descricao: registro.descricao ?? null,
      codigo_migracao: registro.codigo_migracao ?? null,
      codigo_externo:
        registro.codigo_externo !== null &&
        registro.codigo_externo !== undefined
          ? registro.codigo_externo.toString()
          : null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
