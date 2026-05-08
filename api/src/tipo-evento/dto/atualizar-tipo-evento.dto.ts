import { PartialType } from '@nestjs/mapped-types';
import { CriarTipoEventoDto } from './criar-tipo-evento.dto';

export class AtualizarTipoEventoDto extends PartialType(CriarTipoEventoDto) {}
