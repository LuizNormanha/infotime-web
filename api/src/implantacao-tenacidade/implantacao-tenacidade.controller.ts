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
  UseGuards,
} from '@nestjs/common';
import type { Request } from 'express';

import { GuardImplantacaoJwt } from '../comum/guards/guard-implantacao.jwt';
import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import { UsuarioAtual } from '../comum/decorators/usuario-atual.decorator';
import { AtualizarTenacidadeImplantacaoDto } from './dto/atualizar-tenacidade-implantacao.dto';
import { CriarTenacidadeImplantacaoDto } from './dto/criar-tenacidade-implantacao.dto';
import { ImplantacaoTenacidadeService } from './implantacao-tenacidade.service';

@Controller('implantacao-tenacidades')
@UseGuards(GuardImplantacaoJwt)
export class ImplantacaoTenacidadeController {
  constructor(private readonly service: ImplantacaoTenacidadeService) {}

  @Get()
  listar(
    @Query('cargaInicial') cargaInicial?: string,
    @Query('q') q?: string,
    @Query('campoPesquisa') campoPesquisa?: string,
    @Query('pagina') pagina?: string,
    @Query('tamanhoPagina') tamanhoPagina?: string,
    @Query('filtroRefinado') filtroRefinado?: string,
  ) {
    return this.service.listar({
      cargaInicial,
      q,
      campoPesquisa,
      pagina,
      tamanhoPagina,
      filtroRefinado,
    });
  }

  @Get(':id')
  buscarPorId(@Param('id') id: string) {
    return this.service.buscarPorId(id);
  }

  @Post()
  criar(
    @Body() dto: CriarTenacidadeImplantacaoDto,
    @UsuarioAtual() idUsuario: bigint,
    @TenantAtual() idTenacidadeSessao: bigint,
    @Req() req: Request,
  ) {
    const ip = req.ip ?? req.socket?.remoteAddress ?? '';
    return this.service.criar(dto, idUsuario, ip, idTenacidadeSessao);
  }

  @Put(':id')
  atualizar(
    @Param('id') id: string,
    @Body() dto: AtualizarTenacidadeImplantacaoDto,
    @UsuarioAtual() idUsuario: bigint,
    @TenantAtual() idTenacidadeSessao: bigint,
    @Req() req: Request,
  ) {
    const ip = req.ip ?? req.socket?.remoteAddress ?? '';
    return this.service.atualizar(id, dto, idUsuario, ip, idTenacidadeSessao);
  }

  @Delete(':id')
  excluir(@Param('id') id: string) {
    return this.service.excluir(id);
  }
}
