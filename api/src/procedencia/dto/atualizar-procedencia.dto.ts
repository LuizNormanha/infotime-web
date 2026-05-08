import { PartialType } from '@nestjs/mapped-types';
import { CriarProcedenciaDto } from './criar-procedencia.dto';

export class AtualizarProcedenciaDto extends PartialType(CriarProcedenciaDto) {}
