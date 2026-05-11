import { Controller, Get } from '@nestjs/common';

import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import type { CockpitResponseDto } from './dto/cockpit-response.dto';
import type { FinanceiroAgingResponseDto } from './dto/financeiro-aging-response.dto';
import type { FinanceiroDreResponseDto } from './dto/financeiro-dre-response.dto';
import type { ReguaCobrancaListaResponseDto } from './dto/regua-cobranca-lista-response.dto';
import { FinanceiroService } from './financeiro.service';

@Controller('financeiro')
export class FinanceiroController {
  constructor(private readonly financeiroService: FinanceiroService) {}

  /** Agregados do cockpit (tenant exclusivamente do JWT). */
  @Get('cockpit')
  cockpit(@TenantAtual() idTenacidade: bigint): Promise<CockpitResponseDto> {
    return this.financeiroService.getCockpitData(idTenacidade);
  }

  @Get('aging')
  aging(
    @TenantAtual() idTenacidade: bigint,
  ): Promise<FinanceiroAgingResponseDto> {
    return this.financeiroService.getAgingResumo(idTenacidade);
  }

  @Get('dre')
  dre(@TenantAtual() idTenacidade: bigint): Promise<FinanceiroDreResponseDto> {
    return this.financeiroService.getDreSintetico(idTenacidade);
  }

  @Get('regua/cobranca')
  reguaCobranca(
    @TenantAtual() idTenacidade: bigint,
  ): Promise<ReguaCobrancaListaResponseDto> {
    return this.financeiroService.listReguaCobranca(idTenacidade);
  }
}
