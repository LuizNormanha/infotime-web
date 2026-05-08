import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { MotivoRetificacaoController } from './motivo-retificacao.controller';
import { MotivoRetificacaoService } from './motivo-retificacao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [MotivoRetificacaoController],
  providers: [MotivoRetificacaoService],
})
export class MotivoRetificacaoModule {}
