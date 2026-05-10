import { PartialType } from '@nestjs/mapped-types';

import { CriarContasPagarDto } from './criar-contas-pagar.dto';

export class AtualizarContasPagarDto extends PartialType(CriarContasPagarDto) {}
