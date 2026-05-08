import { Transform } from 'class-transformer';
import { IsOptional, IsString, MaxLength } from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

export class AtualizarVetEspecieDto {
  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(80)
  nome?: string;
}
