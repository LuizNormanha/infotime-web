import { Transform, Type } from 'class-transformer';
import {
  IsArray,
  IsOptional,
  IsString,
  MaxLength,
  MinLength,
  ValidateNested,
} from 'class-validator';

import { trimStringObrigatorio } from '../../comum/dto-transform';
import { PermissaoDetalheGrupoDto } from './permissao-detalhe-grupo.dto';

export class CriarGrupoPerfilDto {
  @IsString()
  @Transform(({ value }: { value: unknown }): string =>
    trimStringObrigatorio(value),
  )
  @MinLength(1)
  @MaxLength(200)
  descricao!: string;

  /** Opcional: incluído no mesmo `POST` em transação com o mestre. */
  @IsOptional()
  @IsArray()
  @ValidateNested({ each: true })
  @Type(() => PermissaoDetalheGrupoDto)
  permissoes?: PermissaoDetalheGrupoDto[];

  /** Estrutura de menu por grupo (mesmo formato de /layout/menu). */
  @IsOptional()
  menu?: unknown;

  /** Opcional: clonar de outro grupo/perfil no mesmo tenant. */
  @IsOptional()
  @IsString()
  @Transform(({ value }: { value: unknown }): string | undefined => {
    if (value === undefined || value === null) return undefined;
    const s = String(value).trim();
    return s === '' ? undefined : s;
  })
  idGrupoOrigemClone?: string;
}
