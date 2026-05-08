import { PartialType } from '@nestjs/mapped-types';

import { CriarMedicoDto } from './criar-medico.dto';

export class AtualizarMedicoDto extends PartialType(CriarMedicoDto) {}
