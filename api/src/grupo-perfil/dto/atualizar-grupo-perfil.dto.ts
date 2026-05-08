import { PartialType } from '@nestjs/mapped-types';
import { Type } from 'class-transformer';
import { IsArray, IsOptional, ValidateNested } from 'class-validator';

import { CriarGrupoPerfilDto } from './criar-grupo-perfil.dto';
import { PermissaoDetalheGrupoDto } from './permissao-detalhe-grupo.dto';

export class AtualizarGrupoPerfilDto extends PartialType(CriarGrupoPerfilDto) {
  /** Quando enviado, substitui o conjunto de permissões do grupo (transação com o mestre). */
  @IsOptional()
  @IsArray()
  @ValidateNested({ each: true })
  @Type(() => PermissaoDetalheGrupoDto)
  declare permissoes?: PermissaoDetalheGrupoDto[];

  @IsOptional()
  declare menu?: unknown;
}
