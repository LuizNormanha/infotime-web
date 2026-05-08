/**
 * Base para agentes futuros (pipelines específicos).
 * Cada agente contribui com instruções de stack/padrões sem duplicar regras de negócio dos arquivos em `ai/domains`.
 */
export abstract class AgenteBase {
  abstract readonly nome: string;

  /** Texto incorporado ao system prompt do `PromptBuilderService`. */
  abstract montarInstrucaoEspecifica(): string;
}
