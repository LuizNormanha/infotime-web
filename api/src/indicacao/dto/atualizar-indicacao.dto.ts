import { PartialType } from '@nestjs/mapped-types';
import { CriarIndicacaoDto } from './criar-indicacao.dto';

export class AtualizarIndicacaoDto extends PartialType(CriarIndicacaoDto) {}
