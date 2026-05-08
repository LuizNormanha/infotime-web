import { PartialType } from '@nestjs/mapped-types';
import { CriarMotivoRetificacaoDto } from './criar-motivo-retificacao.dto';

export class AtualizarMotivoRetificacaoDto extends PartialType(
  CriarMotivoRetificacaoDto,
) {}
