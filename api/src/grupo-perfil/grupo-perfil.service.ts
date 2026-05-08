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
import { AtualizarGrupoPerfilDto } from './dto/atualizar-grupo-perfil.dto';
import { CriarGrupoPerfilDto } from './dto/criar-grupo-perfil.dto';
import { PermissaoDetalheGrupoDto } from './dto/permissao-detalhe-grupo.dto';
import { RespostaGrupoPerfilDto } from './dto/resposta-grupo-perfil.dto';
import { RespostaListagemGrupoPerfilDto } from './dto/resposta-listagem-grupo-perfil.dto';
import { RespostaListagemUsuarioPermissaoDto } from '../usuario-permissoes/dto/resposta-usuario-permissao.dto';
import { validarMenuJson } from '../layout/layout-menu-validacao';
import {
  parsearMenuDeConfiguracao,
  serializarConfiguracaoMenu,
} from '../layout/layout-config-json';

const IP_MAX = 20;
const APP = 'infotime-web';
const FORM_CODIGO_MENU = 'menu';

function snParaBool(v: string | null | undefined): boolean {
  return v === 'S' || v === 's';
}

function boolParaSn(v: boolean | undefined, padrao: boolean): string {
  return (v ?? padrao) ? 'S' : 'N';
}

@Injectable()
export class GrupoPerfilService {
  private static readonly CAMPOS_PESQUISA = new Set(['descricao', 'id']);

  constructor(private readonly prisma: PrismaService) {}

  private whereCampoPesquisaGrupoPerfil(
    campoPesquisa: string,
    qTexto: string,
  ): Prisma.infolab_grupo_usuarioWhereInput {
    if (campoPesquisa === 'descricao') {
      return {
        descricao: { contains: qTexto, mode: 'insensitive' },
      };
    }
    if (campoPesquisa === 'id') {
      try {
        return { id_grupo_usuario: BigInt(qTexto.trim()) };
      } catch {
        return {};
      }
    }
    return {};
  }

