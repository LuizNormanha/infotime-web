import { Body, Controller, Post } from '@nestjs/common';

import { TenantAtual } from '../comum/decorators/tenant-atual.decorator';
import { GeracaoIaService } from './geracao-ia.service';
import { GerarIaDto } from './dto/gerar-ia.dto';

/**
 * Endpoints de IA (OpenAI chat). Autenticados: tenant do JWT não entra no prompt,
 * apenas garante que só usuários logados chamem o pipeline.
 */
@Controller('ai')
export class AiController {
  constructor(private readonly geracaoIa: GeracaoIaService) {}

  /** Rules.md do domínio (disco) → prompt estruturado → modelo → JSON de sugestões. */
  @Post('generate')
  async gerar(
    @Body() dto: GerarIaDto,
    @TenantAtual() _idTenacidade: bigint,
  ) {
    void _idTenacidade;
    return this.geracaoIa.gerar(dto);
  }
}
