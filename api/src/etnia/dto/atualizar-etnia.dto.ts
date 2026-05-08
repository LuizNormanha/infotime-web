import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  Matches,
  MaxLength,
  MinLength,
  ValidateIf,
} from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

/** Atualização parcial; `id_raca: null` limpa o vínculo. */
export class AtualizarEtniaDto {
  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @ValidateIf((_, v) => v !== undefined && v !== null)
  @MinLength(1)
  @MaxLength(100)
  nome?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined => {
    if (value === undefined) return undefined;
    if (value === null) return null;
    if (value === '') return null;
    const s = trimStringOpcional(value);
    return s === undefined || s === '' ? null : s;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @Matches(/^\d+$/, { message: 'id_raca deve conter apenas dígitos.' })
  id_raca?: string | null;
}
