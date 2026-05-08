"use client";

import Image from "next/image";
import { useTranslations } from "next-intl";
import "./liga-logo-liga-imagem.css";

import logoLiga from "@/app/(comum)/assets/logo-liga.png";

/** Logo Liga com imagem raster (`assets/logo-liga.png`; gerada a partir de `docs/logo_liga2.png`). */
export function LigaLogoLigaImagem() {
  const t = useTranslations("logoLiga");

  return (
    <div className="liga-logo-liga-imagem">
      <Image
        src={logoLiga}
        alt={`${t("titulo")} — ${t("taglineImagemAlt")}`}
        width={250}
        height={250}
        priority
        className="liga-logo-liga-imagem__img"
        sizes="(max-width: 720px) min(100vw - 3.5rem, 360px), min(100%, 16rem)"
      />
    </div>
  );
}
