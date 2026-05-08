import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TipoInterfaceController } from './tipo-interface.controller';
import { TipoInterfaceService } from './tipo-interface.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TipoInterfaceController],
  providers: [TipoInterfaceService],
})
export class TipoInterfaceModule {}
