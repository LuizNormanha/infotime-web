import { PartialType } from '@nestjs/mapped-types';
import { CriarTipoAplicacaoDto } from './criar-tipo-aplicacao.dto';

export class AtualizarTipoAplicacaoDto extends PartialType(
  CriarTipoAplicacaoDto,
) {}
