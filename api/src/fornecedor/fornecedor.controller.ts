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
import { AtualizarFornecedorDto } from './dto/atualizar-fornecedor.dto';
import { CriarFornecedorDto } from './dto/criar-fornecedor.dto';
import { FornecedorService } from './fornecedor.service';

@Controller('fornecedores')
export class FornecedorController {
  constructor(private readonly service: FornecedorService) {}

  /** Lookup de situação (catálogo global), ordenado por descrição. */
  @Get('situacoes-fornecedor')
  listarSituacoes() {
    return this.service.listarSituacoes();
  }

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

  @Post()
  criar(
    @Body() dto: CriarFornecedorDto,
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

  @Get(':id')
  obter(
    @Param('id') id: string,
    @TenantAtual() idTenacidade: bigint,
    @UsuarioAtual() idUsuario: bigint,
  ) {
    const tenantContexto: TenantContexto = {
      idTenacidade,
      idUsuario,
      isSuporte: false,
    };
    return this.service.obterPorId(id, tenantContexto);
  }

  @Put(':id')
  atualizar(
    @Param('id') id: string,
    @Body() dto: AtualizarFornecedorDto,
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
