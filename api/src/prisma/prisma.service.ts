import { INestApplication, Injectable } from '@nestjs/common';
import { PrismaClient } from '@prisma/client';

import { setCurrentTenantLocal } from './set-current-tenant-local';
import {
  rlsJaAplicadoNaTransacaoInterativa,
  tenantRlsStorage,
} from './tenant-rls.storage';

/**
 * Teto máximo de registros retornados por findMany quando `take` não é especificado.
 * Previne queries sem limite que causam OOM em tabelas grandes.
 * Para exportações completas, passe `take: Number.MAX_SAFE_INTEGER` explicitamente.
 */
export const LISTAGEM_MAX_TAKE = 500;

/**
 * Cliente Prisma com extensão RLS + teto de paginação:
 * - RLS: em requisições autenticadas aplica `set_config('app.current_tenant_id', ...)`.
 * - Paginação: `findMany` sem `take` recebe automaticamente `take: LISTAGEM_MAX_TAKE`.
 *
 * Transações interativas com JWT: após `setCurrentTenantLocal` no `tx`, envolver o corpo com
 * `executarComRlsJaAplicadoNaTransacao` (tenant-rls.storage) para evitar que cada `tx.*` dispare outro `$transaction`.
 */
export function createExtendedPrismaClient(databaseUrl?: string) {
  const prisma = databaseUrl
    ? new PrismaClient({
        datasources: { db: { url: databaseUrl } },
      })
    : new PrismaClient();
  const extended = prisma.$extends({
    query: {
      $allModels: {
        async $allOperations({ model, operation, args, query }) {
          // Aplica teto de segurança para findMany sem take explícito.
          // Mutação direta de args evita o limite de complexidade do tipo-union do Prisma.
          if (
            operation === 'findMany' &&
            (args as { take?: number }).take === undefined
          ) {
            (args as { take?: number }).take = LISTAGEM_MAX_TAKE;
          }

          const ctx = tenantRlsStorage.getStore();
          if (ctx == null) return query(args);
          if (rlsJaAplicadoNaTransacaoInterativa()) return query(args);
          return prisma.$transaction(async (tx) => {
            await setCurrentTenantLocal(tx, ctx.tenantId);
            const d = tx as unknown as Record<
              string,
              Record<string, (a: unknown) => Promise<unknown>>
            >;
            return d[model][operation](args);
          });
        },
      },
    },
  });

  return extended;
}

export type ExtendedPrismaClient = ReturnType<
  typeof createExtendedPrismaClient
>;

/**
 * Tipo da instância real retornada pelo `PrismaModule` (cliente estendido + `enableShutdownHooks`).
 * Use em construtores quando precisar refletir a extensão RLS/listagem no TypeScript; o token de
 * injeção Nest continua sendo a classe `PrismaService`.
 */
export type AppPrismaService = ExtendedPrismaClient & {
  enableShutdownHooks(app: INestApplication): void;
};

/** Token de injeção Nest; a instância real vem da factory em `PrismaModule`. */
@Injectable()
export class PrismaService extends PrismaClient {
  /** Sobrescrito em runtime por `attachPrismaLifecycle`. */
  enableShutdownHooks(_app: INestApplication): void {
    void _app;
  }
}

export function attachPrismaLifecycle(
  client: ExtendedPrismaClient,
): ExtendedPrismaClient & {
  enableShutdownHooks(app: INestApplication): void;
} {
  return Object.assign(client, {
    enableShutdownHooks(app: INestApplication) {
      const shutdown = async () => {
        await app.close();
        await client.$disconnect();
      };
      process.on('SIGINT', () => {
        void shutdown();
      });
      process.on('SIGTERM', () => {
        void shutdown();
      });
    },
  });
}
