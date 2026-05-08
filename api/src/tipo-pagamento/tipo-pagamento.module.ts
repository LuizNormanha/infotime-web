import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoPagamentoController } from './tipo-pagamento.controller';
import { TipoPagamentoService } from './tipo-pagamento.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoPagamentoController],
  providers: [TipoPagamentoService],
})
export class TipoPagamentoModule {}
