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
import { AtualizarUsuarioPermissaoDto } from './dto/atualizar-usuario-permissao.dto';
import { CriarUsuarioPermissaoDto } from './dto/criar-usuario-permissao.dto';
import {
  RespostaListagemUsuarioPermissaoDto,
  RespostaUsuarioPermissaoDto,
} from './dto/resposta-usuario-permissao.dto';

const IP_MAX = 20;
const APP = 'infotime-web';

function snParaBool(v: string | null | undefined): boolean {
  return v === 'S' || v === 's';
}

function boolParaSn(v: boolean | undefined, padrao: boolean): string {
  return (v ?? padrao) ? 'S' : 'N';
}

@Injectable()
export class UsuarioPermissoesService {
  private static readonly CAMPOS_PESQUISA = new Set([
    'id',
    'grupoUsuarioDescricao',
    'formularioCodigo',
    'formularioDescricao',
  ]);

  constructor(private readonly prisma: PrismaService) {}

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private whereCampoPesquisa(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infotime_usuario_permissoesWhereInput {
    const q = qTexto.trim();
    if (campoPesquisa === 'id') {
      try {
        return { id_usuario_permissao: BigInt(q) };
      } catch {
        return {};
      }
    }
    if (campoPesquisa === 'grupoUsuarioDescricao') {
      return {
        infotime_grupo_usuario: {
          descricao: { contains: q, mode: 'insensitive' },
        },
      };
    }
    if (campoPesquisa === 'formularioCodigo') {
      return {
        infotime_formulario: {
          codigo: { contains: q, mode: 'insensitive' },
        },
      };
    }
    if (campoPesquisa === 'formularioDescricao') {
      return {
        infotime_formulario: {
          descricao: { contains: q, mode: 'insensitive' },
        },
      };
    }
    return {};
  }

  private whereFiltroRefinado(
    jsonBruto: string | undefined,
  ): Prisma.infotime_usuario_permissoesWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set([
      'grupoUsuarioDescricao',
      'formularioCodigo',
      'formularioDescricao',
    ]);
    const partes: Prisma.infotime_usuario_permissoesWhereInput[] = [];

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
      if (tipo !== 'texto') continue;
      const contem =
        typeof val['contem'] === 'string' ? val['contem'].trim() : '';
      if (!contem) continue;

      if (campo === 'grupoUsuarioDescricao') {
        partes.push({
          infotime_grupo_usuario: {
            descricao: { contains: contem, mode: 'insensitive' },
          },
        });
      }
      if (campo === 'formularioCodigo') {
        partes.push({
          infotime_formulario: {
            codigo: { contains: contem, mode: 'insensitive' },
          },
        });
      }
      if (campo === 'formularioDescricao') {
        partes.push({
          infotime_formulario: {
            descricao: { contains: contem, mode: 'insensitive' },
          },
        });
      }
    }

