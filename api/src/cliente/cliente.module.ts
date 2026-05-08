import { Module } from '@nestjs/common';
import { ClienteController } from './cliente.controller';
import { ClienteService } from './cliente.service';
import { PrismaModule } from '../prisma/prisma.module';
import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [ClienteController],
  providers: [ClienteService],
})
export class ClienteModule {}