  private whereFiltroRefinadoGrupoPerfil(
    jsonBruto: string | undefined,
  ): Prisma.infolab_grupo_usuarioWhereInput {
    const root = parseJsonFiltroRefinado(jsonBruto);
    const permitidos = new Set(['descricao']);
    const partes: Prisma.infolab_grupo_usuarioWhereInput[] = [];

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

  private fatiarIp(ip: string): string {
    return ip.slice(0, IP_MAX);
  }

  private async idFormularioMenu(
    tx: Prisma.TransactionClient | PrismaService,
  ): Promise<bigint | null> {
    const f = await tx.infolab_formulario.findUnique({
      where: { codigo: FORM_CODIGO_MENU },
      select: { id_formulario: true },
    });
    return f?.id_formulario ?? null;
  }

  private async lerMenuDoGrupo(
    tx: Prisma.TransactionClient | PrismaService,
    idGrupo: bigint,
  ): Promise<unknown> {
    const idFormMenu = await this.idFormularioMenu(tx);
    if (!idFormMenu) return null;
    const row = await tx.infolab_layout_formulario.findUnique({
      where: {
        id_grupo_usuario_id_formulario: {
          id_grupo_usuario: idGrupo,
          id_formulario: idFormMenu,
        },
      },
      select: { configuracao_json: true },
    });
    if (!row) return null;
    return parsearMenuDeConfiguracao(row.configuracao_json);
  }

  private async salvarMenuDoGrupo(
    tx: Prisma.TransactionClient,
    idGrupo: bigint,
    menu: unknown,
  ): Promise<void> {
    validarMenuJson(menu);
    const idFormMenu = await this.idFormularioMenu(tx);
    if (!idFormMenu) {
      throw new NotFoundException('Formulário "menu" não encontrado no catálogo.');
    }
    const json = serializarConfiguracaoMenu(menu);
    await tx.infolab_layout_formulario.upsert({
      where: {
        id_grupo_usuario_id_formulario: {
          id_grupo_usuario: idGrupo,
          id_formulario: idFormMenu,
        },
      },
      create: {
        id_grupo_usuario: idGrupo,
        id_formulario: idFormMenu,
        configuracao_json: json,
      },
      update: {
        configuracao_json: json,
      },
    });
  }

  private async clonarDeGrupoOrigem(
    tx: Prisma.TransactionClient,
    idGrupoOrigem: bigint,
    idGrupoDestino: bigint,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<void> {
    const origem = await tx.infolab_grupo_usuario.findFirst({
      where: {
        id_grupo_usuario: idGrupoOrigem,
        id_tenacidade: tenantContexto.idTenacidade,
      },
      select: { id_grupo_usuario: true },
    });
    if (!origem) {
      throw new NotFoundException('Grupo de origem para clone não encontrado.');
    }

    const regras = await tx.infolab_usuario_permissoes.findMany({
      where: { id_grupo_usuario: idGrupoOrigem },
    });
    for (const r of regras) {
      await tx.infolab_usuario_permissoes.create({
        data: {
          id_grupo_usuario: idGrupoDestino,
          id_formulario: r.id_formulario,
          id_usuario_auditoria: tenantContexto.idUsuario,
          endereco_ip_auditoria: this.fatiarIp(ip),
          nome_aplicacao_auditoria: APP,
          administrador: r.administrador,
          incluir: r.incluir,
          editar: r.editar,
          excluir: r.excluir,
        },
      });
    }

    const menuOrigem = await this.lerMenuDoGrupo(tx, idGrupoOrigem);
    if (menuOrigem != null) {
      await this.salvarMenuDoGrupo(tx, idGrupoDestino, menuOrigem);
    }
  }

  async listar(
    tenantContexto: TenantContexto,
    todos?: boolean,
    query?: QueryListagemCrudPadrao,
  ): Promise<{ dados: RespostaListagemGrupoPerfilDto[]; total: number }> {
    const baseWhere: Prisma.infolab_grupo_usuarioWhereInput = {
      id_tenacidade: tenantContexto.idTenacidade,
    };

    const select = {
      id_grupo_usuario: true,
      descricao: true,
    };

    return executarListagemCrudCatalogo({
      query,
      todos,
      takeLegadoSemTodos: 50,
      delegate: this.prisma.infolab_grupo_usuario,
      baseWhere,
      camposPesquisaWhitelist: GrupoPerfilService.CAMPOS_PESQUISA,
      montarWhereCampoPesquisa: (campo, q) =>
        this.whereCampoPesquisaGrupoPerfil(campo, q),
      montarWhereFiltroRefinado: (j) => this.whereFiltroRefinadoGrupoPerfil(j),
      orderBy: { id_grupo_usuario: 'desc' },
      skipTakeSelect: { skip: 0, take: 10, select },
      mapRow: (row: unknown) => {
        const r = row as { id_grupo_usuario: bigint; descricao: string | null };
        return {
          id: r.id_grupo_usuario.toString(),
          descricao: r.descricao ?? null,
        };
      },
      findManyLegado: ({ where, orderBy, select: sel, take }) =>
        this.prisma.infolab_grupo_usuario.findMany({
          where: where as Prisma.infolab_grupo_usuarioWhereInput,
          orderBy,
          select: sel as typeof select,
          ...(take != null ? { take } : {}),
        }),
    });
  }

  async buscarPorId(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ dados: RespostaGrupoPerfilDto }> {
    const registro = await this.prisma.infolab_grupo_usuario.findUnique({
      where: { id_grupo_usuario: BigInt(id) },
      include: {
        infolab_tenacidade: {
          select: {
            id_tenacidade: true,
            infolab_tenacidade_configuracao: {
              orderBy: { id_tenacidade_configuracao: 'asc' },
              take: 5,
              select: {
                nome_fantasia: true,
                razao_social: true,
                dominio_tenacidade: true,
              },
            },
          },
        },
      },
    });
    if (!registro || registro.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Grupo de usuário ${id} não encontrado.`);
    }
    const permissoes = await this.prisma.infolab_usuario_permissoes.findMany({
      where: { id_grupo_usuario: BigInt(id) },
      orderBy: { id_usuario_permissao: 'desc' },
      include: {
        infolab_grupo_usuario: { select: { descricao: true } },
        infolab_formulario: { select: { codigo: true, descricao: true } },
      },
    });
    const dadosPerm: RespostaListagemUsuarioPermissaoDto[] = permissoes.map(
      (r) => ({
        id: r.id_usuario_permissao.toString(),
        idGrupoUsuario: r.id_grupo_usuario.toString(),
        idFormulario: r.id_formulario.toString(),
        grupoUsuarioDescricao: r.infolab_grupo_usuario.descricao ?? null,
        formularioCodigo: r.infolab_formulario.codigo,
        formularioDescricao: r.infolab_formulario.descricao ?? null,
        administrador: snParaBool(r.administrador),
        incluir: snParaBool(r.incluir),
        editar: snParaBool(r.editar),
        excluir: snParaBool(r.excluir),
      }),
    );
    const ten = registro.infolab_tenacidade;
    const cfgs = ten?.infolab_tenacidade_configuracao ?? [];
    const cfg =
      cfgs.find((c) => (c.dominio_tenacidade ?? "").trim()) ?? cfgs[0];
    const nomeTen =
      (cfg?.nome_fantasia ?? "").trim() ||
      (cfg?.razao_social ?? "").trim() ||
      null;

    return {
      dados: {
        id: registro.id_grupo_usuario.toString(),
        descricao: registro.descricao ?? null,
        idTenacidade: registro.id_tenacidade.toString(),
        tenacidadeNomeExibicao: nomeTen,
        id_usuario_auditoria: registro.id_usuario_auditoria?.toString() ?? null,
        endereco_ip_auditoria: registro.endereco_ip_auditoria ?? null,
        nome_aplicacao_auditoria: registro.nome_aplicacao_auditoria ?? null,
        permissoes: dadosPerm,
        menu: await this.lerMenuDoGrupo(this.prisma, BigInt(id)),
      },
    };
  }

  async criar(
    dto: CriarGrupoPerfilDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    try {
      const id = await this.prisma.$transaction(async (tx) => {
        const criado = await tx.infolab_grupo_usuario.create({
          data: {
            id_tenacidade: tenantContexto.idTenacidade,
            id_usuario_auditoria: tenantContexto.idUsuario,
            endereco_ip_auditoria: this.fatiarIp(ip),
            nome_aplicacao_auditoria: APP,
            descricao: dto.descricao,
          },
          select: { id_grupo_usuario: true },
        });
        const idGrupo = criado.id_grupo_usuario;
        if (dto.idGrupoOrigemClone) {
          await this.clonarDeGrupoOrigem(
            tx,
            BigInt(dto.idGrupoOrigemClone),
            idGrupo,
            tenantContexto,
            ip,
          );
        }
        if (dto.permissoes?.length) {
          for (const p of dto.permissoes) {
            await this.validarFormulario(tx, p.idFormulario);
            await tx.infolab_usuario_permissoes.create({
              data: {
                id_grupo_usuario: idGrupo,
                id_formulario: BigInt(p.idFormulario),
                id_usuario_auditoria: tenantContexto.idUsuario,
                endereco_ip_auditoria: this.fatiarIp(ip),
                nome_aplicacao_auditoria: APP,
                administrador: boolParaSn(p.administrador, false),
                incluir: boolParaSn(p.incluir, false),
                editar: boolParaSn(p.editar, false),
                excluir: boolParaSn(p.excluir, false),
              },
            });
          }
        }
        if (dto.menu !== undefined) {
          await this.salvarMenuDoGrupo(tx, idGrupo, dto.menu);
        }
        return idGrupo;
      });
      return { id: id.toString() };
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Conflito ao gravar permissão (duplicidade grupo/formulário).',
        );
      }
      throw e;
    }
  }

  async atualizar(
    id: string,
    dto: AtualizarGrupoPerfilDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    const existente = await this.prisma.infolab_grupo_usuario.findUnique({
      where: { id_grupo_usuario: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Grupo de usuário ${id} não encontrado.`);
    }

    try {
      await this.prisma.$transaction(async (tx) => {
        await tx.infolab_grupo_usuario.update({
          where: { id_grupo_usuario: BigInt(id) },
          data: {
            id_usuario_auditoria: tenantContexto.idUsuario,
            endereco_ip_auditoria: this.fatiarIp(ip),
            nome_aplicacao_auditoria: APP,
            ...(dto.descricao !== undefined && { descricao: dto.descricao }),
          },
        });

        if (dto.permissoes !== undefined) {
          await this.sincronizarPermissoes(
            tx,
            BigInt(id),
            dto.permissoes,
            tenantContexto,
            ip,
          );
        }
        if (dto.menu !== undefined) {
          await this.salvarMenuDoGrupo(tx, BigInt(id), dto.menu);
        }
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2002'
      ) {
        throw new ConflictException(
          'Conflito ao gravar permissão (duplicidade grupo/formulário).',
        );
      }
      throw e;
    }
    return { id };
  }

  private async validarFormulario(
    tx: Prisma.TransactionClient,
    idFormulario: string,
  ): Promise<void> {
    const f = await tx.infolab_formulario.findUnique({
      where: { id_formulario: BigInt(idFormulario) },
      select: { id_formulario: true },
    });
    if (!f) {
      throw new NotFoundException('Formulário (tela) não encontrado.');
    }
  }

  private async sincronizarPermissoes(
    tx: Prisma.TransactionClient,
    idGrupoUsuario: bigint,
    linhas: PermissaoDetalheGrupoDto[],
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<void> {
    const existentes = await tx.infolab_usuario_permissoes.findMany({
      where: { id_grupo_usuario: idGrupoUsuario },
      select: { id_usuario_permissao: true },
    });
    const idsMantidos = new Set(
      linhas
        .filter((l) => l.id != null && l.id !== '')
        .map((l) => BigInt(l.id!)),
    );
    for (const e of existentes) {
      if (!idsMantidos.has(e.id_usuario_permissao)) {
        await tx.infolab_usuario_permissoes.delete({
          where: { id_usuario_permissao: e.id_usuario_permissao },
        });
      }
    }
    for (const p of linhas) {
      await this.validarFormulario(tx, p.idFormulario);
      if (p.id != null && p.id !== '') {
        const atual = await tx.infolab_usuario_permissoes.findFirst({
          where: {
            id_usuario_permissao: BigInt(p.id),
            id_grupo_usuario: idGrupoUsuario,
          },
          include: {
            infolab_grupo_usuario: { select: { id_tenacidade: true } },
          },
        });
        if (
          !atual ||
          atual.infolab_grupo_usuario.id_tenacidade !==
            tenantContexto.idTenacidade
        ) {
          throw new NotFoundException(
            `Permissão ${p.id} não encontrada para este grupo.`,
          );
        }
        await tx.infolab_usuario_permissoes.update({
          where: { id_usuario_permissao: BigInt(p.id) },
          data: {
            id_usuario_auditoria: tenantContexto.idUsuario,
            endereco_ip_auditoria: this.fatiarIp(ip),
            nome_aplicacao_auditoria: APP,
            id_formulario: BigInt(p.idFormulario),
            administrador: boolParaSn(p.administrador, false),
            incluir: boolParaSn(p.incluir, false),
            editar: boolParaSn(p.editar, false),
            excluir: boolParaSn(p.excluir, false),
          },
        });
      } else {
        await tx.infolab_usuario_permissoes.create({
          data: {
            id_grupo_usuario: idGrupoUsuario,
            id_formulario: BigInt(p.idFormulario),
            id_usuario_auditoria: tenantContexto.idUsuario,
            endereco_ip_auditoria: this.fatiarIp(ip),
            nome_aplicacao_auditoria: APP,
            administrador: boolParaSn(p.administrador, false),
            incluir: boolParaSn(p.incluir, false),
            editar: boolParaSn(p.editar, false),
            excluir: boolParaSn(p.excluir, false),
          },
        });
      }
    }
  }

  async excluir(
    id: string,
    tenantContexto: TenantContexto,
  ): Promise<{ ok: boolean }> {
    const existente = await this.prisma.infolab_grupo_usuario.findUnique({
      where: { id_grupo_usuario: BigInt(id) },
      select: { id_tenacidade: true },
    });
    if (!existente || existente.id_tenacidade !== tenantContexto.idTenacidade) {
      throw new NotFoundException(`Grupo de usuário ${id} não encontrado.`);
    }
    try {
      await this.prisma.infolab_grupo_usuario.delete({
        where: { id_grupo_usuario: BigInt(id) },
      });
    } catch (e: unknown) {
      if (
        e instanceof Prisma.PrismaClientKnownRequestError &&
        e.code === 'P2003'
      ) {
        throw new ConflictException(
          'Não é possível excluir: existem registros vinculados a este grupo de usuário.',
        );
      }
      throw e;
    }
    return { ok: true };
  }

  async clonar(
    idOrigem: string,
    dto: CriarGrupoPerfilDto,
    tenantContexto: TenantContexto,
    ip: string,
  ): Promise<{ id: string }> {
    return this.criar(
      {
        ...dto,
        idGrupoOrigemClone: idOrigem,
      },
      tenantContexto,
      ip,
    );
  }
}