    if (partes.length === 0) return {};
    return partes.length === 1 ? partes[0] : { AND: partes };
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{
    dados: RespostaListagemUsuarioPermissaoDto[];
    total: number;
  }> {
    const baseWhere: Prisma.infotime_usuario_permissoesWhereInput = {
      infotime_grupo_usuario: {
        id_tenacidade: tenantContexto.idTenacidade,
      },
    };

    const select = {
      id_usuario_permissao: true,
      id_grupo_usuario: true,
      id_formulario: true,
      administrador: true,
      incluir: true,
      editar: true,
      excluir: true,
      infotime_grupo_usuario: { select: { descricao: true } },
      infotime_formulario: { select: { codigo: true, descricao: true } },
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 500,
      delegate: this.prisma.infotime_usuario_permissoes,
      baseWhere,
      camposPesquisaWhitelist: UsuarioPermissoesService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) => this.whereCampoPesquisa(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinado(j),
      orderBy: { id_usuario_permissao: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as {
          id_usuario_permissao: bigint;
          id_grupo_usuario: bigint;
          id_formulario: bigint;
          administrador: string;
          incluir: string;
          editar: string;
          excluir: string;
          infotime_grupo_usuario: { descricao: string | null };
          infotime_formulario: { codigo: string; descricao: string | null };
        };
        return {
          id: r.id_usuario_permissao.toString(),
          idGrupoUsuario: r.id_grupo_usuario.toString(),
          idFormulario: r.id_formulario.toString(),
          grupoUsuarioDescricao: r.infotime_grupo_usuario.descricao ?? null,
          formularioCodigo: r.infotime_formulario.codigo,
          formularioDescricao: r.infotime_formulario.descricao ?? null,
          administrador: snParaBool(r.administrador),
          incluir: snParaBool(r.incluir),
          editar: snParaBool(r.editar),
          excluir: snParaBool(r.excluir),
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infotime_usuario_permissoes.findMany({
          where: where as Prisma.infotime_usuario_permissoesWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaUsuarioPermissaoDto }> {
    const registro = await this.prisma.infotime_usuario_permissoes.findUnique({
      where: { id_usuario_permissao: BigInt(id) },
      include: {
        infotime_grupo_usuario: {
          select: { id_tenacidade: true, descricao: true },
        },
        infotime_formulario: { select: { codigo: true, descricao: true } },
      },
    });
    if (
      !registro ||
      registro.infotime_grupo_usuario.id_tenacidade !==
        tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Permissão de usuário ${id} não encontrada.`);
    }
    return { dados: this.mapear(registro) };
  }

  async criar(
    dto: CriarUsuarioPermissaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const grupo = await this.prisma.infotime_grupo_usuario.findFirst({
      where: {
        id_grupo_usuario: BigInt(dto.idGrupoUsuario),
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_grupo_usuario: true },
    });
    if (!grupo) {
      throw new NotFoundException(
        'Grupo de usuário não encontrado neste tenant.',
      );
    }

    const formulario = await this.prisma.infotime_formulario.findUnique({
      where: { id_formulario: BigInt(dto.idFormulario) },
      select: { id_formulario: true },
    });
    if (!formulario) {
      throw new NotFoundException('Formulário (tela) não encontrado.');
    }

    try {
      const criado = await this.prisma.infotime_usuario_permissoes.create({
        data: {
          id_grupo_usuario: BigInt(dto.idGrupoUsuario),
          id_formulario: BigInt(dto.idFormulario),
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          administrador: boolParaSn(dto.administrador, false),
          incluir: boolParaSn(dto.incluir, false),
          editar: boolParaSn(dto.editar, false),
          excluir: boolParaSn(dto.excluir, false),
        },
        select: { id_usuario_permissao: true },
      });
      return { id: criado.id_usuario_permissao.toString() };
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Já existe permissão para este grupo de usuário e formulário.',
        );
      }
      throw e;
    }
  }

  async atualizar(
    id: string,
    dto: AtualizarUsuarioPermissaoDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infotime_usuario_permissoes.findUnique({
      where: { id_usuario_permissao: BigInt(id) },
      include: {
        infotime_grupo_usuario: { select: { id_tenacidade: true } },
      },
    });
    if (
      !existente ||
      existente.infotime_grupo_usuario.id_tenacidade !==
        tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Permissão de usuário ${id} não encontrada.`);
    }

    const idGrupo =
      dto.idGrupoUsuario !== undefined
        ? BigInt(dto.idGrupoUsuario)
        : existente.id_grupo_usuario;
    const idForm =
      dto.idFormulario !== undefined
        ? BigInt(dto.idFormulario)
        : existente.id_formulario;

    if (dto.idGrupoUsuario !== undefined) {
      const g = await this.prisma.infotime_grupo_usuario.findFirst({
        where: {
          id_grupo_usuario: idGrupo,
          id_tenacidade: tenantContexto.idTenacidade,
        },
        select: { id_grupo_usuario: true },
      });
      if (!g) {
        throw new NotFoundException(
          'Grupo de usuário não encontrado neste tenant.',
        );
      }
    }

    if (dto.idFormulario !== undefined) {
      const f = await this.prisma.infotime_formulario.findUnique({
        where: { id_formulario: idForm },
        select: { id_formulario: true },
      });
      if (!f) {
        throw new NotFoundException('Formulário (tela) não encontrado.');
      }
    }

    try {
      await this.prisma.infotime_usuario_permissoes.update({
        where: { id_usuario_permissao: BigInt(id) },
        data: {
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          ...(dto.idGrupoUsuario !== undefined && {
            id_grupo_usuario: idGrupo,
          }),
          ...(dto.idFormulario !== undefined && { id_formulario: idForm }),
          ...(dto.administrador !== undefined && {
            administrador: boolParaSn(dto.administrador, false),
          }),
          ...(dto.incluir !== undefined && {
            incluir: boolParaSn(dto.incluir, false),
          }),
          ...(dto.editar !== undefined && {
            editar: boolParaSn(dto.editar, false),
          }),
          ...(dto.excluir !== undefined && {
            excluir: boolParaSn(dto.excluir, false),
          }),
        },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Já existe permissão para este grupo de usuário e formulário.',
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
    const existente = await this.prisma.infotime_usuario_permissoes.findUnique({
      where: { id_usuario_permissao: BigInt(id) },
      include: {
        infotime_grupo_usuario: { select: { id_tenacidade: true } },
      },
    });
    if (
      !existente ||
      existente.infotime_grupo_usuario.id_tenacidade !==
        tenantContexto.idTenacidade
    ) {
      throw new NotFoundException(`Permissão de usuário ${id} não encontrada.`);
    }
    await this.prisma.infotime_usuario_permissoes.delete({
      where: { id_usuario_permissao: BigInt(id) },
    });
    return { ok: true };
  }

  private mapear(registro: {
    id_usuario_permissao: bigint;
    id_grupo_usuario: bigint;
    id_formulario: bigint;
    administrador: string;
    incluir: string;
    editar: string;
    excluir: string;
    id_usuario_auditoria: bigint | null;
    endereco_ip_auditoria: string | null;
    nome_aplicacao_auditoria: string | null;
    infotime_grupo_usuario: { descricao: string | null };
    infotime_formulario: { codigo: string; descricao: string | null };
  }): RespostaUsuarioPermissaoDto {
    return {
      id: registro.id_usuario_permissao.toString(),
      idGrupoUsuario: registro.id_grupo_usuario.toString(),
      idFormulario: registro.id_formulario.toString(),
      grupoUsuarioDescricao: registro.infotime_grupo_usuario.descricao ?? null,
      formularioCodigo: registro.infotime_formulario.codigo,
      formularioDescricao: registro.infotime_formulario.descricao ?? null,
      administrador: snParaBool(registro.administrador),
      incluir: snParaBool(registro.incluir),
      editar: snParaBool(registro.editar),
      excluir: snParaBool(registro.excluir),
      id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
      endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
      nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
    };
  }
}
