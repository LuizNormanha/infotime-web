"use client";

import { Button } from "primereact/button";
import { useTranslations } from "next-intl";
import "./liga-alternar-tema.css";

import { useTemaLiga } from "../../navegacao/home/LigaProvedorApp";

export function LigaAlternarTema() {
  const t = useTranslations("login.tema");
  const { tema, alternarTema } = useTemaLiga();

  return (
    <Button
      type="button"
      text
      className="liga-alternar-tema"
      onClick={alternarTema}
      icon={`pi ${tema === "light" ? "pi-moon" : "pi-sun"}`}
      label={tema === "light" ? t("alternarParaEscuro") : t("alternarParaClaro")}
      aria-label={
        tema === "light" ? t("alternarParaEscuro") : t("alternarParaClaro")
      }
    />
  );
}
