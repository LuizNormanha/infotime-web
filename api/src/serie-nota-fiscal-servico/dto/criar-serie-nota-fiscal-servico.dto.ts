import { Transform } from 'class-transformer';
import {
  IsInt,
  IsNotEmpty,
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
} from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

/** DTO de criação — tenant e auditoria vêm do JWT. */
export class CriarSerieNotaFiscalServicoDto {
  @IsString()
  @IsNotEmpty()
  idUnidade!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(10)
  sigla!: string;

  /** Numeração atual (inteiro não negativo). */
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @IsNotEmpty()
  numeracao!: string;

  @IsOptional()
  @IsInt()
  tipoNotaFiscal?: number;

  /** `S` ou `N` quando informado. */
  @IsOptional()
  @IsString()
  @MaxLength(1)
  ativo?: string;

  @IsOptional()
  @IsInt()
  ambiente?: number;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  lote?: string;

  @IsOptional()
  @IsString()
  @MaxLength(80)
  fraseSecreta?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  senhaWeb?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  usuarioWeb?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  cerSenha?: string;
}
