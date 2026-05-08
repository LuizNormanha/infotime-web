import { Transform } from 'class-transformer';
import { IsOptional, IsString, MaxLength, MinLength } from 'class-validator';

import {
  char1NullableUpper,
  trimStringObrigatorio,
} from '../../comum/dto-transform';

export class CriarMedicamentoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(80)
  nome!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @MaxLength(1)
  ativo?: string | null;
}
