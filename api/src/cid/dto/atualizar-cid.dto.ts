import { PartialType } from '@nestjs/mapped-types';
import { CriarCidDto } from './criar-cid.dto';

export class AtualizarCidDto extends PartialType(CriarCidDto) {}
