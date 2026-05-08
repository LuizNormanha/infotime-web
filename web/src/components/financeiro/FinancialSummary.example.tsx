"use client";

/**
 * Exemplo de uso com dados mockados — útil para ajustar layout no isolamento.
 * Não importe em produção; use como referência ou em página de desenvolvimento.
 *
 * Uso rápido no pai:
 * ```tsx
 * import { FinancialSummary } from "@/components/financeiro/FinancialSummary";
 *
 * <FinancialSummary
 *   totalExames={2450.5}
 *   acrescimos={120}
 *   descontos={200}
 *   totalPago={1500}
 *   valorRestante={870.5}
 * />
 * ```
 */

import { FinancialSummary } from "./FinancialSummary";

const MOCK = {
  totalExames: 2450.5,
  acrescimos: 120,
  descontos: 200,
  totalPago: 1500,
  /** totalGeral = 2370.5 → restante = 870.5 */
  valorRestante: 870.5,
};

export function FinancialSummaryExample() {
  return (
    <div style={{ maxWidth: 720, margin: "0 auto", padding: "1rem" }}>
      <FinancialSummary
        totalExames={MOCK.totalExames}
        acrescimos={MOCK.acrescimos}
        descontos={MOCK.descontos}
        totalPago={MOCK.totalPago}
        valorRestante={MOCK.valorRestante}
      />
    </div>
  );
}
