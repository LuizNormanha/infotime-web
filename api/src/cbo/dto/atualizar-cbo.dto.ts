import { PartialType } from '@nestjs/mapped-types';
import { CriarCboDto } from './criar-cbo.dto';

export class AtualizarCboDto extends PartialType(CriarCboDto) {}
