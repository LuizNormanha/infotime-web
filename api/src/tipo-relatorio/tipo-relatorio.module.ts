import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoRelatorioController } from './tipo-relatorio.controller';
import { TipoRelatorioService } from './tipo-relatorio.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoRelatorioController],
  providers: [TipoRelatorioService],
})
export class TipoRelatorioModule {}
