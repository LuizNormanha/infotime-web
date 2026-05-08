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
import { AtualizarProcedenciaDto } from './dto/atualizar-procedencia.dto';
import { CriarProcedenciaDto } from './dto/criar-procedencia.dto';
import { RespostaProcedenciaDto } from './dto/resposta-procedencia.dto';
import { RespostaListagemProcedenciaDto } from './dto/resposta-listagem-procedencia.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

@Injectable()
export class ProcedenciaService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'descricao',
    'sigla',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisaProcedencia(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_procedenciaWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'sigla') {
      return {
        sigla: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_procedencia: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoProcedencia(
    jsonBruto: string | undefined,
  ): Prisma.infolab_procedenciaWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao', 'sigla', 'ativo']);
    const partes: Prisma.infolab_procedenciaWhereInput[] = [];

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

      if (campo === 'sigla' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            sigla: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemProcedenciaDto[]; total: number }> {
    const baseWhere: Prisma.infolab_procedenciaWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_procedencia: true,
      descricao: true,
      sigla: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_procedencia,
      baseWhere,
      camposPesquisaWhitelist: ProcedenciaService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaProcedencia(campo, q),
      montarWhereFiltroRefinado: (j) =>
        this.whereFiltroRefinadoProcedencia(j),
      orderBy: { id_procedencia: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_procedencia: bigint;
          descricao: string | null;
          sigla: string | null;
          ativo: string | null;
        };
        return {
          id: r.id_procedencia.toString(),
          descricao: r.descricao ?? null,
          sigla: r.sigla ?? null,
          ativo: r.ativo ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_procedencia.findMany({
          where: where as Prisma.infolab_procedenciaWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaProcedenciaDto }> {
    const registro = await this.prisma.infolab_procedencia.findUnique({
      where: { id_procedencia: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Procedência ${id} não encontrada.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarProcedenciaDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const criado = await this.prisma.infolab_procedencia.create({
      data: {
        id_tenacidade: tenantContexto.idTenacidade,
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        descricao: dto.descricao,
        sigla: dto.sigla ?? null,
        email: dto.email ?? null,
        setor: dto.setor ?? null,
        ala: dto.ala ?? null,
        leito: dto.leito ?? null,
        quarto: dto.quarto ?? null,
        publica: dto.publica ?? null,
        urgente: dto.urgente ?? null,
        ativo: dto.ativo ?? null,
        codigo_externo: dto.codigoExterno ?? null,
      },
      select: { id_procedencia: true },
    });
    return { id: criado.id_procedencia.toString() };
  }

  async atualizar(
    id: string,
    dto: AtualizarProcedenciaDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_procedencia.findUnique({
      where: { id_procedencia: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Procedência ${id} não encontrada.`);
    }
    await this.prisma.infolab_procedencia.update({
      where: { id_procedencia: BigInt(id) },
      data: {
        id_usuario_auditoria: tenantContexto.idUsuario,
        endereco_ip_auditoria: this.fatiarIp(ip),
        nome_aplicacao_auditoria: APP,
        ...(dto.descricao !== undefined && { descricao: dto.descricao }),
        ...(dto.sigla !== undefined && { sigla: dto.sigla }),
        ...(dto.email !== undefined && { email: dto.email }),
        ...(dto.setor !== undefined && { setor: dto.setor }),
        ...(dto.ala !== undefined && { ala: dto.ala }),
        ...(dto.leito !== undefined && { leito: dto.leito }),
        ...(dto.quarto !== undefined && { quarto: dto.quarto }),
        ...(dto.publica !== undefined && { publica: dto.publica }),
        ...(dto.urgente !== undefined && { urgente: dto.urgente }),
        ...(dto.ativo !== undefined && { ativo: dto.ativo }),
        ...(dto.codigoExterno !== undefined && {
          codigo_externo: dto.codigoExterno,
        }),
      },
    });
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_procedencia.findUnique({
      where: { id_procedencia: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Procedência ${id} não encontrada.`);
    }
    try {
      await this.prisma.infolab_procedencia.delete({
        where: { id_procedencia: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta procedência.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_procedencia: bigint;
    descricao: string | null;
    sigla: string | null;
    email: string | null;
    setor: string | null;
    ala: string | null;
    leito: string | null;
    quarto: string | null;
    publica: string | null;
    urgente: string | null;
    ativo: string | null;
    codigo_externo: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaProcedenciaDto {
    return {
      id: registro.id_procedencia.toString(),
      descricao: registro.descricao ?? null,
      sigla: registro.sigla ?? null,
      email: registro.email ?? null,
      setor: registro.setor ?? null,
      ala: registro.ala ?? null,
      leito: registro.leito ?? null,
      quarto: registro.quarto ?? null,
      publica: registro.publica ?? null,
      urgente: registro.urgente ?? null,
      ativo: registro.ativo ?? null,
      codigoExterno: registro.codigo_externo ?? null,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
