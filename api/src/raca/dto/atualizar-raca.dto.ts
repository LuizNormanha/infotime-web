import { Transform } from 'class-transformer';
import { IsOptional, IsString, MaxLength, MinLength } from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

/** Atualização parcial (infolab_raca). */
export class AtualizarRacaDto {
  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MinLength(1)
  @MaxLength(80)
  nome?: string;
}
