import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { ProcedenciaController } from './procedencia.controller';
import { ProcedenciaService } from './procedencia.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [ProcedenciaController],
  providers: [ProcedenciaService],
})
export class ProcedenciaModule {}
