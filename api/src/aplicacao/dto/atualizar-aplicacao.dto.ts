import { PartialType } from '@nestjs/mapped-types';
import { CriarAplicacaoDto } from './criar-aplicacao.dto';

export class AtualizarAplicacaoDto extends PartialType(CriarAplicacaoDto) {}
