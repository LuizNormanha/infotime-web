import { PartialType } from '@nestjs/mapped-types';

import { CriarTipoRelatorioDto } from './criar-tipo-relatorio.dto';

export class AtualizarTipoRelatorioDto extends PartialType(
  CriarTipoRelatorioDto,
) {}
