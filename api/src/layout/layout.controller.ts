import { Body, Controller, Get, Param, Put, Query } from '@nestjs/common';
import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import { UsuarioAtual } from '../comum/decorators/usuario-atual.decorator';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { SalvarMenuDto } from './dto/salvar-menu.dto';
import { LayoutService } from './layout.service';
import { SalvarLayoutDto } from './dto/salvar-layout.dto';

function parseIdGrupoUsuarioQuery(q?: string): bigint | undefined {
  if (q == null || q === '') return undefined;
  try {
    return BigInt(q);
  } catch {
    return undefined;
  }
}

@Controller('layout')
export class LayoutController {
  constructor(private readonly service: LayoutService) {}

  /** Catálogo de telas/menu (`infolab_formulario`). */
  @Get('catalogo/formularios')
  catalogoFormularios() {
    return this.service.listarCatalogoFormularios();
  }

  /** Perfis (grupos) do tenant — Preferências > Layout formulário. */
  @Get('catalogo/grupos-perfil')
  gruposPerfil(@TenantAtual() idTenacidade: bigint) {
    return this.service.listarGruposPerfilTenant(idTenacidade);
  }

  /** Layouts gravados por perfil + formulário. */
  @Get('catalogo/personalizacoes')
  personalizacoes(@TenantAtual() idTenacidade: bigint) {
    return this.service.listarPersonalizacoesLayout(idTenacidade);
  }

  /**
   * Menu lateral por perfil (grupo). Query opcional `idGrupoUsuario` para preferências;
   * sem query, usa o grupo do usuário logado.
   */
  @Get('menu')
  menuGet(
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Query('idGrupoUsuario') idGrupoQ?: string,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.resolverMenu(
      tenantContexto,
      parseIdGrupoUsuarioQuery(idGrupoQ),
    );
  }

  @Put('menu')
  menuPut(
    @Body() dto: SalvarMenuDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Query('idGrupoUsuario') idGrupoQ?: string,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.salvarMenu(
      dto.menu,
      tenantContexto,
      parseIdGrupoUsuarioQuery(idGrupoQ),
    );
  }

  // [SEGURANÇA] id_tenacidade e id_usuario vêm exclusivamente do JWT — nunca do body.
  @Get(':tela/formulario-cadastro')
  formularioCadastro(
    @Param('tela') tela: string,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Query('idGrupoUsuario') idGrupoQ?: string,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.resolverFormularioCadastro(
      tela,
      tenantContexto,
      parseIdGrupoUsuarioQuery(idGrupoQ),
    );
  }

  @Put(':tela/formulario-cadastro')
  salvarFormularioCadastro(
    @Param('tela') tela: string,
    @Body() dto: SalvarLayoutDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Query('idGrupoUsuario') idGrupoQ?: string,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.salvarFormularioCadastro(
      tela,
      dto.layout,
      tenantContexto,
      parseIdGrupoUsuarioQuery(idGrupoQ),
    );
  }
}
