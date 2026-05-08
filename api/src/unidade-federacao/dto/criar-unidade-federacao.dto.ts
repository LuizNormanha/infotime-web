import { Transform } from 'class-transformer';
import {
  IsInt,
  IsOptional,
  IsString,
  MaxLength,
  ValidateIf,
} from 'class-validator';

/** DTO de criação (infolab_unidade_federacao). Auditoria preenchida pelo service. */
export class CriarUnidadeFederacaoDto {
  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === '' || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? Math.trunc(n) : undefined;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsInt()
  codigo?: number | null;

  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === undefined) return undefined;
    const s = typeof value === 'string' ? value.trim() : String(value);
    return s === '' ? null : s;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MaxLength(2)
  sigla?: string | null;

  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === undefined) return undefined;
    const s = typeof value === 'string' ? value.trim() : String(value);
    return s === '' ? null : s;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MaxLength(100)
  descricao?: string | null;
}
