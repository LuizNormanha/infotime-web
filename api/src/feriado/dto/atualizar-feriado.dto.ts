import { PartialType } from '@nestjs/mapped-types';
import { CriarFeriadoDto } from './criar-feriado.dto';

/** DTO de atualização — todos os campos opcionais. */
export class AtualizarFeriadoDto extends PartialType(CriarFeriadoDto) {}
