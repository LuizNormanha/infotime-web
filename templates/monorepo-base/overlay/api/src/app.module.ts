import { join } from 'node:path';

import { Module } from '@nestjs/common';
import { ConfigModule, ConfigService } from '@nestjs/config';
import { APP_GUARD } from '@nestjs/core';
import { ThrottlerModule, ThrottlerGuard } from '@nestjs/throttler';
import { ThrottlerStorageRedisService } from '@nest-lab/throttler-storage-redis';
import Redis from 'ioredis';
import { AppController } from './app.controller';
import { GuardAutenticacaoJwtMultiTenant } from './autenticacao/autenticacao.guard';
import { PrismaModule } from './prisma/prisma.module';
import { ModuloAutenticacao } from './autenticacao/autenticacao.module';
import { GrupoPerfilModule } from './grupo-perfil/grupo-perfil.module';
import { LayoutModule } from './layout/layout.module';
import { DicionarioModule } from './dicionario/dicionario.module';
import { AplicacaoModule } from './aplicacao/aplicacao.module';
import { UsuarioModule } from './usuario/usuario.module';
import { UsuarioPermissoesModule } from './usuario-permissoes/usuario-permissoes.module';
import { ImplantacaoTenacidadeModule } from './implantacao-tenacidade/implantacao-tenacidade.module';
import { TenacidadeModule } from './tenacidade/tenacidade.module';
import { TenacidadeConfiguracaoModule } from './tenacidade-configuracao/tenacidade-configuracao.module';
import { AiModule } from './ai/ai.module';

@Module({
  imports: [
    ConfigModule.forRoot({
      envFilePath: [
        join(process.cwd(), 'api', '.env'),
        join(process.cwd(), '.env'),
      ],
      isGlobal: true,
      validate(config: Record<string, unknown>) {
        const obrigatorias = ['DATABASE_URL', 'SUPORTE_SECRET_KEY'];
        const ausentes = obrigatorias.filter((k) => !config[k]);
        if (ausentes.length > 0) {
          throw new Error(
            `Variáveis de ambiente obrigatórias ausentes: ${ausentes.join(', ')}`,
          );
        }
        return config;
      },
    }),
    ThrottlerModule.forRootAsync({
      imports: [ConfigModule],
      inject: [ConfigService],
      useFactory: (config: ConfigService) => {
        const redisUrl = config.get<string>('THROTTLER_REDIS_URL');
        return {
          throttlers: [{ name: 'global', ttl: 60_000, limit: 100 }],
          ...(redisUrl
            ? { storage: new ThrottlerStorageRedisService(new Redis(redisUrl)) }
            : {}),
        };
      },
    }),
    PrismaModule,
    ModuloAutenticacao,
    AplicacaoModule,
    GrupoPerfilModule,
    ImplantacaoTenacidadeModule,
    TenacidadeModule,
    TenacidadeConfiguracaoModule,
    UsuarioModule,
    UsuarioPermissoesModule,
    LayoutModule,
    DicionarioModule,
    AiModule,
  ],
  controllers: [AppController],
  providers: [
    { provide: APP_GUARD, useClass: ThrottlerGuard },
    { provide: APP_GUARD, useClass: GuardAutenticacaoJwtMultiTenant },
  ],
})
export class AppModule {}
