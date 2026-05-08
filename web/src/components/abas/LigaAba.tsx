"use client";

import type { MouseEvent } from "react";
import "./liga-aba.css";

type LigaAbaProps = {
  icone: string;
  titulo: string;
  ativa: boolean;
  fechavel: boolean;
  ariaFechar: string;
  aoAtivar: () => void;
  aoFechar: () => void;
  aoMenuContexto?: (evento: MouseEvent<HTMLDivElement>) => void;
  setRef?: (el: HTMLDivElement | null) => void;
};

export function LigaAba({
  icone,
  titulo,
  ativa,
  fechavel,
  ariaFechar,
  aoAtivar,
  aoFechar,
  aoMenuContexto,
  setRef,
}: LigaAbaProps) {
  return (
    <div
      ref={setRef}
      className={`liga-aba ${ativa ? "ativa" : ""}`}
      onContextMenu={aoMenuContexto}
    >
      <button type="button" className="liga-aba-ativador" onClick={aoAtivar}>
        <i className={`pi ${icone} liga-aba-icone`} aria-hidden={true} />
        <span className="liga-aba-titulo">{titulo}</span>
      </button>
      {fechavel ? (
        <button
          type="button"
          className="liga-aba-fechar"
          onClick={aoFechar}
          aria-label={ariaFechar}
        >
          <i className="pi pi-times" aria-hidden="true" />
        </button>
      ) : null}
    </div>
  );
}
