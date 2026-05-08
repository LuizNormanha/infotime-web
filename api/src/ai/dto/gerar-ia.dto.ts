import { IsIn, IsOptional, IsString, MinLength } from 'class-validator';

/** Entrada de POST /ai/generate — sem dados de tenant no body (tenant só no JWT). */
export class GerarIaDto {
  @IsString()
  @MinLength(3, { message: 'A solicitação deve ter ao menos 3 caracteres.' })
  solicitacao!: string;

  /** Nome da pasta em `ai/domains/<dominio>/` (ex.: `padroes-ui`, `login`, `usuario`, `tenacidade`). */
  @IsOptional()
  @IsString()
  dominio?: string;

  @IsOptional()
  @IsIn(['completo', 'backend', 'frontend'])
  modo?: 'completo' | 'backend' | 'frontend';
}
