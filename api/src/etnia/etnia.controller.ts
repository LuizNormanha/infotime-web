import {
  Body,
  Controller,
  Delete,
  Get,
  Param,
  Post,
  Put,
  Query,
} from '@nestjs/common';

import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import { UsuarioAtual } from '../comum/decorators/usuario-atual.decorator';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { EtniaService } from './etnia.service';
import { AtualizarEtniaDto } from './dto/atualizar-etnia.dto';
import { CriarEtniaDto } from './dto/criar-etnia.dto';

@Controller('etnias')
export class EtniaController {
  constructor(private readonly service: EtniaService) {}

  @Get()
  listar(
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Query('todos') todos?: string,
    @Query('cargaInicial') cargaInicial?: string,
    @Query('q') q?: string,
    @Query('campoPesquisa') campoPesquisa?: string,
    @Query('pagina') pagina?: string,
    @Query('tamanhoPagina') tamanhoPagina?: string,
    @Query('filtroRefinado') filtroRefinado?: string,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.listar(tenantContexto, todos === '1', {
      cargaInicial,
      q,
      campoPesquisa,
      pagina,
      tamanhoPagina,
      filtroRefinado,
    });
  }

  @Get(':id')
  buscarPorId(
    @Param('id') id: string,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.buscarPorId(id, tenantContexto);
  }

  @Post()
  criar(
    @Body() dto: CriarEtniaDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.criar(dto, tenantContexto);
  }

  @Put(':id')
  atualizar(
    @Param('id') id: string,
    @Body() dto: AtualizarEtniaDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.atualizar(id, dto, tenantContexto);
  }

  @Delete(':id')
  excluir(
    @Param('id') id: string,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.excluir(id, tenantContexto);
  }
}
