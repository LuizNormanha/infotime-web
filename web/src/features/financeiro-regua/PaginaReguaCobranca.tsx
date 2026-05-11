"use client";

import { useTranslations } from "next-intl";
import { Card } from "primereact/card";
import { Message } from "primereact/message";

/**
 * Régua de cobrança — rota `/financeiro/cobranca/regua`.
 * Placeholder até integração com API de régua / filas de cobrança.
 */
export function PaginaReguaCobranca() {
  const t = useTranslations("home.financeiroReguaCobranca");

  return (
    <div className="p-3">
      <Card title={t("titulo")}>
        <Message severity="info" text={t("descricao")} className="w-full" />
      </Card>
    </div>
  );
}
