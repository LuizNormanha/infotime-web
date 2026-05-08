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
import { AtualizarTipoPagamentoDto } from './dto/atualizar-tipo-pagamento.dto';
import { CriarTipoPagamentoDto } from './dto/criar-tipo-pagamento.dto';
import { RespostaListagemTipoPagamentoDto } from './dto/resposta-listagem-tipo-pagamento.dto';
import { RespostaTipoPagamentoDto } from './dto/resposta-tipo-pagamento.dto';

function truncarIp(ip: string, max: number): string {
  return ip.length <= max ? ip : ip.slice(0, max);
}

function codigoExternoParaBigInt(valor: string): bigint | null {
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
export class TipoPagamentoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'id',
    'codigo_tipo_pagamento',
    'bandeira',
    'documento_obrigatorio',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaTipoPagamento(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_tipo_pagamentoWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_tipo_pagamento: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'codigo_tipo_pagamento') {
      return {
        codigo_tipo_pagamento: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'bandeira') {
      return {
        bandeira: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'documento_obrigatorio') {
      const u = qTexto.trim().toUpperCase();
      const letra =
        u === 'S' || u.startsWith('SIM')
          ? 'S'
          : u === 'N' || u.startsWith('NÃO') || u.startsWith('NAO')
            ? 'N'
            : null;
      if (letra != null) {
        return { documento_obrigatorio: letra };
      }
    }
    return {};
  }

  private whereFiltroRefinadoTipoPagamento(
    jsonBruto: string | undefined,
  ): Prisma.infolab_tipo_pagamentoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'bandeira', 'documento_obrigatorio']);
    const partes: Prisma.infolab_tipo_pagamentoWhereInput[] = [];

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

      if (campo === 'bandeira' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            bandeira: { contains: contem, mode: 'insensitive' },
          });
        }
        continue;
      }

      if (campo === 'documento_obrigatorio' && tipo === 'enum') {
        const vals = val['valores'];
        if (!Array.isArray(vals) || vals.length === 0) continue;
        const letras = vals.filter(
          (x): x is string => typeof x === 'string' && (x === 'S' || x === 'N'),
        );
        if (letras.length > 0) {
          partes.push({ documento_obrigatorio: { in: letras } });
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
  ): Promise<{ dados: RespostaListagemTipoPagamentoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_tipo_pagamentoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_tipo_pagamento: true,
      codigo_tipo_pagamento: true,
      descricao: true,
      limite_parcelas: true,
      bandeira: true,
      documento_obrigatorio: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_tipo_pagamento,
      baseWhere,
      camposPesquisaWhitelist: TipoPagamentoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaTipoPagamento(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoTipoPagamento(j),
      orderBy: { id_tipo_pagamento: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_tipo_pagamento: bigint;
          codigo_tipo_pagamento: string | null;
          descricao: string | null;
          limite_parcelas: number | null;
          bandeira: string | null;
          documento_obrigatorio: string | null;
        };
        return {
          id: r.id_tipo_pagamento.toString(),
          codigo_tipo_pagamento: r.codigo_tipo_pagamento ?? null,
          descricao: r.descricao ?? null,
          limite_parcelas: r.limite_parcelas ?? null,
          bandeira: r.bandeira ?? null,
          documento_obrigatorio: r.documento_obrigatorio ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_tipo_pagamento.findMany({
          where: where as Prisma.infolab_tipo_pagamentoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaTipoPagamentoDto }> {
    const registro = await this.prisma.infolab_tipo_pagamento.findUnique({
      where: { id_tipo_pagamento: BigInt(id) },
    });

    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Tipo de pagamento ${id} não encontrado.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarTipoPagamentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const codigoExterno =
      dto.codigo_externo !== undefined && dto.codigo_externo !== null
        ? codigoExternoParaBigInt(dto.codigo_externo)
        : null;

    const criado = await this.prisma.infolab_tipo_pagamento.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: truncarIp(ip, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        codigo_tipo_pagamento: dto.codigo_tipo_pagamento ?? null,
        descricao: dto.descricao ?? null,
        limite_parcelas: dto.limite_parcelas ?? null,
        bandeira: dto.bandeira ?? null,
        documento_obrigatorio: dto.documento_obrigatorio ?? null,
        codigo_migracao: dto.codigo_migracao ?? null,
        codigo_externo: codigoExterno,
      },
      select: { id_tipo_pagamento: true },
    });

    return { id: criado.id_tipo_pagamento.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarTipoPagamentoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_tipo_pagamento.findUnique({
      where: { id_tipo_pagamento: BigInt(id) },
      select: { id_tipo_pagamento: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Tipo de pagamento ${id} não encontrado.`);
    }

    const data: Prisma.infolab_tipo_pagamentoUncheckedUpdateInput = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: truncarIp(ip, 20),
      nome_aplicacao_auditoria: 'infotime-web',
    };

    if (dto.codigo_tipo_pagamento !== undefined) {
      data.codigo_tipo_pagamento = dto.codigo_tipo_pagamento ?? null;
    }
    if (dto.descricao !== undefined) {
      data.descricao = dto.descricao ?? null;
    }
    if (dto.limite_parcelas !== undefined) {
      data.limite_parcelas = dto.limite_parcelas;
    }
    if (dto.bandeira !== undefined) {
      data.bandeira = dto.bandeira ?? null;
    }
    if (dto.documento_obrigatorio !== undefined) {
      data.documento_obrigatorio = dto.documento_obrigatorio ?? null;
    }
    if (dto.codigo_migracao !== undefined) {
      data.codigo_migracao = dto.codigo_migracao;
    }
    if (dto.codigo_externo !== undefined) {
      data.codigo_externo =
        dto.codigo_externo === null
          ? null
          : codigoExternoParaBigInt(dto.codigo_externo);
    }

    await this.prisma.infolab_tipo_pagamento.update({
      where: { id_tipo_pagamento: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_tipo_pagamento.findUnique({
      where: { id_tipo_pagamento: BigInt(id) },
      select: { id_tipo_pagamento: true, id_tenacidade: true },
    });

    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Tipo de pagamento ${id} não encontrado.`);
    }

    try {
      await this.prisma.infolab_tipo_pagamento.delete({
        where: { id_tipo_pagamento: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este tipo de pagamento.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private mapearResposta(registro: {
    id_tipo_pagamento: bigint;
    id_tenacidade: bigint;
    codigo_tipo_pagamento: string | null;
    descricao: string | null;
    limite_parcelas: number | null;
    bandeira: string | null;
    documento_obrigatorio: string | null;
    codigo_migracao: number | null;
    codigo_externo: bigint | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaTipoPagamentoDto {
    return {
      id: registro.id_tipo_pagamento.toString(),
      codigo_tipo_pagamento: registro.codigo_tipo_pagamento ?? null,
      descricao: registro.descricao ?? null,
      limite_parcelas: registro.limite_parcelas ?? null,
      bandeira: registro.bandeira ?? null,
      documento_obrigatorio: registro.documento_obrigatorio ?? null,
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
