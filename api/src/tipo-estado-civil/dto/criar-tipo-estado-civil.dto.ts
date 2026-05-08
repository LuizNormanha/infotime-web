import { Transform } from 'class-transformer';
import { IsString, MaxLength, MinLength } from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

/** DTO de criação (infolab_tipo_estado_civil). */
export class CriarTipoEstadoCivilDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(100)
  descricao!: string;
}
