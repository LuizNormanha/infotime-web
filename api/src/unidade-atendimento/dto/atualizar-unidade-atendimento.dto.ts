import { PartialType } from '@nestjs/mapped-types';

import { CriarUnidadeAtendimentoDto } from './criar-unidade-atendimento.dto';

export class AtualizarUnidadeAtendimentoDto extends PartialType(
  CriarUnidadeAtendimentoDto,
) {}
