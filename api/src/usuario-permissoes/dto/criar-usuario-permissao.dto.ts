import { Transform } from 'class-transformer';
import {
  IsBoolean,
  IsOptional,
  IsString,
  Matches,
  MaxLength,
} from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

export class CriarUsuarioPermissaoDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @Matches(/^\d+$/, { message: 'idGrupoUsuario deve ser numérico' })
  @MaxLength(24)
  idGrupoUsuario!: string;

  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @Matches(/^\d+$/, { message: 'idFormulario deve ser numérico' })
  @MaxLength(24)
  idFormulario!: string;

  @IsOptional()
  @IsBoolean()
  administrador?: boolean;

  @IsOptional()
  @IsBoolean()
  incluir?: boolean;

  @IsOptional()
  @IsBoolean()
  editar?: boolean;

  @IsOptional()
  @IsBoolean()
  excluir?: boolean;
}
