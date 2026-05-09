import { Transform, Type } from 'class-transformer';
import {
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

import {
  char1NullableUpper,
  trimStringOpcional,
} from '../../comum/dto-transform';

export class CriarClienteDto {
  @IsOptional()
  @IsString()
  @IsIn(['F', 'J', 'f', 'j'])
  @Transform(({ value }: { value: unknown }) =>
    typeof value === 'string' ? value.trim().toUpperCase() : value,
  )
  tipoPessoa?: string;

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

  @IsOptional()
  @IsString()
  @IsIn(['M', 'F', 'I', 'm', 'f', 'i'])
  @Transform(({ value }: { value: unknown }) =>
    typeof value === 'string' ? value.trim().toUpperCase() : value,
  )
  sexo?: string;

  @IsOptional()
  dataNascimento?: string | null;

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

  @IsInt()
  idSituacaoCliente!: number;

  @IsInt()
  idContaCaixa!: number;

  @IsOptional()
  @IsInt()
  idMunicipio?: number | null;

  /** Opcional no formulário legado; enviar undefined ou id para gravar FK. */
  @IsOptional()
  idClienteCanal?: number | string | null;

  @IsOptional()
  idClientePai?: number | string | null;

  @IsOptional()
  idTipoCliente?: number | string | null;

  @IsOptional()
  idConcorrente?: number | string | null;

  @IsOptional()
  idRegiaoEstadual?: number | string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(14)
  cnpj?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(20)
  inscricaoEstadual?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(20)
  inscricaoMunicipal?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  @MaxLength(8)
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
  @MaxLength(255)
  homepage?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }) => char1NullableUpper(value))
  emiteBoleto?: string | null;

  @IsOptional()
  dataExpiracao?: string | null;

  @IsOptional()
  @IsInt()
  qtdLicenca?: number | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }) => char1NullableUpper(value))
  clientePublico?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  observacoes?: string;

  /** Certificado — só leitura no formulário antigo em várias bases; aceito opcional na criação. */
  @IsOptional()
  @IsString()
  @MaxLength(10)
  certificadoRegistro?: string;

  @IsOptional()
  dataEmissaoCr?: string | null;

  @IsOptional()
  dataValidadeCr?: string | null;
}
