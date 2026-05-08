import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { RacaController } from './raca.controller';
import { RacaService } from './raca.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [RacaController],
  providers: [RacaService],
})
export class RacaModule {}
