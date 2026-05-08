"use client";

import "./liga-logo-infotime.css";

/** Marca InfoTIME (ícone de erlenmeyer + texto), como no topo do cartão de login. */
export function LigaLogoInfotime() {
  return (
    <div className="liga-logo-infotime" aria-label="InfoTIME">
      <svg
        className="liga-logo-infotime-icone"
        viewBox="0 0 32 36"
        width={28}
        height={32}
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden
      >
        <path
          fill="var(--liga-verde)"
          d="M11 1h10v5l9 24.5a3 3 0 01-2.8 3.5H6.8A3 3 0 014 30.5L13 6V1z"
        />
      </svg>
      <span className="liga-logo-infotime-texto">InfoTIME</span>
    </div>
  );
}
