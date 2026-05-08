import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { CidController } from './cid.controller';
import { CidService } from './cid.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [CidController],
  providers: [CidService],
})
export class CidModule {}
