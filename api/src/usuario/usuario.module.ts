import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { UsuarioController } from './usuario.controller';
import { UsuarioService } from './usuario.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [UsuarioController],
  providers: [UsuarioService],
})
export class UsuarioModule {}
