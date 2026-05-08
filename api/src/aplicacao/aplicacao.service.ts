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
import { AtualizarAplicacaoDto } from './dto/atualizar-aplicacao.dto';
import { CriarAplicacaoDto } from './dto/criar-aplicacao.dto';
import { RespostaAplicacaoDto } from './dto/resposta-aplicacao.dto';
import { RespostaListagemAplicacaoDto } from './dto/resposta-listagem-aplicacao.dto';

const IP_MAX = 45;
const APP = 'infotime-web';

@Injectable()
export class AplicacaoService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'nomeAplicacao',
    'codigoAplicacao',
    'id',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_aplicacaoWhereInput {
    if (campoPesquisa === 'nomeAplicacao') {
      return {
        nome_aplicacao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'codigoAplicacao') {
      return {
        codigo_aplicacao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_aplicacao: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infolab_aplicacaoWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['nomeAplicacao']);
    const partes: Prisma.infolab_aplicacaoWhereInput[] = [];

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

      if (campo === 'nomeAplicacao' && tipo === 'texto') {
        const contem =
          typeof val['contem'] === 'string' ? val['contem'].trim() : '';
        if (contem) {
          partes.push({
            nome_aplicacao: { contains: contem, mode: 'insensitive' },
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
  ): Promise<{ dados: RespostaListagemAplicacaoDto[]; total: number }> {
    const baseWhere: Prisma.infolab_aplicacaoWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_aplicacao: true,
      codigo_aplicacao: true,
      nome_aplicacao: true,
      ativo: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 500,
      delegate: this.prisma.infolab_aplicacao,
      baseWhere,
      camposPesquisaWhitelist: AplicacaoService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_aplicacao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_aplicacao: bigint;
          codigo_aplicacao: string;
          nome_aplicacao: string;
          ativo: boolean;
        };
        return {
          id: r.id_aplicacao.toString(),
          codigoAplicacao: r.codigo_aplicacao,
          nomeAplicacao: r.nome_aplicacao,
          ativo: r.ativo,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_aplicacao.findMany({
          where: where as Prisma.infolab_aplicacaoWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaAplicacaoDto }> {
    const registro = await this.prisma.infolab_aplicacao.findUnique({
      where: { id_aplicacao: BigInt(id) },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Aplicação ${id} não encontrada.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarAplicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    try {
      const criado = await this.prisma.infolab_aplicacao.create({
        data: {
          id_tenacidade: tenantContexto.idTenacidade,
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          codigo_aplicacao: dto.codigoAplicacao,
          nome_aplicacao: dto.nomeAplicacao,
          descricao_aplicacao: dto.descricaoAplicacao ?? null,
          nome_tabela_principal: dto.nomeTabelaPrincipal,
          nome_rota_frontend: dto.nomeRotaFrontend ?? null,
          nome_endpoint_backend: dto.nomeEndpointBackend ?? null,
          usa_listagem: dto.usaListagem ?? true,
          usa_formulario: dto.usaFormulario ?? true,
          ativo: dto.ativo ?? true,
          dica_aplicacao: dto.dicaAplicacao ?? null,
          observacao: dto.observacao ?? null,
        },
        select: { id_aplicacao: true },
      });
      return { id: criado.id_aplicacao.toString() };
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Já existe uma aplicação com este código para a tenacidade.',
        );
      }
      throw e;
    }
  }

  async atualizar(
    id: string,
    dto: AtualizarAplicacaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_aplicacao.findUnique({
      where: { id_aplicacao: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Aplicação ${id} não encontrada.`);
    }
    try {
      await this.prisma.infolab_aplicacao.update({
        where: { id_aplicacao: BigInt(id) },
        data: {
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          ...(dto.codigoAplicacao !== undefined && {
            codigo_aplicacao: dto.codigoAplicacao,
          }),
          ...(dto.nomeAplicacao !== undefined && {
            nome_aplicacao: dto.nomeAplicacao,
          }),
          ...(dto.descricaoAplicacao !== undefined && {
            descricao_aplicacao: dto.descricaoAplicacao,
          }),
          ...(dto.nomeTabelaPrincipal !== undefined && {
            nome_tabela_principal: dto.nomeTabelaPrincipal,
          }),
          ...(dto.nomeRotaFrontend !== undefined && {
            nome_rota_frontend: dto.nomeRotaFrontend,
          }),
          ...(dto.nomeEndpointBackend !== undefined && {
            nome_endpoint_backend: dto.nomeEndpointBackend,
          }),
          ...(dto.usaListagem !== undefined && {
            usa_listagem: dto.usaListagem,
          }),
          ...(dto.usaFormulario !== undefined && {
            usa_formulario: dto.usaFormulario,
          }),
          ...(dto.ativo !== undefined && { ativo: dto.ativo }),
          ...(dto.dicaAplicacao !== undefined && {
            dica_aplicacao: dto.dicaAplicacao,
          }),
          ...(dto.observacao !== undefined && { observacao: dto.observacao }),
        },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Já existe uma aplicação com este código para a tenacidade.',
        );
      }
      throw e;
    }
    return { id };
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_aplicacao.findUnique({
      where: { id_aplicacao: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Aplicação ${id} não encontrada.`);
    }
    try {
      await this.prisma.infolab_aplicacao.delete({
        where: { id_aplicacao: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a esta aplicação.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  private mapear(registro: {
    id_aplicacao: bigint;
    codigo_aplicacao: string;
    nome_aplicacao: string;
    descricao_aplicacao: string | null;
    nome_tabela_principal: string;
    nome_rota_frontend: string | null;
    nome_endpoint_backend: string | null;
    usa_listagem: boolean;
    usa_formulario: boolean;
    ativo: boolean;
    dica_aplicacao: string | null;
    observacao: string | null;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
  }): RespostaAplicacaoDto {
    return {
      id: registro.id_aplicacao.toString(),
      codigoAplicacao: registro.codigo_aplicacao,
      nomeAplicacao: registro.nome_aplicacao,
      descricaoAplicacao: registro.descricao_aplicacao,
      nomeTabelaPrincipal: registro.nome_tabela_principal,
      nomeRotaFrontend: registro.nome_rota_frontend,
      nomeEndpointBackend: registro.nome_endpoint_backend,
      usaListagem: registro.usa_listagem,
      usaFormulario: registro.usa_formulario,
      ativo: registro.ativo,
      dicaAplicacao: registro.dica_aplicacao,
      observacao: registro.observacao,
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
