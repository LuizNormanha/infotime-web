"use client";

import type { CSSProperties, MouseEvent } from "react";
import "./liga-menu-item.css";

export type LigaMenuItemProps = {
  id: string;
  rotulo: string;
  icone?: string;
  profundidade?: number;
  possuiFilhos?: boolean;
  aberto?: boolean;
  ativo?: boolean;
  colapsado?: boolean;
  aoClicar: (evento: MouseEvent<HTMLButtonElement>) => void;
};

export function LigaMenuItem({
  id,
  rotulo,
  icone,
  profundidade = 0,
  possuiFilhos = false,
  aberto = false,
  ativo = false,
  colapsado = false,
  aoClicar,
}: LigaMenuItemProps) {
  const classes = [
    "liga-menu-item",
    ativo ? "ativo" : "",
    aberto ? "aberto" : "",
    colapsado ? "colapsado" : "",
  ]
    .filter(Boolean)
    .join(" ");

  return (
    <button
      type="button"
      id={`liga-menu-item-${id}`}
      className={classes}
      onClick={aoClicar}
      style={{ "--liga-menu-profundidade": profundidade } as CSSProperties}
      aria-expanded={possuiFilhos ? aberto : undefined}
    >
      {icone ? <i className={`pi ${icone}`} aria-hidden="true" /> : null}
      <span className="liga-menu-item-rotulo">{rotulo}</span>
      {possuiFilhos && !colapsado ? (
        <i
          className={`pi ${aberto ? "pi-chevron-up" : "pi-chevron-down"}`}
          aria-hidden="true"
        />
      ) : null}
    </button>
  );
}
