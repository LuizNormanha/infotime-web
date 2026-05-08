import { Module } from '@nestjs/common';
import { JwtModule } from '@nestjs/jwt';
import { PassportModule } from '@nestjs/passport';

import { PrismaModule } from '../prisma/prisma.module';
import { ControladorAutenticacao } from './autenticacao.controller';
import { ServicoAutenticacao } from './autenticacao.service';
import { GuardAutenticacaoJwtMultiTenant } from './autenticacao.guard';
import { EstrategiaJwtMultiTenant } from './autenticacao.strategy';
import { GeradorSenhaDoDia } from './gerador-senha-dia.service';
import { ServicoCaptchaLogin } from './captcha-login.service';

@Module({
  imports: [
    PrismaModule,
    PassportModule,
    // Sem secret global — cada token usa chave dinâmica por tenant
    JwtModule.register({}),
  ],
  controllers: [ControladorAutenticacao],
  providers: [
    ServicoAutenticacao,
    ServicoCaptchaLogin,
    GeradorSenhaDoDia,
    GuardAutenticacaoJwtMultiTenant,
    EstrategiaJwtMultiTenant,
  ],
  exports: [
    ServicoAutenticacao,
    GuardAutenticacaoJwtMultiTenant,
    GeradorSenhaDoDia,
    JwtModule,
  ],
})
export class ModuloAutenticacao {}
