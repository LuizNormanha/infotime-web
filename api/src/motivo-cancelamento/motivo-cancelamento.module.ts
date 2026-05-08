import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { MotivoCancelamentoController } from './motivo-cancelamento.controller';
import { MotivoCancelamentoService } from './motivo-cancelamento.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [MotivoCancelamentoController],
  providers: [MotivoCancelamentoService],
})
export class MotivoCancelamentoModule {}
