import { Controller, Get } from '@nestjs/common';

import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import type { CockpitResponseDto } from './dto/cockpit-response.dto';
import { FinanceiroService } from './financeiro.service';

@Controller('financeiro')
export class FinanceiroController {
  constructor(private readonly financeiroService: FinanceiroService) {}

  /** Agregados do cockpit (tenant exclusivamente do JWT). */
  @Get('cockpit')
  cockpit(@TenantAtual() idTenacidade: bigint): Promise<CockpitResponseDto> {
    return this.financeiroService.getCockpitData(idTenacidade);
  }
}
