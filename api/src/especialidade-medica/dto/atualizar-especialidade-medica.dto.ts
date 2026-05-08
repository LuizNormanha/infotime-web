import { PartialType } from '@nestjs/mapped-types';
import { CriarEspecialidadeMedicaDto } from './criar-especialidade-medica.dto';

export class AtualizarEspecialidadeMedicaDto extends PartialType(
  CriarEspecialidadeMedicaDto,
) {}
