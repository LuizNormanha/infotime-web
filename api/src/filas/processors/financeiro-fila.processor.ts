import { Processor, WorkerHost } from '@nestjs/bullmq';
import { Logger } from '@nestjs/common';
import { Job } from 'bullmq';

import { FILA_FINANCEIRO, NOME_JOB_FINANCEIRO_PING } from '../filas.constants';
import { logJobFim, logJobInicio } from '../job-log';

export type FinanceiroPingPayload = {
  mensagem?: string;
};

/**
 * Consumidor da fila financeira. Trabalhos reais (régua, score, etc.) devem registrar
 * novos `job.name` aqui ou em processors dedicados na mesma fila.
 */
@Processor(FILA_FINANCEIRO)
export class FinanceiroFilaProcessor extends WorkerHost {
  private readonly logger = new Logger(FinanceiroFilaProcessor.name);

  /**
   * Deve permanecer `async` e aguardar o trabalho real: o BullMQ marca o job como
   * concluído quando a Promise retornada resolve; trabalho assíncrono esquecido aqui
   * seria cortado cedo.
   */
  async process(job: Job<FinanceiroPingPayload>): Promise<void> {
    await this.executar(job);
  }

  /** Síncrono hoje; quando houver I/O, tornar `async` e usar `await` no corpo (exige `await` no método). */
  private executar(job: Job<FinanceiroPingPayload>): void {
    const ctxBase = {
      fila: FILA_FINANCEIRO,
      id_job: job.id ?? 'sem_id',
      nome_job: job.name,
      tentativa: job.attemptsMade,
    };

    const inicio = Date.now();
    logJobInicio(this.logger, ctxBase, { dados: job.data });

    switch (job.name) {
      case NOME_JOB_FINANCEIRO_PING:
        logJobFim(
          this.logger,
          { ...ctxBase, duracao_ms: Date.now() - inicio },
          { ok: true },
        );
        return;
      default:
        this.logger.warn(
          JSON.stringify({
            evento: 'job_desconhecido_concluido',
            ...ctxBase,
          }),
        );
        logJobFim(
          this.logger,
          { ...ctxBase, duracao_ms: Date.now() - inicio },
          { ignorado: true },
        );
        return;
    }
  }
}
