import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  Matches,
  MaxLength,
} from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

export class CriarVetRacaDto {
  @IsString()
  @Matches(/^\d+$/, { message: 'id deve conter apenas dígitos.' })
  id!: string;

  @IsOptional()
  @IsString()
  @Matches(/^\d+$/, { message: 'id_vet_especie deve conter apenas dígitos.' })
  id_vet_especie?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  nome?: string;
}
