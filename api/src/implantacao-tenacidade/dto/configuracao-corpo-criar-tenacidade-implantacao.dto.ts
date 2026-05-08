import { IntersectionType, OmitType } from '@nestjs/mapped-types';
import { Transform } from 'class-transformer';
import {
  IsDateString,
  IsInt,
  IsOptional,
  IsString,
  MaxLength,
  Min,
} from 'class-validator';

import { CriarTenacidadeConfiguracaoDto } from '../../tenacidade-configuracao/dto/criar-tenacidade-configuracao.dto';

function optStr(v: unknown): string | undefined {
  if (v === '' || v === null || v === undefined) return undefined;
  return typeof v === 'string' ? v.trim() || undefined : undefined;
}

/** Campos de licença / identidade em `infolab_tenacidade_configuracao` (implantação). */
export class LicencaIdentidadeTenacidadeImplantacaoDto {
  @IsString()
  @MaxLength(255)
  @Transform(({ value }: { value: unknown }) => optStr(value))
  dominio_tenacidade!: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  @Transform(({ value }: { value: unknown }) => optStr(value))
  razao_social?: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  @Transform(({ value }: { value: unknown }) => optStr(value))
  nome_fantasia?: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  @Transform(({ value }: { value: unknown }) => optStr(value))
  chave_acesso?: string;

  @IsDateString()
  data_expiracao!: string;

  @Transform(({ value }: { value: unknown }) => {
    if (value === '' || value === null || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? n : undefined;
  })
  @IsInt()
  @Min(1)
  quantidade_licenca!: number;
}

class CriarTenacidadeConfiguracaoSemQuantidadeDto extends OmitType(
  CriarTenacidadeConfiguracaoDto,
  ['quantidade_licenca'] as const,
) {}

/**
 * Corpo completo de `infolab_tenacidade_configuracao` na criação pela implantação
 * (flags operacionais + licença/domínio).
 */
export class ConfiguracaoCorpoCriarTenacidadeImplantacaoDto extends IntersectionType(
  LicencaIdentidadeTenacidadeImplantacaoDto,
  CriarTenacidadeConfiguracaoSemQuantidadeDto,
) {}
