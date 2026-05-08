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
import { ClienteService } from './cliente.service';
import { CriarClienteDto } from './dto/criar-cliente.dto';
import { AtualizarClienteDto } from './dto/atualizar-cliente.dto';

@Controller('clientes')
export class ClienteController {
  // [SEGURANÇA] Todos os endpoints usam @TenantAtual() e @UsuarioAtual().
  // O id_tenacidade NUNCA é lido do body — vem exclusivamente do JWT.

  constructor(private readonly service: ClienteService) {}

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
    /** JSON dos filtros refinados (whitelist no service). */
    @Query('filtroRefinado') filtroRefinado?: string,
  ) {
    // [SEGURANÇA] Tenant extraído do JWT pelo decorator @TenantAtual().
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
    // [SEGURANÇA] Tenant extraído do JWT pelo decorator @TenantAtual().
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.buscarPorId(id, tenantContexto);
  }

  @Post()
  criar(
    @Body() dto: CriarClienteDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Req() req: Request,
  ) {
    // [SEGURANÇA] Tenant extraído do JWT pelo decorator @TenantAtual().
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
    @Body() dto: AtualizarClienteDto,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
    @Req() req: Request,
  ) {
    // [SEGURANÇA] Tenant extraído do JWT pelo decorator @TenantAtual().
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
    // [SEGURANÇA] Tenant extraído do JWT pelo decorator @TenantAtual().
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.excluir(id, tenantContexto);
  }
}
