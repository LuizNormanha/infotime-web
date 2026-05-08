import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  Matches,
  MaxLength,
  MinLength,
  ValidateIf,
} from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

/** DTO de criação de especialidade médica (infolab_especialidade_medica). Auditoria preenchida pelo service. */
export class CriarEspecialidadeMedicaDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(100)
  descricao!: string;

  @IsOptional()
  @IsString()
  @MaxLength(2)
  codigo_ipsemg?: string;

  @IsOptional()
  @IsString()
  @MaxLength(30)
  codigo_externo?: string;

  @IsOptional()
  @IsString()
  @MaxLength(6)
  codigo_migracao?: string;

  /** Aceita string numérica ou vazio; vazio/null → null no banco. */
  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined => {
    if (value === undefined) return undefined;
    if (value === null || value === '') return null;
    if (typeof value === 'string') {
      const s = value.trim();
      return s === '' ? null : s;
    }
    if (
      typeof value === 'number' ||
      typeof value === 'boolean' ||
      typeof value === 'bigint'
    ) {
      const s = String(value).trim();
      return s === '' ? null : s;
    }
    return null;
  })
  @ValidateIf((o: CriarEspecialidadeMedicaDto) => {
    const v = o.id_cbo;
    return v !== null && v !== undefined;
  })
  @IsString()
  @Matches(/^\d+$/, { message: 'id_cbo deve conter apenas dígitos.' })
  id_cbo?: string | null;
}
