import { Module } from '@nestjs/common';

import { PrismaModule } from '../prisma/prisma.module';
import { UnidadeAtendimentoController } from './unidade-atendimento.controller';
import { UnidadeAtendimentoService } from './unidade-atendimento.service';

@Module({
  imports: [PrismaModule],
  controllers: [UnidadeAtendimentoController],
  providers: [UnidadeAtendimentoService],
})
export class UnidadeAtendimentoModule {}
