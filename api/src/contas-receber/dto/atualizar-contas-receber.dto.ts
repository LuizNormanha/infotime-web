import { PartialType } from '@nestjs/mapped-types';

import { CriarContasReceberDto } from './criar-contas-receber.dto';

export class AtualizarContasReceberDto extends PartialType(CriarContasReceberDto) {}
