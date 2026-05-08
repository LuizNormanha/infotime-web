import { Transform } from 'class-transformer';
import { IsOptional, IsString, Matches, MaxLength } from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

export class AtualizarVetRacaDto {
  @IsOptional()
  @IsString()
  @Matches(/^\d+$/, { message: 'id_vet_especie deve conter apenas dígitos.' })
  id_vet_especie?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  nome?: string;
}
