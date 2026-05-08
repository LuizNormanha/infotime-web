import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { EtniaController } from './etnia.controller';
import { EtniaService } from './etnia.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [EtniaController],
  providers: [EtniaService],
})
export class EtniaModule {}
