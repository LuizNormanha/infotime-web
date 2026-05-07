import type { ReactNode } from "react";

export function ListShell(props: {
  title: string;
  subtitle?: ReactNode;
  /** Ações no cabeçalho (direita), p.ex. ListToolbar. */
  toolbar?: ReactNode;
  children: ReactNode;
}) {
  return (
    <section className="liga-listagem-base">
      <header className="liga-listagem-pagina-cabecalho">
        <div className="liga-listagem-titulo-linha">
          <div className="liga-listagem-titulo-esquerda">
            <span className="liga-listagem-barra-verde" aria-hidden />
            <h1 className="liga-listagem-titulo-principal">{props.title}</h1>
          </div>
          {props.toolbar ? <div className="liga-listagem-titulo-acoes">{props.toolbar}</div> : null}
        </div>
        {props.subtitle ? (
          <p className="liga-listagem-subtitulo">{props.subtitle}</p>
        ) : null}
      </header>
      {props.children}
    </section>
  );
}
