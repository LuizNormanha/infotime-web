import { Transform } from 'class-transformer';
import { IsOptional, IsString, Matches, MaxLength } from 'class-validator';

import {
  trimStringObrigatorio,
  trimStringOpcional,
} from '../../comum/dto-transform';

/** PK sem autoincrement no schema — id obrigatório na inclusão. */
export class CriarVetEspecieDto {
  @IsString()
  @Matches(/^\d+$/, { message: 'id deve conter apenas dígitos.' })
  id!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(80)
  nome?: string;
}
