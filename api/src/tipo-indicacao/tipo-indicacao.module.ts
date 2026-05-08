import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoIndicacaoController } from './tipo-indicacao.controller';
import { TipoIndicacaoService } from './tipo-indicacao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoIndicacaoController],
  providers: [TipoIndicacaoService],
})
export class TipoIndicacaoModule {}
