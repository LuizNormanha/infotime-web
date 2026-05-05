import { Injectable, OnModuleInit, OnModuleDestroy, Logger } from '@nestjs/common';
import { PrismaClient } from '@infotime/database';

/**
 * Cliente Prisma global. Escopo por tenant (`idTenacidade`) é aplicado nos repositórios/serviços.
 */
@Injectable()
export class PrismaService extends PrismaClient implements OnModuleInit, OnModuleDestroy {
  private readonly logger = new Logger(PrismaService.name);

  constructor() {
    super({
      log: process.env.NODE_ENV === 'development' ? ['error', 'warn'] : ['error'],
    });
  }

  async onModuleInit() {
    try {
      await this.$connect();
      this.logger.log('Prisma conectado');
    } catch (e: unknown) {
      const code =
        e && typeof e === 'object' && 'errorCode' in e
          ? String((e as { errorCode?: string }).errorCode)
          : '';
      if (code === 'P1000') {
        this.logger.error(
          'PostgreSQL recusou DATABASE_URL (P1000). Confirme utilizador e password no servidor. ' +
            'Na URL, codifique caracteres especiais na password (@ → %40, : → %3A). ' +
            'Defina `DATABASE_URL` no `.env` na raiz do monorepo (os scripts `pnpm db:*` e o build de `@infotime/database` carregam esse ficheiro).',
        );
      }
      throw e;
    }
  }

  async onModuleDestroy() {
    await this.$disconnect();
  }
}
