import { Module } from '@nestjs/common';
import { ClsModule } from 'nestjs-cls';
import { PrismaModule } from './shared/prisma/prisma.module';
import { AppConfigModule } from './shared/config/config.module';
import { AuthModule } from './modules/auth/auth.module';
import { UsersModule } from './modules/users/users.module';
import { ClientesModule } from './modules/clientes/clientes.module';
import { GruposUsuarioModule } from './modules/grupos-usuario/grupos-usuario.module';
import { AplicacoesModule } from './modules/aplicacoes/aplicacoes.module';
import { HealthModule } from './modules/health/health.module';

@Module({
  imports: [
    AppConfigModule,
    PrismaModule,
    ClsModule.forRoot({ global: true, middleware: { mount: true } }),
    HealthModule,
    AuthModule,
    UsersModule,
    ClientesModule,
    GruposUsuarioModule,
    AplicacoesModule,
  ],
})
export class AppModule {}
