import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoIntegracaoController } from './tipo-integracao.controller';
import { TipoIntegracaoService } from './tipo-integracao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoIntegracaoController],
  providers: [TipoIntegracaoService],
})
export class TipoIntegracaoModule {}
