import { Transform, Type } from 'class-transformer';
import { IsOptional, IsString, MaxLength, ValidateNested } from 'class-validator';

import { ConfiguracaoCorpoCriarTenacidadeImplantacaoDto } from './configuracao-corpo-criar-tenacidade-implantacao.dto';

function optStr(v: unknown): string | undefined {
  if (v === '' || v === null || v === undefined) return undefined;
  return typeof v === 'string' ? v.trim() || undefined : undefined;
}

/**
 * Criação mestre/detalhe: `infolab_tenacidade` + `infolab_tenacidade_configuracao`.
 * O pai só recebe `ativo`; identidade, domínio, licença e flags operacionais vão em `configuracao`.
 */
export class CriarTenacidadeImplantacaoDto {
  @IsOptional()
  @IsString()
  @MaxLength(1)
  @Transform(({ value }: { value: unknown }) => optStr(value))
  ativo?: string;

  @ValidateNested()
  @Type(() => ConfiguracaoCorpoCriarTenacidadeImplantacaoDto)
  configuracao!: ConfiguracaoCorpoCriarTenacidadeImplantacaoDto;
}
