import type { JobsOptions } from 'bullmq';

/**
 * Monta um `jobId` estável para deduplicação na fila BullMQ (evita reenfileirar o mesmo trabalho
 * enquanto o job existir em estado waiting/delayed/active).
 * Inclua sempre o tenant nos `segmentos` (ex.: `id_tenacidade`) para não colidir entre clientes.
 * Observação: dados do payload devem ser JSON-serializáveis (evite BigInt sem converter).
 */
export function montarJobIdDeterministico(
  segmentos: readonly (string | number | bigint)[],
): string {
  return segmentos.map((s) => String(s).replace(/:/g, '_')).join(':');
}

/**
 * Opções recomendadas para jobs financeiros: retries com backoff exponencial,
 * retenção limitada de histórico e `jobId` explícito para idempotência de enfileiramento.
 */
export function opcoesJobPadraoFinanceiro(jobId: string): JobsOptions {
  return {
    jobId,
    attempts: 3,
    backoff: { type: 'exponential', delay: 5000 },
    removeOnComplete: { age: 86_400, count: 2000 },
    removeOnFail: { age: 604_800 },
  };
}
