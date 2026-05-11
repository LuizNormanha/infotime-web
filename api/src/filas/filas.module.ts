import { BullModule } from '@nestjs/bullmq';
import { DynamicModule, Global, Module } from '@nestjs/common';
import { ConfigModule, ConfigService } from '@nestjs/config';

import { FilasBullmqDesligadoLogger } from './filas-bullmq-desligado.logger';
import { bullmqDeveRegistrarNaSubida } from './filas-env-inicial';
import { FILA_FINANCEIRO } from './filas.constants';
import { FinanceiroFilaProcessor } from './processors/financeiro-fila.processor';

export function resolverUrlRedis(config: ConfigService): string {
  const u =
    config.get<string>('BULLMQ_REDIS_URL')?.trim() ||
    config.get<string>('THROTTLER_REDIS_URL')?.trim();
  if (!u) {
    throw new Error(
      'BullMQ: BULLMQ_REDIS_URL ou THROTTLER_REDIS_URL deve estar definido quando as filas estão ativas.',
    );
  }
  return u;
}

/**
 * Filas BullMQ + Redis. Use `InjectQueue(FILA_FINANCEIRO)` para publicar jobs.
 *
 * Só regista conexão BullMQ se existir URL (`BULLMQ_REDIS_URL` ou `THROTTLER_REDIS_URL`)
 * e `BULLMQ_DISABLED` não for verdadeiro — evita `ECONNREFUSED` em dev sem Redis.
 *
 * Idempotência de enfileiramento: `jobId` estável + `opcoesJobPadraoFinanceiro`.
 */
@Global()
@Module({})
export class FilasModule {
  static forRootAsync(): DynamicModule {
    if (!bullmqDeveRegistrarNaSubida()) {
      return {
        module: FilasModule,
        global: true,
        imports: [],
        providers: [FilasBullmqDesligadoLogger],
        exports: [],
      };
    }

    return {
      module: FilasModule,
      global: true,
      imports: [
        BullModule.forRootAsync({
          imports: [ConfigModule],
          inject: [ConfigService],
          useFactory: (config: ConfigService) => {
            const url = resolverUrlRedis(config);
            return {
              connection: { url },
              defaultJobOptions: {
                attempts: 3,
                backoff: { type: 'exponential' as const, delay: 5000 },
                removeOnComplete: { age: 86_400, count: 2000 },
                removeOnFail: { age: 604_800 },
              },
            };
          },
        }),
        BullModule.registerQueue({
          name: FILA_FINANCEIRO,
        }),
      ],
      providers: [FinanceiroFilaProcessor],
      exports: [BullModule],
    };
  }
}
