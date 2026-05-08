"use client";

import "./liga-botao-flutuante.css";

type LigaBotaoFlutuanteProps = {
  aoClicar: () => void;
  /** Texto para leitores de tela (ex.: chave i18n resolvida no pai). */
  rotuloAcessibilidade: string;
  className?: string;
};

/** Rosto estilizado de robô para a IA LIGIA (SVG, usa `currentColor` do botão). */
function IconeRostoRoboLIGIA() {
  return (
    <svg
      className="liga-botao-flutuante-rosto"
      viewBox="0 0 32 32"
      aria-hidden={true}
      focusable={false}
    >
      <line
        x1="16"
        y1="5"
        x2="16"
        y2="8.5"
        stroke="currentColor"
        strokeWidth="1.75"
        strokeLinecap="round"
      />
      <circle cx="16" cy="3.25" r="1.85" fill="currentColor" />
      <rect
        x="5.5"
        y="9"
        width="21"
        height="18.5"
        rx="6"
        stroke="currentColor"
        strokeWidth="1.65"
        fill="none"
      />
      <circle cx="12" cy="16.25" r="2.35" fill="currentColor" />
      <circle cx="20" cy="16.25" r="2.35" fill="currentColor" />
      <path
        d="M11.5 22.75c1.15 1.45 3 2.35 4.5 2.35s3.35-.9 4.5-2.35"
        stroke="currentColor"
        strokeWidth="1.55"
        strokeLinecap="round"
        fill="none"
      />
    </svg>
  );
}

/**
 * Botão circular fixo no canto inferior direito: um clique dispara a ação (ex.: painel de ajuda LIGIA).
 */
export function LigaBotaoFlutuante({
  aoClicar,
  rotuloAcessibilidade,
  className,
}: LigaBotaoFlutuanteProps) {
  return (
    <button
      type="button"
      className={["liga-botao-flutuante", className].filter(Boolean).join(" ")}
      onClick={aoClicar}
      aria-label={rotuloAcessibilidade}
    >
      <IconeRostoRoboLIGIA />
    </button>
  );
}
