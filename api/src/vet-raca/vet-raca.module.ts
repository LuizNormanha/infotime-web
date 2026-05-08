import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { VetRacaController } from './vet-raca.controller';
import { VetRacaService } from './vet-raca.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [VetRacaController],
  providers: [VetRacaService],
})
export class VetRacaModule {}
