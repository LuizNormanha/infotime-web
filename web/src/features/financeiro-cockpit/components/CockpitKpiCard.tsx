"use client";

import { useTranslations } from "next-intl";

import "../liga-cockpit.css";

const fmtBrl = new Intl.NumberFormat("pt-BR", { style: "currency", currency: "BRL" });

const CORES = {
  success: { valor: "#22c55e", sub: "#22c55e", icone: "pi-arrow-up-circle" },
  danger: { valor: "#f87171", sub: "#f87171", icone: "pi-exclamation-circle" },
  warning: { valor: "#eab308", sub: "#eab308", icone: "pi-clock" },
  info: { valor: "#3b82f6", sub: "var(--liga-texto-secundario)", icone: "pi-chart-line" },
} as const;

export type CockpitKpiVariante = keyof typeof CORES;

export type CockpitKpiCardProps = {
  label: string;
  valor: number;
  qtd: number;
  variante: CockpitKpiVariante;
  onClick?: () => void;
  carregando?: boolean;
  /** Subtexto fixo (ex.: saldo “Receber − Pagar”). */
  subtextoFixo?: string;
};

export function CockpitKpiCard({
  label,
  valor,
  qtd,
  variante,
  onClick,
  carregando,
  subtextoFixo,
}: CockpitKpiCardProps) {
  const t = useTranslations("home.financeiroGestaoIntegrada");

  if (carregando) {
    return <div className="liga-cockpit-kpi-skeleton" aria-hidden />;
  }

  const c = CORES[variante];
  const subtexto =
    subtextoFixo ??
    (qtd === 0 && variante === "info"
      ? null
      : `${qtd} ${qtd === 1 ? t("lancamento") : t("lancamentos")}`);

  const Tag = onClick ? "button" : "div";
  return (
    <Tag
      type={onClick ? "button" : undefined}
      className={`liga-cockpit-kpi-card${onClick ? " liga-cockpit-kpi-card--clicavel" : ""}`}
      onClick={onClick}
    >
      <div className="liga-cockpit-kpi-rotulo">
        <i className={`pi ${c.icone}`} aria-hidden />
        <span>{label}</span>
      </div>
      <div className="liga-cockpit-kpi-valor" style={{ color: c.valor }}>
        {fmtBrl.format(valor)}
      </div>
      {subtexto ? (
        <div className="liga-cockpit-kpi-sub" style={{ color: c.sub }}>
          {subtexto}
        </div>
      ) : null}
    </Tag>
  );
}
