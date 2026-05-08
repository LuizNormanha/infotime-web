import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { MotivoDescontoController } from './motivo-desconto.controller';
import { MotivoDescontoService } from './motivo-desconto.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [MotivoDescontoController],
  providers: [MotivoDescontoService],
})
export class MotivoDescontoModule {}
