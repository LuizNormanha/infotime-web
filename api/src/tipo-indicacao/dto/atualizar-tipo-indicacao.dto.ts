import { PartialType } from '@nestjs/mapped-types';
import { CriarTipoIndicacaoDto } from './criar-tipo-indicacao.dto';

export class AtualizarTipoIndicacaoDto extends PartialType(
  CriarTipoIndicacaoDto,
) {}
