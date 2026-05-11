import { Logger } from '@nestjs/common';

/** Contexto mínimo para correlacionar logs de jobs em JSON (grep/agregação). */
export type ContextoLogJob = {
  fila: string;
  id_job: string;
  nome_job: string;
  tentativa?: number;
  id_tenacidade?: string;
};

export function logJobInicio(
  logger: Logger,
  ctx: ContextoLogJob,
  extra?: Record<string, unknown>,
): void {
  logger.log(
    JSON.stringify({
      evento: 'job_inicio',
      ...ctx,
      ...extra,
    }),
  );
}

export function logJobFim(
  logger: Logger,
  ctx: ContextoLogJob & { duracao_ms?: number },
  estatisticas?: Record<string, unknown>,
): void {
  logger.log(
    JSON.stringify({
      evento: 'job_fim',
      ...ctx,
      ...(estatisticas ?? {}),
    }),
  );
}

export function logJobErro(
  logger: Logger,
  ctx: ContextoLogJob,
  erro: unknown,
): void {
  const mensagem_erro = erro instanceof Error ? erro.message : String(erro);
  logger.error(
    JSON.stringify({
      evento: 'job_erro',
      ...ctx,
      mensagem_erro,
      stack: erro instanceof Error ? erro.stack : undefined,
    }),
  );
}
