import { PartialType } from '@nestjs/mapped-types';

import { CriarTenacidadeConfiguracaoDto } from './criar-tenacidade-configuracao.dto';

export class AtualizarTenacidadeConfiguracaoDto extends PartialType(
  CriarTenacidadeConfiguracaoDto,
) {}
