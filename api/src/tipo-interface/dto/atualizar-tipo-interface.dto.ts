import { PartialType } from '@nestjs/mapped-types';
import { CriarTipoInterfaceDto } from './criar-tipo-interface.dto';

export class AtualizarTipoInterfaceDto extends PartialType(
  CriarTipoInterfaceDto,
) {}
