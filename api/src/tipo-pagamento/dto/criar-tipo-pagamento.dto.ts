import { Transform } from 'class-transformer';
import {
  IsInt,
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
  ValidateIf,
} from 'class-validator';

/** DTO de criação de tipo de pagamento (infolab_tipo_pagamento). Tenant e auditoria no service. */
export class CriarTipoPagamentoDto {
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
  codigo_tipo_pagamento?: string | null;

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

  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === '' || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? Math.trunc(n) : undefined;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsInt()
  limite_parcelas?: number | null;

  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === undefined) return undefined;
    const s = typeof value === 'string' ? value.trim() : String(value);
    return s === '' ? null : s;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MaxLength(20)
  bandeira?: string | null;

  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === undefined) return undefined;
    const s = typeof value === 'string' ? value.trim() : String(value);
    if (s === '') return null;
    return s.slice(0, 1).toUpperCase();
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MinLength(1)
  @MaxLength(1)
  documento_obrigatorio?: string | null;

  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === '' || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? Math.trunc(n) : undefined;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsInt()
  codigo_migracao?: number | null;

  /** Valor lógico BigInt no banco; aceito como string decimal no JSON. */
  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === undefined) return undefined;
    if (typeof value === 'string')
      return value.trim() === '' ? null : value.trim();
    return String(value);
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MaxLength(30)
  codigo_externo?: string | null;
}
