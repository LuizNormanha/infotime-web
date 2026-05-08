import { Transform } from 'class-transformer';
import { IsString, MaxLength, MinLength } from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

/** DTO de criação (infolab_motivo_cancelamento). Tenant e auditoria no service. */
export class CriarMotivoCancelamentoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(200)
  descricao!: string;
}
