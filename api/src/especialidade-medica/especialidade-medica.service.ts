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
import { AtualizarEspecialidadeMedicaDto } from './dto/atualizar-especialidade-medica.dto';
import { CriarEspecialidadeMedicaDto } from './dto/criar-especialidade-medica.dto';
import { RespostaEspecialidadeMedicaDto } from './dto/resposta-especialidade-medica.dto';
import { RespostaListagemEspecialidadeMedicaDto } from './dto/resposta-listagem-especialidade-medica.dto';

@Injectable()
export class EspecialidadeMedicaService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'codigo_externo',
    'id_cbo',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_especialidade_medicaWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'codigo_externo') {
      return {
        codigo_externo: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id_cbo') {
      try {
        return { id_cbo: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_especialidade_medica: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_especialidade_medicaWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'codigo_externo']);
    const partes: Prisma.infolab_especialidade_medicaWhereInput[] = [];

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

      if (campo === 'codigo_externo' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            codigo_externo: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{
    dados: RespostaListagemEspecialidadeMedicaDto[];
    total: number;
  }> {
    void tenantContexto;
    const baseWhere: Prisma.infolab_especialidade_medicaWhereInput = {};

    const select = {
      id_especialidade_medica: true,
      descricao: true,
      codigo_externo: true,
      id_cbo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_especialidade_medica,
      baseWhere,
      camposPesquisaWhitelist: EspecialidadeMedicaService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_especialidade_medica: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_especialidade_medica: bigint;
          descricao: string | null;
          codigo_externo: string | null;
          id_cbo: bigint | null;
        };
        return {
          id: r.id_especialidade_medica.toString(),
          descricao: r.descricao ?? null,
          codigo_externo: r.codigo_externo ?? null,
          id_cbo: r.id_cbo != null ? r.id_cbo.toString() : null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_especialidade_medica.findMany({
          where: where as Prisma.infolab_especialidade_medicaWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaEspecialidadeMedicaDto }> {
    void tenantContexto;
    const registro = await this.prisma.infolab_especialidade_medica.findUnique({
      where: { id_especialidade_medica: BigInt(id) },
    });

    if (!registro) {
      throw new NotFoundException(`Especialidade médica ${id} não encontrada.`);
    }

    return { dados: this.mapearResposta(registro) };
  }

  async criar(
    dto: CriarEspecialidadeMedicaDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const idCbo = this.resolverIdCboCriacao(dto.id_cbo);

    const criado = await this.prisma.infolab_especialidade_medica.create({
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: ip.slice(0, 20),
        nome_aplicacao_auditoria: 'infotime-web',
        descricao: dto.descricao ?? null,
        codigo_ipsemg: dto.codigo_ipsemg ?? null,
        codigo_externo: dto.codigo_externo ?? null,
        codigo_migracao: dto.codigo_migracao ?? null,
        id_cbo: idCbo,
      },
      select: { id_especialidade_medica: true },
    });

    return { id: criado.id_especialidade_medica.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarEspecialidadeMedicaDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_especialidade_medica.findUnique(
      {
        where: { id_especialidade_medica: BigInt(id) },
        select: { id_especialidade_medica: true },
      },
    );

    if (!existente) {
      throw new NotFoundException(`Especialidade médica ${id} não encontrada.`);
    }

    const data: Prisma.infolab_especialidade_medicaUncheckedUpdateInput = {
      id_usuario_auditoria: tenantContexto.idUsuario,
      endereco_ip_auditoria: ip.slice(0, 20),
      nome_aplicacao_auditoria: 'infotime-web',
    };

    if (dto.descricao !== undefined) {
      data.descricao = dto.descricao;
    }
    if (dto.codigo_ipsemg !== undefined) {
      data.codigo_ipsemg = dto.codigo_ipsemg;
    }
    if (dto.codigo_externo !== undefined) {
      data.codigo_externo = dto.codigo_externo;
    }
    if (dto.codigo_migracao !== undefined) {
      data.codigo_migracao = dto.codigo_migracao;
    }
    if (dto.id_cbo !== undefined) {
      data.id_cbo =
        dto.id_cbo === null || dto.id_cbo === '' ? null : BigInt(dto.id_cbo);
    }

    await this.prisma.infolab_especialidade_medica.update({
      where: { id_especialidade_medica: BigInt(id) },
      data,
    });

    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    void tenantContexto;
    const existente = await this.prisma.infolab_especialidade_medica.findUnique(
      {
        where: { id_especialidade_medica: BigInt(id) },
        select: { id_especialidade_medica: true },
      },
    );

    if (!existente) {
      throw new NotFoundException(`Especialidade médica ${id} não encontrada.`);
    }

    try {
      await this.prisma.infolab_especialidade_medica.delete({
        where: { id_especialidade_medica: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta especialidade médica.',
        );
      }
      throw e;
    }

    return { ok: true };
  }

  private resolverIdCboCriacao(
    idCbo: string | null | undefined,
  ): bigint | null {
    if (idCbo === undefined || idCbo === null || idCbo === '') {
      return null;
    }
    return BigInt(idCbo);
  }

  private mapearResposta(registro: {
    id_especialidade_medica: bigint;
    id_cbo: bigint | null;
    descricao: string | null;
    codigo_ipsemg: string | null;
    codigo_externo: string | null;
    codigo_migracao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaEspecialidadeMedicaDto {
    return {
      id: registro.id_especialidade_medica.toString(),
      id_cbo: registro.id_cbo != null ? registro.id_cbo.toString() : null,
      descricao: registro.descricao ?? null,
      codigo_ipsemg: registro.codigo_ipsemg ?? null,
      codigo_externo: registro.codigo_externo ?? null,
      codigo_migracao: registro.codigo_migracao ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
