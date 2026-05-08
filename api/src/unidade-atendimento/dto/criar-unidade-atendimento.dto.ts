import { Transform } from 'class-transformer';
import {
  IsInt,
  IsNumber,
  IsOptional,
  IsString,
  Max,
  MaxLength,
  Min,
  MinLength,
} from 'class-validator';

import {
  char1NullableUpper,
  floatOpcional,
  intOpcional,
  intObrigatorio,
  migracaoStringNullable,
  trimStringObrigatorio,
  trimStringOpcional,
} from '../../comum/dto-transform';

/** Campos editáveis de `infolab_unidade` (cadastro web). */
export class CriarUnidadeAtendimentoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(100)
  nomeFantasia!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  razaoSocial?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(17)
  cnpj?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(15)
  inscricaoMunicipal?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    intOpcional(value),
  )
  @IsInt()
  naturezaOperacao?: number;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    intOpcional(value),
  )
  @IsInt()
  regimeTributacao?: number;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @IsString()
  @MaxLength(30)
  serieNotaFiscal?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @MaxLength(30)
  idAlmoxarifadoPadrao?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @MaxLength(30)
  idMunicipioNotaFiscal?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(7)
  cnes?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(10)
  sigla?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(1)
  tipoUnidade?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(10)
  cep?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(50)
  tipoLogradouro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  logradouro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  bairro?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(50)
  numero?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(50)
  complemento?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  cidade?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(2)
  estado?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    floatOpcional(value),
  )
  @IsNumber()
  latitude?: number;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    floatOpcional(value),
  )
  @IsNumber()
  longitude?: number;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(30)
  telefone?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(30)
  celular?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @IsString()
  @MaxLength(30)
  amostraExternaInicio?: string | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @IsString()
  @MaxLength(30)
  amostraExternaFim?: string | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    migracaoStringNullable(value),
  )
  @IsString()
  @MaxLength(30)
  amostraExternaAtual?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(64)
  senhaInternet?: string;

  @Transform(({ value }: { value: unknown }): number => intObrigatorio(value))
  @IsInt()
  @Min(1)
  @Max(5)
  regraAgrupamentoAmostra!: number;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(255)
  nomeArquivoLogotipo?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(255)
  nomeReferenciaLogotipo?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  enviarAmostra?: string | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  enviarSms?: string | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  procedenciaAtendimentoObrigatorio?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(4000)
  descricaoServicoNotaFiscal?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  pertencerSimplesNacional?: string | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): number | undefined =>
    intOpcional(value),
  )
  @IsInt()
  qtdDiasValidadeOrcamento?: number;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  alterarLaboratorioApoio?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(600)
  listaProcedenciaPermitida?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(600)
  listaConvenioPermitido?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  indicacaoOrcamento?: string | null;

  @IsOptional()
  @Transform(({ value }: { value: unknown }): string | null | undefined =>
    char1NullableUpper(value),
  )
  @IsString()
  @MaxLength(1)
  ativo?: string | null;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(30)
  codigoExterno?: string;
}
