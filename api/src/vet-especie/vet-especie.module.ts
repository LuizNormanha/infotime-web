import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { VetEspecieController } from './vet-especie.controller';
import { VetEspecieService } from './vet-especie.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [VetEspecieController],
  providers: [VetEspecieService],
})
export class VetEspecieModule {}
