import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoAplicacaoController } from './tipo-aplicacao.controller';
import { TipoAplicacaoService } from './tipo-aplicacao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoAplicacaoController],
  providers: [TipoAplicacaoService],
})
export class TipoAplicacaoModule {}
