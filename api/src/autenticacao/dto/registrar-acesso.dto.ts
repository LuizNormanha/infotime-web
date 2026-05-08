import { IsOptional, IsString } from 'class-validator';

export class DtoRegistrarAcesso {
  @IsOptional()
  @IsString()
  numero_chamado?: string;

  @IsOptional()
  @IsString()
  motivo_acesso?: string;
}
