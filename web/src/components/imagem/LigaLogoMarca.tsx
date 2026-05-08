"use client";

import { useTranslations } from "next-intl";
import "./liga-logo-marca.css";

/** Marca InfoTIME no painel do menu (drawer): mesmo slogan da tela de login. */
export function LigaLogoMarca() {
  const t = useTranslations("login.infotimeMarca");

  return (
    <div className="liga-logo-marca" aria-label={t("tituloMenu")}>
      <span className="liga-logo-marca-titulo">{t("tituloMenu")}</span>
      <p className="liga-logo-marca-tagline">{t("tagline")}</p>
    </div>
  );
}
