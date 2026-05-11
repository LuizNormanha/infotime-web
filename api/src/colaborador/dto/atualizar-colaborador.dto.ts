import { PartialType } from '@nestjs/mapped-types';

import { CriarColaboradorDto } from './criar-colaborador.dto';

export class AtualizarColaboradorDto extends PartialType(CriarColaboradorDto) {}
