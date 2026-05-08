import { Module } from '@nestjs/common';

import { PrismaModule } from '../prisma/prisma.module';
import { ImplantacaoTenacidadeController } from './implantacao-tenacidade.controller';
import { ImplantacaoTenacidadeService } from './implantacao-tenacidade.service';
import { GuardImplantacaoJwt } from '../comum/guards/guard-implantacao.jwt';

@Module({
  imports: [PrismaModule],
  controllers: [ImplantacaoTenacidadeController],
  providers: [ImplantacaoTenacidadeService, GuardImplantacaoJwt],
})
export class ImplantacaoTenacidadeModule {}
