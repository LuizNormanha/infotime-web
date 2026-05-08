import {
  Body,
  Controller,
  Delete,
  Get,
  Param,
  Post,
  Put,
  Query,
  Req,
} from '@nestjs/common';
import type { Request } from 'express';

import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import { UsuarioAtual } from '../comum/decorators/usuario-atual.decorator';
import { TenantContexto } from '../comum/interfaces/tenant-contexto.interface';
import { AtualizarTipoEstadoCivilDto } from './dto/atualizar-tipo-estado-civil.dto';
import { CriarTipoEstadoCivilDto } from './dto/criar-tipo-estado-civil.dto';
import { TipoEstadoCivilService } from './tipo-estado-civil.service';

@Controller('tipos-estado-civil')
export class TipoEstadoCivilController {
  constructor(private readonly service: TipoEstadoCivilService) {}

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
    @Body() dto: CriarTipoEstadoCivilDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Req() req: Request,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    const ip = req.ip ?? req.socket?.remoteAddress ?? '';
    return this.service.criar(dto, tenantContexto, ip);
  }

  @Put(':id')
  atualizar(
    @Param('id') id: string,
    @Body() dto: AtualizarTipoEstadoCivilDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Req() req: Request,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    const ip = req.ip ?? req.socket?.remoteAddress ?? '';
    return this.service.atualizar(id, dto, tenantContexto, ip);
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
