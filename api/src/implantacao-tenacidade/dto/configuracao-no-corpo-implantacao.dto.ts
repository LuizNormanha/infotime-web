import { PartialType } from '@nestjs/mapped-types';
import { IsOptional, IsString } from 'class-validator';

import { ConfiguracaoCorpoCriarTenacidadeImplantacaoDto } from './configuracao-corpo-criar-tenacidade-implantacao.dto';

/**
 * Trecho parcial de `infolab_tenacidade_configuracao` no PUT de implantação.
 * `id` = `id_tenacidade_configuracao` (quando existir).
 */
export class ConfiguracaoNoCorpoImplantacaoDto extends PartialType(
  ConfiguracaoCorpoCriarTenacidadeImplantacaoDto,
) {
  @IsOptional()
  @IsString()
  id?: string;
}
