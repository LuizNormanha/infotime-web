import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
  ValidateIf,
} from 'class-validator';

import {
  char1NullableUpper,
  migracaoStringNullable,
  trimStringObrigatorio,
} from '../../comum/dto-transform';

/** DTO de criação (infolab_tipo_integracao). Auditoria no service. */
export class CriarTipoIntegracaoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(100)
  descricao!: string;

  /** BigInt no banco; aceito como string decimal no JSON. */
  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  codigo_migracao?: string | null;

  /** Char(1) no banco (ex.: S/N). */
  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @ValidateIf((_, v) => v !== null && v !== undefined)
  @IsString()
  @MinLength(1)
  @MaxLength(1)
  ativo?: string | null;
}
