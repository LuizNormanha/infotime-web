import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { MedicamentoController } from './medicamento.controller';
import { MedicamentoService } from './medicamento.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [MedicamentoController],
  providers: [MedicamentoService],
})
export class MedicamentoModule {}
