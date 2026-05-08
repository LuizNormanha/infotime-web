import { Transform } from 'class-transformer';
import { IsInt, IsOptional, IsString, MaxLength, MinLength } from 'class-validator';

import {
  char1NullableUpper,
  trimStringObrigatorio,
  trimStringOpcional,
} from '../../comum/dto-transform';

export class CriarSetorDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(200)
  descricao!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @MaxLength(1)
  ativo?: string | null;

  @IsOptional()
  @IsInt()
  codigoMigracao?: number | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(30)
  codigoExterno?: string;
}
