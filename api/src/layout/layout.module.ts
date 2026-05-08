import { Module } from '@nestjs/common';
import { LayoutController } from './layout.controller';
import { LayoutService } from './layout.service';
import { PrismaModule } from '../prisma/prisma.module';
import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [LayoutController],
  providers: [LayoutService],
})
export class LayoutModule {}
