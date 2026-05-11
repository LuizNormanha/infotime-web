import { Transform, Type } from 'class-transformer';
import {
  IsEmail,
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

export class CriarColaboradorDto {
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  @MaxLength(255)
  nome!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(50)
  apelido?: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => String(value ?? '').trim())
  @MinLength(1)
  idTipoColaborador!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => String(value ?? '').trim())
  @MinLength(1)
  idSituacaoColaborador!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(100)
  login?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  senha?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  sexo?: string;

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
  idEmpresa?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  implanta?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  liderImplantacao?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  consultorImplantacao?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(11)
  cpf?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  carteiraIdentidade?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  carteiraTrabalho?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  numeroPis?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idCargoClassificacaoNivel?: string;

  @IsOptional()
  @IsString()
  dataAdmissao?: string;

  @IsOptional()
  @IsString()
  dataDemissao?: string;

  @IsOptional()
  @IsString()
  dataEstagio?: string;

  @IsOptional()
  @IsString()
  dataNascimento?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  regimeTrabalho?: string;

  @IsOptional()
  @IsString()
  horaTrabalhoEntrada?: string;

  @IsOptional()
  @IsString()
  horaTrabalhoSaida?: string;

  @IsOptional()
  @IsString()
  horaAlmocoInicio?: string;

  @IsOptional()
  @IsString()
  horaAlmocoFim?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  trabalhaSabado?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 1),
  )
  trabalhaDomingo?: string;

  @IsOptional()
  @ValidateIf((_o, v) => v !== null && v !== undefined && v !== '')
  @Type(() => Number)
  @IsNumber({ maxDecimalPlaces: 2 })
  salario?: number | null;

  @IsOptional()
  @ValidateIf((_o, v) => v !== null && v !== undefined && v !== '')
  @Type(() => Number)
  @IsNumber({ maxDecimalPlaces: 2 })
  comissao?: number | null;

  @IsOptional()
  @ValidateIf((_o, v) => v !== null && v !== undefined && v !== '')
  @Type(() => Number)
  @IsNumber({ maxDecimalPlaces: 2 })
  insalubridade?: number | null;

  @IsOptional()
  @ValidateIf((_o, v) => v !== null && v !== undefined && v !== '')
  @Type(() => Number)
  @IsNumber({ maxDecimalPlaces: 2 })
  valeAlimentacao?: number | null;

  @IsOptional()
  @ValidateIf((_o, v) => v !== null && v !== undefined && v !== '')
  @Type(() => Number)
  @IsNumber({ maxDecimalPlaces: 2 })
  valeTransporte?: number | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idBanco?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idAgencia?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(20)
  numeroConta?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  cep?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  tipoLogradouro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  logradouro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  numero?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  complemento?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  bairro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  cidade?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    (trimStringOpcional(value) ?? '').toUpperCase().slice(0, 2),
  )
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
  telefone?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  celular?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(50)
  pix?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  observacoes?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idTipoEstadoCivil?: string;
}
