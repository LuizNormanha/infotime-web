import { PartialType } from '@nestjs/mapped-types';
import { CriarUnidadeFederacaoDto } from './criar-unidade-federacao.dto';

export class AtualizarUnidadeFederacaoDto extends PartialType(
  CriarUnidadeFederacaoDto,
) {}
