import { Transform } from 'class-transformer';
import {
  IsDateString,
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
} from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

/** DTO de criação de feriado (infolab_feriado). Tenant e auditoria vêm do JWT / request. */
export class CriarFeriadoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(200)
  descricao!: string;

  @IsOptional()
  @IsDateString()
  @Transform(({ value }: { value: unknown }): string | undefined => {
    if (value === '' || value === null || value === undefined) return undefined;
    return typeof value === 'string' ? value : undefined;
  })
  data_feriado?: string;
}
