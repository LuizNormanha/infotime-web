import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { IndicacaoController } from './indicacao.controller';
import { IndicacaoService } from './indicacao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [IndicacaoController],
  providers: [IndicacaoService],
})
export class IndicacaoModule {}
