import { PartialType } from '@nestjs/mapped-types';

import { CriarSerieNotaFiscalServicoDto } from './criar-serie-nota-fiscal-servico.dto';

export class AtualizarSerieNotaFiscalServicoDto extends PartialType(
  CriarSerieNotaFiscalServicoDto,
) {}
