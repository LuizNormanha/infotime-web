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
            'Mantenha o mesmo DATABASE_URL na raiz do monorepo e em packages/database/.env (comandos Prisma CLI).',
        );
      }
      throw e;
    }
  }

  async onModuleDestroy() {
    await this.$disconnect();
  }
}
