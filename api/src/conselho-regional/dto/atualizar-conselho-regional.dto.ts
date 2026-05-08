import { PartialType } from '@nestjs/mapped-types';
import { CriarConselhoRegionalDto } from './criar-conselho-regional.dto';

export class AtualizarConselhoRegionalDto extends PartialType(
  CriarConselhoRegionalDto,
) {}
