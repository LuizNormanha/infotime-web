import { Transform } from 'class-transformer';
import {
  IsInt,
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
} from 'class-validator';

import { intOpcional, trimStringObrigatorio } from '../../comum/dto-transform';

/** DTO de criação de CBO (infolab_cbo). Auditoria preenchida pelo service. */
export class CriarCboDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(255)
  descricao!: string;

  @IsOptional()
  @IsString()
  @MaxLength(30)
  codigo_externo?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    intOpcional(value),
  )
  @IsInt()
  codigo_cbo?: number;
}
