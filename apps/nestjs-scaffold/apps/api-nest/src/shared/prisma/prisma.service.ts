import {
  Injectable,
  OnModuleInit,
  OnModuleDestroy,
  Logger,
} from '@nestjs/common';
import { PrismaClient } from '@infotime/database';
import { ClsService } from 'nestjs-cls';

/**
 * PrismaService — singleton do Prisma com middleware de multi-tenancy.
 *
 * Toda query que envolver um modelo com campo `tenantId` recebe
 * automaticamente o filtro do tenant ativo no contexto do request.
 *
 * O tenantId é injetado pelo TenantInterceptor via ClsService (AsyncLocalStorage).
 */
@Injectable()
export class PrismaService
  extends PrismaClient
  implements OnModuleInit, OnModuleDestroy
{
  private readonly logger = new Logger(PrismaService.name);

  constructor(private readonly cls: ClsService) {
    super({
      log:
        process.env.NODE_ENV === 'development'
          ? ['query', 'error', 'warn']
          : ['error'],
    });

    // ── Middleware de multi-tenancy ────────────────────────────────────
    this.$use(async (params, next) => {
      const tenantId = this.cls.get<number>('tenantId');

      if (!tenantId) return next(params);

      // Modelos que participam do isolamento por tenant
      const tenantModels = new Set([
        'Usuario',
        'Colaborador',
        'Cliente',
        'Contrato',
        'LancamentoDespesa',
        'LancamentoReceita',
        'Proposta',
        'Produto',
        // TODO: adicionar demais modelos conforme migração
      ]);

      if (!tenantModels.has(params.model ?? '')) return next(params);

      // Injeta tenantId em queries de leitura
      if (['findFirst', 'findUnique', 'findMany', 'count', 'aggregate'].includes(params.action)) {
        params.args.where = { ...params.args.where, tenantId };
      }

      // Injeta tenantId em criações
      if (params.action === 'create') {
        params.args.data = { ...params.args.data, tenantId };
      }

      if (params.action === 'createMany') {
        params.args.data = params.args.data.map((d: Record<string, unknown>) => ({
          ...d,
          tenantId,
        }));
      }

      // Garante que updates e deletes não vazam para outros tenants
      if (['update', 'updateMany', 'delete', 'deleteMany'].includes(params.action)) {
        params.args.where = { ...params.args.where, tenantId };
      }

      return next(params);
    });
  }

  async onModuleInit() {
    await this.$connect();
    this.logger.log('Prisma conectado ao PostgreSQL');
  }

  async onModuleDestroy() {
    await this.$disconnect();
    this.logger.log('Prisma desconectado');
  }
}
