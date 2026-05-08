import { Module } from '@nestjs/common';
import { FeriadoController } from './feriado.controller';
import { FeriadoService } from './feriado.service';
import { PrismaModule } from '../prisma/prisma.module';
import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';

/**
 * CRUD infolab_feriado — escopo por id_tenacidade do JWT.
 * Registrar em AppModule: imports: [..., FeriadoModule].
 */
@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [FeriadoController],
  providers: [FeriadoService],
})
export class FeriadoModule {}
