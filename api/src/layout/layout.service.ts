import {
  BadRequestException,
  Injectable,
  NotFoundException,
} from '@nestjs/common';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { LayoutFormularioCadastroDto } from './dto/layout-formulario-cadastro.dto';
import { validarMenuJson } from './layout-menu-validacao';
import {
  parsearLayoutDeConfiguracao,
  parsearMenuDeConfiguracao,
  serializarConfiguracaoLayout,
  serializarConfiguracaoMenu,
} from './layout-config-json';
import { PrismaService } from '../prisma/prisma.service';

@Injectable()
export class LayoutService {
  constructor(private readonly prisma: PrismaService) {}

  /** Lista entradas do catálogo (seed) — útil para telas de configuração. */
  listarCatalogoFormularios() {
    return this.prisma.infotime_formulario.findMany({
      where: { ativo: true },
      orderBy: { ordem: 'asc' },
      select: {
        id_formulario: true,
        codigo: true,
        descricao: true,
        ordem: true,
      },
    });
  }

  /** Grupos de usuário (perfil) do tenant — para cadastro de layout. */
  listarGruposPerfilTenant(idTenacidade: bigint) {
    return this.prisma.infotime_grupo_usuario.findMany({
      where: { id_tenacidade: idTenacidade },
      orderBy: { id_grupo_usuario: 'asc' },
      select: {
        id_grupo_usuario: true,
        descricao: true,
      },
    });
  }

  /** Layouts já gravados (por perfil + formulário). */
  async listarPersonalizacoesLayout(idTenacidade: bigint) {
    const rows = await this.prisma.infotime_layout_formulario.findMany({
      where: {
        infotime_grupo_usuario: { id_tenacidade: idTenacidade },
      },
      select: {
        id_layout_formulario: true,
        id_grupo_usuario: true,
        infotime_grupo_usuario: { select: { descricao: true } },
        infotime_formulario: {
          select: { codigo: true, descricao: true, ordem: true },
        },
      },
    });
    return [...rows].sort((a, b) => {
      const g = Number(a.id_grupo_usuario - b.id_grupo_usuario);
      if (g !== 0) return g;
      return (
        (a.infotime_formulario.ordem ?? 0) - (b.infotime_formulario.ordem ?? 0)
      );
    });
  }

  private async idFormularioPorCodigo(codigo: string): Promise<bigint | null> {
    const row = await this.prisma.infotime_formulario.findUnique({
      where: { codigo },
      select: { id_formulario: true },
    });
    return row?.id_formulario ?? null;
  }

  /**
   * Usuário do JWT no contexto do tenant.
   * Inclui `id_tenacidade: null` (técnico global suporte/implantação) além da linha do tenant.
   */
  private async buscarGrupoDoUsuarioLogado(
    ctx: TenantContexto,
  ): Promise<bigint | null> {
    const u = await this.prisma.infotime_usuario.findFirst({
      where: {
        id_usuario: ctx.idUsuario,
        OR: [{ id_tenacidade: ctx.idTenacidade }, { id_tenacidade: null }],
      },
      select: { id_grupo_usuario: true },
    });
    return u?.id_grupo_usuario ?? null;
  }

  /**
   * Resolve o id_grupo_usuario para leitura de layout/menu.
   * Sem grupo (ex.: técnico sem perfil) → `null` → o front usa layout/menu padrão.
   */
  private async resolverIdGrupoParaLeitura(
    ctx: TenantContexto,
    idGrupoSolicitado?: bigint | null,
  ): Promise<bigint | null> {
    if (idGrupoSolicitado != null) {
      const g = await this.prisma.infotime_grupo_usuario.findFirst({
        where: {
          id_grupo_usuario: idGrupoSolicitado,
          id_tenacidade: ctx.idTenacidade,
        },
        select: { id_grupo_usuario: true },
      });
      if (!g) {
        throw new NotFoundException(
          'Perfil de usuário (grupo) não encontrado neste tenant.',
        );
      }
      return g.id_grupo_usuario;
    }
    return this.buscarGrupoDoUsuarioLogado(ctx);
  }

