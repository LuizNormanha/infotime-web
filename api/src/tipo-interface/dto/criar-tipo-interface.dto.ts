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
  trimStringObrigatorio,
} from '../../comum/dto-transform';

/** DTO de criação (infolab_tipo_interface). Auditoria no service. */
export class CriarTipoInterfaceDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(100)
  descricao!: string;

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
