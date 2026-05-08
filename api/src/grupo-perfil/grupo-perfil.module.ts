import { Module } from '@nestjs/common';

import { PrismaModule } from '../prisma/prisma.module';
import { GrupoPerfilController } from './grupo-perfil.controller';
import { GrupoPerfilService } from './grupo-perfil.service';

@Module({
  imports: [PrismaModule],
  controllers: [GrupoPerfilController],
  providers: [GrupoPerfilService],
})
export class GrupoPerfilModule {}
