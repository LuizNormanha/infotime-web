import { PartialType } from '@nestjs/mapped-types';

import { CriarSetorDto } from './criar-setor.dto';

export class AtualizarSetorDto extends PartialType(CriarSetorDto) {}
