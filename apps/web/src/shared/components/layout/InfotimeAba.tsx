import type { MouseEvent as ReactMouseEvent } from "react";
import "./liga-aba.css";

type InfotimeAbaProps = {
  icone: string;
  titulo: string;
  ativa: boolean;
  fechavel: boolean;
  ariaFechar: string;
  aoAtivar: () => void;
  aoFechar: () => void;
  setRef?: (el: HTMLDivElement | null) => void;
};

export function InfotimeAba({
  icone,
  titulo,
  ativa,
  fechavel,
  ariaFechar,
  aoAtivar,
  aoFechar,
  setRef,
}: InfotimeAbaProps) {
  return (
    <div ref={setRef} className={`liga-aba ${ativa ? "ativa" : ""}`}>
      <button type="button" className="liga-aba-ativador" onClick={aoAtivar}>
        <i className={`pi ${icone} liga-aba-icone`} aria-hidden />
        <span className="liga-aba-titulo">{titulo}</span>
      </button>
      {fechavel ? (
        <button
          type="button"
          className="liga-aba-fechar"
          onClick={(e: ReactMouseEvent<HTMLButtonElement>) => {
            e.stopPropagation();
            aoFechar();
          }}
          aria-label={ariaFechar}
        >
          <i className="pi pi-times" aria-hidden />
        </button>
      ) : null}
    </div>
  );
}
