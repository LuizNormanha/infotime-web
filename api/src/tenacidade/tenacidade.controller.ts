import { Controller, Get, Query } from '@nestjs/common';

import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import { TenacidadeService } from './tenacidade.service';

/** Rotas REST para laboratórios (`tenacidade` / model `infolab_tenacidade`; prefixo plural `tenacidades`). */
@Controller('tenacidades')
export class TenacidadeController {
  constructor(private readonly service: TenacidadeService) {}

  @Get('catalogo-lookup')
  catalogoLookup(@TenantAtual() idTenacidade: bigint, @Query('q') q?: string) {
    return this.service.catalogoLookup(idTenacidade, q);
  }
}