  /**
   * Gravação exige perfil (ou `idGrupoUsuario` explícito nas preferências).
   */
  private async resolverIdGrupoParaEscrita(
    ctx: TenantContexto,
    idGrupoSolicitado?: bigint | null,
  ): Promise<bigint> {
    const id = await this.resolverIdGrupoParaLeitura(ctx, idGrupoSolicitado);
    if (id == null) {
      throw new BadRequestException(
        'Usuário sem perfil (grupo) associado; não é possível gravar layout sem grupo ou sem escolher um perfil nas preferências.',
      );
    }
    return id;
  }

  async resolverFormularioCadastro(
    tela: string,
    tenantContexto: TenantContexto,
    idGrupoUsuarioOpcional?: bigint | null,
  ): Promise<LayoutFormularioCadastroDto> {
    const idFormulario = await this.idFormularioPorCodigo(tela);
    if (!idFormulario) {
      return { secoes: [] };
    }

    const idGrupo = await this.resolverIdGrupoParaLeitura(
      tenantContexto,
      idGrupoUsuarioOpcional,
    );
    if (idGrupo == null) {
      return { secoes: [] };
    }

    const row = await this.prisma.infotime_layout_formulario.findUnique({
      where: {
        id_grupo_usuario_id_formulario: {
          id_grupo_usuario: idGrupo,
          id_formulario: idFormulario,
        },
      },
    });

    if (!row) {
      return { secoes: [] };
    }

    return parsearLayoutDeConfiguracao(row.configuracao_json);
  }

  async salvarFormularioCadastro(
    tela: string,
    layoutDto: LayoutFormularioCadastroDto,
    tenantContexto: TenantContexto,
    idGrupoUsuarioOpcional?: bigint | null,
  ): Promise<void> {
    const idFormulario = await this.idFormularioPorCodigo(tela);
    if (!idFormulario) {
      throw new NotFoundException(
        `Formulário/tela desconhecida no catálogo: ${tela}`,
      );
    }

    const json = serializarConfiguracaoLayout(layoutDto);
    const idGrupo = await this.resolverIdGrupoParaEscrita(
      tenantContexto,
      idGrupoUsuarioOpcional,
    );

    await this.prisma.infotime_layout_formulario.upsert({
      where: {
        id_grupo_usuario_id_formulario: {
          id_grupo_usuario: idGrupo,
          id_formulario: idFormulario,
        },
      },
      create: {
        id_formulario: idFormulario,
        id_grupo_usuario: idGrupo,
        configuracao_json: json,
      },
      update: {
        configuracao_json: json,
      },
    });
  }

  async resolverMenu(
    tenantContexto: TenantContexto,
    idGrupoUsuarioOpcional?: bigint | null,
  ): Promise<unknown> {
    const idFormulario = await this.idFormularioPorCodigo('menu');
    if (!idFormulario) return null;

    const idGrupo = await this.resolverIdGrupoParaLeitura(
      tenantContexto,
      idGrupoUsuarioOpcional,
    );
    if (idGrupo == null) {
      return null;
    }

    const row = await this.prisma.infotime_layout_formulario.findUnique({
      where: {
        id_grupo_usuario_id_formulario: {
          id_grupo_usuario: idGrupo,
          id_formulario: idFormulario,
        },
      },
    });
    if (!row) return null;
    return parsearMenuDeConfiguracao(row.configuracao_json);
  }

  async salvarMenu(
    menu: unknown,
    tenantContexto: TenantContexto,
    idGrupoUsuarioOpcional?: bigint | null,
  ): Promise<void> {
    validarMenuJson(menu);
    const idFormulario = await this.idFormularioPorCodigo('menu');
    if (!idFormulario) {
      throw new NotFoundException(
        'Catálogo não contém o formulário "menu". Rode o seed/migração.',
      );
    }
    const json = serializarConfiguracaoMenu(menu);
    const idGrupo = await this.resolverIdGrupoParaEscrita(
      tenantContexto,
      idGrupoUsuarioOpcional,
    );

    await this.prisma.infotime_layout_formulario.upsert({
      where: {
        id_grupo_usuario_id_formulario: {
          id_grupo_usuario: idGrupo,
          id_formulario: idFormulario,
        },
      },
      create: {
        id_formulario: idFormulario,
        id_grupo_usuario: idGrupo,
        configuracao_json: json,
      },
      update: {
        configuracao_json: json,
      },
    });
  }
}
