import { Global, Logger, Module } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

import {
  attachPrismaLifecycle,
  createExtendedPrismaClient,
  PrismaService,
} from './prisma.service';

const logger = new Logger('PrismaModule');

/** Nome do banco na URL Postgres (após a última `/`), só para diagnóstico no boot. */
function nomeBancoDaUrl(url: string): string {
  try {
    const u = new URL(url.replace(/^postgres(ql)?:\/\//i, 'http://'));
    const path = u.pathname.replace(/^\//, '');
    return path.split('/')[0]?.split('?')[0] || '?';
  } catch {
    return '?';
  }
}

@Global()
@Module({
  providers: [
    {
      provide: PrismaService,
      inject: [ConfigService],
      useFactory: async (config: ConfigService) => {
        const url = config.getOrThrow<string>('DATABASE_URL');
        logger.log(`Prisma: conectando ao banco "${nomeBancoDaUrl(url)}"`);
        const client = createExtendedPrismaClient(url);
        // Falha o bootstrap se o banco estiver inacessível.
        // Melhor falhar rápido do que servir requisições sem banco.
        await client.$connect().catch((err: unknown) => {
          logger.error('Falha ao conectar ao banco via Prisma', err);
          throw err;
        });
        // Runtime = cliente estendido (RLS); ver tipo `AppPrismaService` em prisma.service.ts.
        return attachPrismaLifecycle(client);
      },
    },
  ],
  exports: [PrismaService],
})
export class PrismaModule {}
