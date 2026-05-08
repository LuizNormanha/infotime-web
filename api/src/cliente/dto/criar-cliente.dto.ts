import {
  IsOptional,
  IsString,
  MaxLength,
  IsIn,
  IsEmail,
  IsDateString,
} from 'class-validator';

/**
 * DTO para criação de cliente.
 * Campos excluídos (preenchidos automaticamente pelo service):
 *   - id_tenacidade (vem do JWT via @TenantAtual())
 *   - id_usuario_auditoria (vem do JWT via @UsuarioAtual())
 *   - endereco_ip_auditoria (vem do contexto da requisição)
 *   - nome_aplicacao_auditoria (preenchido pelo service)
 *   - data_inclusao (preenchido pelo service)
 */
export class CriarClienteDto {
  @IsOptional()
  @IsString()
  @MaxLength(100)
  nome?: string;

  @IsOptional()
  @IsString()
  @MaxLength(100)
  nome_social?: string;

  @IsOptional()
  @IsString()
  @MaxLength(11)
  cpf?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  documento?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  codigo_passaporte?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  prontuario?: string;

  @IsOptional()
  @IsString()
  @MaxLength(50)
  codigo_externo?: string;

  @IsOptional()
  @IsString()
  @IsIn(['M', 'F', 'O', ''])
  sexo?: string;

  @IsOptional()
  @IsString()
  @IsIn(['S', 'C', 'D', 'V', 'U', ''])
  estado_civil?: string;

  @IsOptional()
  @IsDateString()
  data_nascimento?: string;

  @IsOptional()
  @IsString()
  peso?: string;

  @IsOptional()
  @IsString()
  altura?: string;

  @IsOptional()
  @IsString()
  @IsIn(['S', 'N'])
  diabetico?: string;

  @IsOptional()
  @IsString()
  @IsIn(['S', 'N'])
  falecido?: string;

  @IsOptional()
  @IsString()
  @IsIn(['S', 'N'])
  receber_mensagem?: string;

  @IsOptional()
  @IsString()
  @IsIn(['S', 'N'])
  bloqueado?: string;

  @IsOptional()
  @IsString()
  @MaxLength(8)
  cep?: string;

  @IsOptional()
  @IsString()
  @MaxLength(100)
  logradouro?: string;

  @IsOptional()
  @IsString()
  @MaxLength(10)
  numero?: string;

  @IsOptional()
  @IsString()
  @MaxLength(50)
  complemento?: string;

  @IsOptional()
  @IsString()
  @MaxLength(50)
  bairro?: string;

  @IsOptional()
  @IsString()
  @MaxLength(50)
  cidade?: string;

  @IsOptional()
  @IsString()
  @MaxLength(2)
  estado?: string;

  @IsOptional()
  @IsString()
  @MaxLength(100)
  endereco_referencia?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  telefone?: string;

  @IsOptional()
  @IsString()
  @MaxLength(20)
  celular?: string;

  @IsOptional()
  @IsEmail()
  @MaxLength(100)
  email?: string;

  @IsOptional()
  @IsString()
  @MaxLength(255)
  senha_internet?: string;

  @IsOptional()
  @IsString()
  observacao_resultado?: string;
}
