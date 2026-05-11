import { config as dotenvConfig } from 'dotenv';
import { join } from 'node:path';

/**
 * Garante leitura de `.env` antes do `ConfigModule` aplicar variáveis ao processo
 * (ordem de avaliação dos `imports` do `AppModule`).
 * Mesmos caminhos que `ConfigModule.forRoot` em `app.module.ts`.
 */
export function carregarEnvFilasSeNecessario(): void {
  dotenvConfig({ path: join(process.cwd(), 'api', '.env'), override: false });
  dotenvConfig({ path: join(process.cwd(), '.env'), override: false });
}

export function bullmqExplicitamenteDesligado(): boolean {
  return /^(1|true|yes)$/i.test(process.env.BULLMQ_DISABLED?.trim() ?? '');
}

export function bullmqTemUrlRedisNoProcessEnv(): boolean {
  return !!(
    process.env.BULLMQ_REDIS_URL?.trim() ||
    process.env.THROTTLER_REDIS_URL?.trim()
  );
}

/** Se falso, não registra BullMQ nem workers (evita ECONNREFUSED quando não há Redis). */
export function bullmqDeveRegistrarNaSubida(): boolean {
  carregarEnvFilasSeNecessario();
  if (bullmqExplicitamenteDesligado()) return false;
  return bullmqTemUrlRedisNoProcessEnv();
}
