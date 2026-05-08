import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { CboController } from './cbo.controller';
import { CboService } from './cbo.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [CboController],
  providers: [CboService],
})
export class CboModule {}
