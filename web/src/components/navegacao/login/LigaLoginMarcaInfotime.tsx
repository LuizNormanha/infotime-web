"use client";

import { useTranslations } from "next-intl";
import "./liga-login-marca-infotime.css";

/** Marca InfoTIME na tela de login (texto ampliado + tagline, sem ícone). */
export function LigaLoginMarcaInfotime() {
  const t = useTranslations("login.infotimeMarca");

  return (
    <div className="liga-login-marca-infotime" aria-label={t("titulo")}>
      <span className="liga-login-marca-infotime-titulo">{t("titulo")}</span>
      <span className="liga-login-marca-infotime-tagline">{t("tagline")}</span>
    </div>
  );
}
