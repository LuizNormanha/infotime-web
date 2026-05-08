import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { ConselhoRegionalController } from './conselho-regional.controller';
import { ConselhoRegionalService } from './conselho-regional.service';

/** Importe `ConselhoRegionalModule` em `AppModule` para expor as rotas. */
@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [ConselhoRegionalController],
  providers: [ConselhoRegionalService],
})
export class ConselhoRegionalModule {}
