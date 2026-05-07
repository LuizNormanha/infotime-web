import { Button } from "primereact/button";
import type { ReactNode } from "react";

/**
 * Ações do canto superior direito da listagem (infolab-web).
 * Ordem: **Atualizar** (estilo Exportar / outlined) → conteúdo extra (ex.: **Novo** em verde).
 */
export function ListToolbar(props: { onRefresh?: () => void; extra?: ReactNode }) {
  return (
    <>
      {props.onRefresh ? (
        <Button
          type="button"
          icon="pi pi-refresh"
          label="Atualizar"
          outlined
          className="liga-listagem-botao-export-dropdown"
          onClick={props.onRefresh}
          aria-label="Atualizar listagem"
          title="Recarregar dados da listagem"
        />
      ) : null}
      {props.extra}
    </>
  );
}
