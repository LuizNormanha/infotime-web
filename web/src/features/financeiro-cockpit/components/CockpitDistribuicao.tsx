"use client";

import type { ReactNode } from "react";
import { useTranslations } from "next-intl";

import "../liga-cockpit.css";

import type { CockpitDistribuicao } from "../types";

export function CockpitDistribuicao({ dados }: { dados: CockpitDistribuicao }) {
  const t = useTranslations("home.financeiroGestaoIntegrada");

  const cel = (
    valor: number,
    label: string,
    corNum: string,
  ): ReactNode => (
    <div className="liga-cockpit-dist-cel">
      <div className="liga-cockpit-dist-num" style={{ color: corNum }}>
        {valor}
      </div>
      <div className="liga-cockpit-dist-lab">{label}</div>
    </div>
  );

  return (
    <div className="liga-cockpit-dist-grid">
      {cel(dados.pendenteReceber, t("distPendenteReceber"), "#eab308")}
      {cel(dados.pendentePagar, t("distPendentePagar"), "#eab308")}
      {cel(dados.pagosRecebidosMes, t("distPagosMes"), "#22c55e")}
      {cel(dados.totalEmAtraso, t("distAtraso"), "#f87171")}
    </div>
  );
}
