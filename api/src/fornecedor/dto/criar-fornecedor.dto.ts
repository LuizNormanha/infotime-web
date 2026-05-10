import { Transform, Type } from 'class-transformer';
import {
  IsBoolean,
  IsEmail,
  IsIn,
  IsInt,
  IsNumber,
  IsOptional,
  IsString,
  Max,
  MaxLength,
  Min,
  MinLength,
  ValidateIf,
} from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

export class CriarFornecedorDto {
  @IsOptional()
  @IsString()
  @IsIn(['F', 'J', 'f', 'j'])
  @Transform(({ value }: { value: unknown }) =>
    typeof value === 'string' ? value.trim().toUpperCase() : value,
  )
  tipoPessoa?: string;

  @IsOptional()
  @IsBoolean()
  @Transform(({ value }: { value: unknown }) => {
    if (value === true || value === 'true' || value === 1 || value === '1')
      return true;
    if (value === false || value === 'false' || value === 0 || value === '0')
      return false;
    return Boolean(value);
  })
  fabricante?: boolean;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  @MaxLength(255)
  razaoSocial!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  @MaxLength(255)
  nomeFantasia!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  @MaxLength(14)
  cnpj!: string;

  @IsInt()
  @Type(() => Number)
  idSituacaoFornecedor!: number;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(50)
  telefone?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(50)
  celular?: string;

  @IsOptional()
  @IsEmail()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  email?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(255)
  contatos?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(255)
  homepage?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(10)
  cep?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  tipoLogradouro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  logradouro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  numero?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  complemento?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  bairro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  cidade?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 2),
  )
  @MaxLength(2)
  estado?: string;

  @IsOptional()
  @ValidateIf((_obj, v) => v !== null && v !== undefined)
  @Type(() => Number)
  @IsNumber({ allowNaN: false, maxDecimalPlaces: 16 })
  @Min(-90)
  @Max(90)
  latitude?: number | null;

  @IsOptional()
  @ValidateIf((_obj, v) => v !== null && v !== undefined)
  @Type(() => Number)
  @IsNumber({ allowNaN: false, maxDecimalPlaces: 16 })
  @Min(-180)
  @Max(180)
  longitude?: number | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  observacoes?: string;
}
