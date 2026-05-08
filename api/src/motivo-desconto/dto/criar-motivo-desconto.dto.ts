import { Transform } from 'class-transformer';
import {
  IsInt,
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
} from 'class-validator';

import {
  intOpcional,
  trimStringObrigatorio,
  trimStringOpcional,
} from '../../comum/dto-transform';

/** DTO de criação de motivo de desconto (infolab_motivo_desconto). Tenant e auditoria no service. */
export class CriarMotivoDescontoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(200)
  descricao!: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    intOpcional(value),
  )
  @IsInt()
  codigo_migracao?: number;

  /** Valor lógico BigInt no banco; aceito como string decimal no JSON. */
  @IsOptional()
  @IsString()
  @MaxLength(30)
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  codigo_externo?: string;
}
