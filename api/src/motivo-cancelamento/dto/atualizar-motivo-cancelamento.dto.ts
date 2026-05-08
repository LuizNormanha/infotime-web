import { PartialType } from '@nestjs/mapped-types';
import { CriarMotivoCancelamentoDto } from './criar-motivo-cancelamento.dto';

export class AtualizarMotivoCancelamentoDto extends PartialType(
  CriarMotivoCancelamentoDto,
) {}
