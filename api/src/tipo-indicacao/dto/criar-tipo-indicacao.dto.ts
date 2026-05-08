import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
  ValidateIf,
} from 'class-validator';

/**
 * DTO de criação de tipo de indicação (infolab_tipo_indicacao).
 * Campo JSON `descricao` mapeia para a coluna `descicao` no Prisma/banco.
 */
export class CriarTipoIndicacaoDto {
  @IsOptional()
  @Transform(({ value }) => {
    if (value === null) return null;
    if (value === undefined) return undefined;
    const s = typeof value === 'string' ? value.trim() : String(value);
    return s === '' ? null : s;
  })
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MaxLength(30)
  codigo?: string | null;

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

  /** Char(1) no banco (ex.: S/N). */
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
  ativo?: string | null;
}
