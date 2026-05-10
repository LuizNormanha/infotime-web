import { Transform } from 'class-transformer';
import { IsOptional, IsString, MaxLength, MinLength } from 'class-validator';

import { trimStringOpcional } from '../../comum/dto-transform';

/** Corpo de criação — validações de negócio adicionais ficam no service. */
export class CriarContasPagarDto {
  @IsString()
  @Transform(({ value }: { value: unknown }) =>
    typeof value === 'string' ? value.trim() : String(value ?? '').trim(),
  )
  @MinLength(1)
  idTipoAgente!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idCliente?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idFornecedor?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idColaborador?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idEmpresa?: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  valorPrevisao!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  valorPrevisaoLiquido?: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  dataPrevisao!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  idSituacaoDocumento!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value) ?? '')
  @MinLength(1)
  idPlanoConta!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idContaCaixa?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  valorRealizacao?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  dataRealizacao?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idTipoEspecie?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  idCheque?: string;

  @IsOptional()
  @IsString()
  @MaxLength(100)
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  numeroDocumento?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  dataAgendamento?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  dataCompetencia?: string;

  @IsOptional()
  @IsString()
  @MaxLength(50)
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  contaContabil?: string;

  @IsOptional()
  @IsString()
  @MaxLength(100)
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  historico?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  valorAcrescimo?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  valorDesconto?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  valorMulta?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  valorJuros?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }) => trimStringOpcional(value))
  dataBaixa?: string;

  @IsOptional()
  @IsString()
  observacoes?: string;
}
