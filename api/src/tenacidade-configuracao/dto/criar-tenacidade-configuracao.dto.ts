import { Transform } from 'class-transformer';
import {
  IsInt,
  IsOptional,
  IsString,
  MaxLength,
} from 'class-validator';

/** Criação de `infolab_tenacidade_configuracao` no tenant da sessão (sem `id_tenacidade` no corpo). */
export class CriarTenacidadeConfiguracaoDto {
  @IsOptional()
  @IsString()
  @MaxLength(1)
  infolab_vet?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  somente_interfaceamento?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  utilizar_numeracao_origem_liberacao?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  utilizar_deltacheck_liberacao?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  liberar_resultado_interfaceado_baixado?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  capturar_versao_exame_apoio?: string;

  @IsOptional()
  @IsString()
  @MaxLength(150)
  diretorio_exportacao_resultado?: string;

  @IsOptional()
  @IsString()
  @MaxLength(150)
  diretorio_triagem_amostra?: string;

  @IsOptional()
  @IsString()
  @MaxLength(200)
  mensagem_exame_repetido?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1)
  liberar_resultado_informado?: string;

  @IsOptional()
  @IsString()
  @MaxLength(1000)
  lista_setor_libera_informado?: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  endpoint_pedido?: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  endpoint_chatbot?: string;

  @IsOptional()
  @Transform(({ value }: { value: unknown }) => {
    if (value === '' || value === null || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? n : undefined;
  })
  @IsInt()
  timeout_sessao_minutos?: number;

  @IsOptional()
  @Transform(({ value }: { value: unknown }) => {
    if (value === '' || value === null || value === undefined) return undefined;
    const n = Number(value);
    return Number.isFinite(n) ? n : undefined;
  })
  @IsInt()
  quantidade_licenca?: number;
}
