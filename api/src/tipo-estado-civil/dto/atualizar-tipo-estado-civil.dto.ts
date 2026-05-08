import { PartialType } from '@nestjs/mapped-types';
import { CriarTipoEstadoCivilDto } from './criar-tipo-estado-civil.dto';

export class AtualizarTipoEstadoCivilDto extends PartialType(
  CriarTipoEstadoCivilDto,
) {}
