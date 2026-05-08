import { Module } from '@nestjs/common';

import { PrismaModule } from '../prisma/prisma.module';
import { UsuarioPermissoesController } from './usuario-permissoes.controller';
import { UsuarioPermissoesService } from './usuario-permissoes.service';

@Module({
  imports: [PrismaModule],
  controllers: [UsuarioPermissoesController],
  providers: [UsuarioPermissoesService],
})
export class UsuarioPermissoesModule {}
