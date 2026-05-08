import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TenacidadeController } from './tenacidade.controller';
import { TenacidadeService } from './tenacidade.service';

/** Módulo Nest alinhado ao model Prisma `infolab_tenacidade` (tabela física `tenacidade`). */
@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TenacidadeController],
  providers: [TenacidadeService],
})
export class TenacidadeModule {}
