import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { TenacidadeConfiguracaoController } from './tenacidade-configuracao.controller';
import { TenacidadeConfiguracaoService } from './tenacidade-configuracao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [TenacidadeConfiguracaoController],
  providers: [TenacidadeConfiguracaoService],
})
export class TenacidadeConfiguracaoModule {}
