"use client";

import { useMemo } from "react";
import { Divider } from "primereact/divider";

import "./FinancialSummary.css";

export type FinancialSummaryProps = {
  totalExames: number;
  acrescimos: number;
  descontos: number;
  totalPago: number;
  valorRestante: number;
  /** Título do card (default: Resumo financeiro) */
  title?: string;
  className?: string;
};

const fmt = new Intl.NumberFormat("pt-BR", {
  style: "currency",
  currency: "BRL",
  minimumFractionDigits: 2,
  maximumFractionDigits: 2,
});

function formatBrl(n: number): string {
  if (!Number.isFinite(n)) return fmt.format(0);
  return fmt.format(n);
}

/**
 * Resumo financeiro alinhado ao painel de atendimento (borda leve, hierarquia simples).
 */
export function FinancialSummary({
  totalExames,
  acrescimos,
  descontos,
  totalPago,
  valorRestante,
  title = "Resumo financeiro",
  className = "",
}: FinancialSummaryProps) {
  const totalGeral = useMemo(
    () => totalExames + acrescimos - descontos,
    [totalExames, acrescimos, descontos],
  );

  const rootClass = ["financial-summary", className].filter(Boolean).join(" ");

  return (
    <div className={rootClass}>
      <div className="financial-summary__head">
        <h3 className="financial-summary__title">{title}</h3>
        <span className="financial-summary__tag">Pagamentos</span>
      </div>

      <div className="financial-summary__body">
        <div className="financial-summary__destaque">
          <span className="financial-summary__destaque-label">Total geral (exames + acréscimos − descontos)</span>
          <span className="financial-summary__destaque-valor">{formatBrl(totalGeral)}</span>
        </div>

        <div className="financial-summary__metricas">
          <div className="financial-summary__metrica">
            <span className="financial-summary__metrica-label">Total exames</span>
            <span className="financial-summary__metrica-valor">{formatBrl(totalExames)}</span>
          </div>
          <div className="financial-summary__metrica">
            <span className="financial-summary__metrica-label">Acréscimos</span>
            <span className="financial-summary__metrica-valor">{formatBrl(acrescimos)}</span>
          </div>
          <div className="financial-summary__metrica">
            <span className="financial-summary__metrica-label">Descontos</span>
            <span className="financial-summary__metrica-valor">{formatBrl(descontos)}</span>
          </div>
        </div>

        <Divider className="financial-summary__divider" />

        <div className="financial-summary__rodape">
          <div className="financial-summary__linha">
            <span className="financial-summary__linha-label">Total pago</span>
            <span className="financial-summary__linha-valor financial-summary__linha-valor--ok">
              {formatBrl(totalPago)}
            </span>
          </div>
          <div className="financial-summary__linha">
            <span className="financial-summary__linha-label">Valor restante</span>
            <span className="financial-summary__linha-valor financial-summary__linha-valor--alerta">
              {formatBrl(valorRestante)}
            </span>
          </div>
        </div>
      </div>
    </div>
  );
}
