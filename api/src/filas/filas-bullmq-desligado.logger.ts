import { Injectable, Logger, OnModuleInit } from '@nestjs/common';

import {
  bullmqExplicitamenteDesligado,
  bullmqTemUrlRedisNoProcessEnv,
} from './filas-env-inicial';

/**
 * Registrado apenas quando BullMQ não sobe; orienta dev sem Redis local.
 */
@Injectable()
export class FilasBullmqDesligadoLogger implements OnModuleInit {
  private readonly log = new Logger('FilasBullmq');

  onModuleInit(): void {
    if (bullmqExplicitamenteDesligado()) {
      this.log.log('BullMQ desativado (BULLMQ_DISABLED).');
      return;
    }
    if (!bullmqTemUrlRedisNoProcessEnv()) {
      this.log.warn(
        'BullMQ inativo: defina BULLMQ_REDIS_URL ou THROTTLER_REDIS_URL para filas e workers. ' +
          'Exemplo local: BULLMQ_REDIS_URL=redis://127.0.0.1:6379',
      );
    }
  }
}
