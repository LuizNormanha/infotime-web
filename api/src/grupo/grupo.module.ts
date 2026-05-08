import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { GrupoController } from './grupo.controller';
import { GrupoService } from './grupo.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [GrupoController],
  providers: [GrupoService],
})
export class GrupoModule {}
