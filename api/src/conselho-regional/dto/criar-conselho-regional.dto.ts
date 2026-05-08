import { Transform } from 'class-transformer';
import { IsOptional, IsString, MaxLength, MinLength } from 'class-validator';

import {
  trimStringObrigatorio,
  trimStringOpcional,
} from '../../comum/dto-transform';

/** DTO de criação (infolab_conselho_regional). Auditoria preenchida pelo service. */
export class CriarConselhoRegionalDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(200)
  descricao!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(20)
  sigla?: string;
}
