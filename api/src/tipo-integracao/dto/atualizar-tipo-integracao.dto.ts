import { PartialType } from '@nestjs/mapped-types';
import { CriarTipoIntegracaoDto } from './criar-tipo-integracao.dto';

export class AtualizarTipoIntegracaoDto extends PartialType(
  CriarTipoIntegracaoDto,
) {}
