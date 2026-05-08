import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoEventoController } from './tipo-evento.controller';
import { TipoEventoService } from './tipo-evento.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoEventoController],
  providers: [TipoEventoService],
})
export class TipoEventoModule {}
