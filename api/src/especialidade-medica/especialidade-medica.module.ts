import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { EspecialidadeMedicaController } from './especialidade-medica.controller';
import { EspecialidadeMedicaService } from './especialidade-medica.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [EspecialidadeMedicaController],
  providers: [EspecialidadeMedicaService],
})
export class EspecialidadeMedicaModule {}
