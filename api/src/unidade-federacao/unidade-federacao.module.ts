import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { UnidadeFederacaoController } from './unidade-federacao.controller';
import { UnidadeFederacaoService } from './unidade-federacao.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [UnidadeFederacaoController],
  providers: [UnidadeFederacaoService],
})
export class UnidadeFederacaoModule {}
