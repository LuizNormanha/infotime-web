import { PartialType } from '@nestjs/mapped-types';

import { CriarTipoPagamentoDto } from './criar-tipo-pagamento.dto';

export class AtualizarTipoPagamentoDto extends PartialType(
  CriarTipoPagamentoDto,
) {}
