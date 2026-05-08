import { Transform } from 'class-transformer';
import {
  IsOptional,
  IsString,
  Matches,
  MaxLength,
  MinLength,
} from 'class-validator';

import {
  trimStringOpcional,
  trimStringObrigatorio,
} from '../../comum/dto-transform';
import {
  MENSAGEM_SENHA_USUARIO_POLITICA_FORTE,
  SENHA_USUARIO_COMPRIMENTO_MINIMO,
  SENHA_USUARIO_REGEX_FORTE,
} from '../../comum/senha-usuario-politica';

export class TrocarSenhaUsuarioDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(SENHA_USUARIO_COMPRIMENTO_MINIMO)
  @MaxLength(100)
  @Matches(SENHA_USUARIO_REGEX_FORTE, {
    message: MENSAGEM_SENHA_USUARIO_POLITICA_FORTE,
  })
  novaSenha!: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(100)
  senhaAtual?: string;

  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined =>
    trimStringOpcional(value),
  )
  @MaxLength(20)
  senhaDia?: string;
}
