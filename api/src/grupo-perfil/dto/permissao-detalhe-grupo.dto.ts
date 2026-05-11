import { Transform } from 'class-transformer';
import {
  IsBoolean,
  IsOptional,
  IsString,
  Matches,
  MaxLength,
} from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';

/** Linha de permissão enviada junto ao mestre (grupo de usuário) — persistida na mesma transação. */
export class PermissaoDetalheGrupoDto {
  /** `id_usuario_permissao` quando já existente; omitido na inclusão de nova linha. */
  @IsOptional()
  @IsString()
  @Matches(/^\d+$/)
  @MaxLength(24)
  id?: string;

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
