import { PartialType } from '@nestjs/mapped-types';
import { CriarGrupoDto } from './criar-grupo.dto';

export class AtualizarGrupoDto extends PartialType(CriarGrupoDto) {}
