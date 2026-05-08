import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { AplicacaoController } from './aplicacao.controller';
import { AplicacaoService } from './aplicacao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [AplicacaoController],
  providers: [AplicacaoService],
})
export class AplicacaoModule {}
