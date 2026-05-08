import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  Matches,
  MaxLength,
  MinLength,
} from 'class-validator';

import {
  trimStringObrigatorio,
  trimStringOpcional,
} from '../../comum/dto-transform';

/** DTO de criação de etnia (infolab_etnia). Sem colunas de auditoria na tabela. */
export class CriarEtniaDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(100)
  nome!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @Matches(/^\d+$/, { message: 'id_raca deve conter apenas dígitos.' })
  id_raca?: string;
}
