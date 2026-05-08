import { Module } from '@nestjs/common';

import { ModuloAutenticacao } from '../autenticacao/autenticacao.module';
import { PrismaModule } from '../prisma/prisma.module';
import { SerieNotaFiscalServicoController } from './serie-nota-fiscal-servico.controller';
import { SerieNotaFiscalServicoService } from './serie-nota-fiscal-servico.service';

@Module({
  imports: [PrismaModule, ModuloAutenticacao],
  controllers: [SerieNotaFiscalServicoController],
  providers: [SerieNotaFiscalServicoService],
})
export class SerieNotaFiscalServicoModule {}
