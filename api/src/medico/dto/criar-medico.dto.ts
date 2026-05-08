import { Transform } from 'class-transformer';
import {
  IsBoolean,
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

/** Payload do formulário web (snake_case). Campos ignorados pelo service se vazios. */
export class CriarMedicoDto {
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
  @MaxLength(11)
  cpf?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  sexo?: string;

  @IsOptional()
  @IsString()
  @MaxLength(10)
  codigo_externo?: string;

  @IsOptional()
  @IsString()
  @Matches(/^\d*$/)
  id_especialidade_medica?: string;

  @IsOptional()
  @IsString()
  @Matches(/^\d*$/)
  id_conselho_regional?: string;

  @IsOptional()
  @IsString()
  @Matches(/^\d*$/)
  id_medico_credencial_convenio?: string;

  @IsOptional()
  @IsString()
  @MaxLength(2)
  estado_conselho?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined => {
    if (value === '' || value === null || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? Math.trunc(n) : undefined;
  })
  numero_conselho?: number;

  @IsOptional()
  @IsString()
  @MaxLength(15)
  numero_cns?: string;

  @IsOptional()
  @IsString()
  @MaxLength(13)
  registro_unimed?: string;

  @IsOptional()
  @IsString()
  @MaxLength(30)
  telefone?: string;

  @IsOptional()
  @IsString()
  @MaxLength(30)
  celular?: string;

  @IsOptional()
  @IsString()
  @MaxLength(50)
  email?: string;

  @IsOptional()
  @IsString()
  @MaxLength(64)
  senha_internet?: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  lista_convenio_suspenso?: string;

  @IsOptional()
  @IsBoolean()
  @Transform(({ value }: { value: unknown }): boolean | undefined => {
    if (value === undefined || value === null || value === '') return undefined;
    if (typeof value === 'boolean') return value;
    if (value === 'S' || value === 's' || value === '1' || value === 'true')
      return true;
    if (value === 'N' || value === 'n' || value === '0' || value === 'false')
      return false;
    return undefined;
  })
  ativo?: boolean;
}
