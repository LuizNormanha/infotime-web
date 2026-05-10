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
import { AtualizarContasPagarDto } from './dto/atualizar-contas-pagar.dto';
import { CriarContasPagarDto } from './dto/criar-contas-pagar.dto';
import { ContasPagarService } from './contas-pagar.service';

@Controller('contas-pagar')
export class ContasPagarController {
  constructor(private readonly service: ContasPagarService) {}

  /** Catálogos e listas para o formulário (combos). */
  @Get('lookups')
  lookups(@TenantAtual() idTenacidade: bigint) {
    return this.service.carregarLookups(idTenacidade);
  }

  /** Busca de colaborador do tenant (antes de `:id` do lançamento). */
  @Get('colaboradores')
  listarColaboradoresLookup(
    @TenantAtual() idTenacidade: bigint,
    @Query('q') q?: string,
    @Query('pagina') pagina?: string,
    @Query('tamanhoPagina') tamanhoPagina?: string,
  ) {
    return this.service.listarColaboradoresLookup(idTenacidade, {
      q,
      pagina,
      tamanhoPagina,
    });
  }

  @Get('colaboradores/:id')
  obterColaboradorLookup(
    @TenantAtual() idTenacidade: bigint,
    @Param('id') id: string,
  ) {
    return this.service.obterColaboradorLookup(idTenacidade, id);
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
    @Query('venceHoje') venceHoje?: string,
    @Query('atrasado') atrasado?: string,
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
      venceHoje,
      atrasado,
    });
  }

  @Post()
  criar(
    @Body() dto: CriarContasPagarDto,
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
    @Body() dto: AtualizarContasPagarDto,
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
