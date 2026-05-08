import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { MedicoController } from './medico.controller';
import { MedicoService } from './medico.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [MedicoController],
  providers: [MedicoService],
})
export class MedicoModule {}
