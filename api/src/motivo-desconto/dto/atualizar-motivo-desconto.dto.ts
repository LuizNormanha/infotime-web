import { PartialType } from '@nestjs/mapped-types';
import { CriarMotivoDescontoDto } from './criar-motivo-desconto.dto';

export class AtualizarMotivoDescontoDto extends PartialType(
  CriarMotivoDescontoDto,
) {}
