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
import { FilasModule } from './filas/filas.module';
import { LayoutModule } from './layout/layout.module';
import { ClienteModule } from './cliente/cliente.module';
import { ColaboradorModule } from './colaborador/colaborador.module';
import { ContasPagarModule } from './contas-pagar/contas-pagar.module';
import { ContasReceberModule } from './contas-receber/contas-receber.module';
import { FinanceiroModule } from './financeiro/financeiro.module';
import { FornecedorModule } from './fornecedor/fornecedor.module';
import { UsuarioModule } from './usuario/usuario.module';
import { UsuarioPermissoesModule } from './usuario-permissoes/usuario-permissoes.module';

@Module({
  imports: [
    ConfigModule.forRoot({
      // Repo root (nx / IDE) ou pasta api: sempre encontra `api/.env`.
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
          // Apenas o tier `global` aqui: no v6 do @nestjs/throttler, **todos** os throttlers
          // registrados entram na conta de **cada** rota. O tier `auth` (10/15min) fazia 429
          // ao abrir formulários (várias chamadas à API). Login usa @Throttle({ global: ... }).
          throttlers: [{ name: 'global', ttl: 60_000, limit: 100 }],
          // Em produção multi-instância, defina THROTTLER_REDIS_URL para
          // garantir rate limiting distribuído. Sem ela, usa memória local.
          ...(redisUrl
            ? { storage: new ThrottlerStorageRedisService(new Redis(redisUrl)) }
            : {}),
        };
      },
    }),
    PrismaModule,
    FilasModule.forRootAsync(),
    ModuloAutenticacao,
    GrupoPerfilModule,
    UsuarioModule,
    ClienteModule,
    ColaboradorModule,
    FornecedorModule,
    ContasPagarModule,
    ContasReceberModule,
    FinanceiroModule,
    UsuarioPermissoesModule,
    LayoutModule,
  ],
  controllers: [AppController],
  providers: [
    { provide: APP_GUARD, useClass: ThrottlerGuard },
    { provide: APP_GUARD, useClass: GuardAutenticacaoJwtMultiTenant },
  ],
})
export class AppModule {}
