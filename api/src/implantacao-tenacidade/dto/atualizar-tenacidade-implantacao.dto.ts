import { Transform, Type } from 'class-transformer';
import { IsOptional, IsString, MaxLength, ValidateNested } from 'class-validator';

import { ConfiguracaoNoCorpoImplantacaoDto } from './configuracao-no-corpo-implantacao.dto';

function optStr(v: unknown): string | undefined {
  if (v === '' || v === null || v === undefined) return undefined;
  return typeof v === 'string' ? v.trim() || undefined : undefined;
}

/** Atualização parcial: só `infolab_tenacidade.ativo` no pai; demais campos em `configuracao`. */
export class AtualizarTenacidadeImplantacaoDto {
  @IsOptional()
  @IsString()
  @MaxLength(1)
  @Transform(({ value }: { value: unknown }) => optStr(value))
  ativo?: string;

  @IsOptional()
  @ValidateNested()
  @Type(() => ConfiguracaoNoCorpoImplantacaoDto)
  configuracao?: ConfiguracaoNoCorpoImplantacaoDto;
}
