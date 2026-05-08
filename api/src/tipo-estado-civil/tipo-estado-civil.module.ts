import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoEstadoCivilController } from './tipo-estado-civil.controller';
import { TipoEstadoCivilService } from './tipo-estado-civil.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoEstadoCivilController],
  providers: [TipoEstadoCivilService],
})
export class TipoEstadoCivilModule {}
