import { IsEmail, IsOptional, IsString, MinLength } from 'class-validator';

export class DtoLoginUsuario {
  @IsEmail()
  email: string;

  @IsString()
  @MinLength(1)
  senha: string;

  @IsOptional()
  @IsString()
  captcha_id?: string;

  @IsOptional()
  @IsString()
  captcha_resposta?: string;
}
