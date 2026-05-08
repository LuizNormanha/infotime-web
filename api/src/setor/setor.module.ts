import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { SetorController } from './setor.controller';
import { SetorService } from './setor.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [SetorController],
  providers: [SetorService],
})
export class SetorModule {}
