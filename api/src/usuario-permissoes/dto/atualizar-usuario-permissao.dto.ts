import { PartialType } from '@nestjs/mapped-types';

import { CriarUsuarioPermissaoDto } from './criar-usuario-permissao.dto';

export class AtualizarUsuarioPermissaoDto extends PartialType(
  CriarUsuarioPermissaoDto,
) {}
