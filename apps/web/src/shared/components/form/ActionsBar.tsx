import { Button } from "primereact/button";

type ActionsBarProps = {
  onSave?: () => void;
  onCancel?: () => void;
  onDelete?: () => void;
  saving?: boolean;
  deleting?: boolean;
  saveLabel?: string;
  savingLabel?: string;
  /**
   * `top` = faixa do cabeçalito do formulário Liga (infolab). `inline` = grupo simples (ex. dentro de `FormFooter`).
   */
  variant?: "top" | "inline";
};

/**
 * Ações no padrão Liga / infolab-web (`liga-formulario-cadastro-base.css`).
 */
export function ActionsBar(props: ActionsBarProps) {
  const savingLabel = props.savingLabel ?? "Salvando…";
  const saveLabel = props.saveLabel ?? "Salvar";
  const variant = props.variant ?? "inline";
  const groupClass = variant === "top" ? "liga-formulario-acoes-topo" : "flex align-items-center flex-wrap gap-2";

  return (
    <div className={groupClass}>
      {props.onCancel ? (
        <Button
          type="button"
          label="Cancelar"
          icon="pi pi-times"
          outlined
          className="liga-formulario-acoes-secundaria"
          onClick={props.onCancel}
          disabled={props.saving || props.deleting}
        />
      ) : null}
      {props.onSave ? (
        <Button
          type="button"
          label={props.saving ? savingLabel : saveLabel}
          icon="pi pi-check"
          className="liga-formulario-cadastro-botao-salvar"
          loading={props.saving}
          onClick={props.onSave}
          disabled={props.saving || props.deleting}
        />
      ) : null}
      {props.onDelete ? (
        <Button
          type="button"
          label="Excluir"
          icon="pi pi-trash"
          severity="danger"
          outlined
          className="liga-formulario-acoes-excluir"
          loading={props.deleting}
          onClick={props.onDelete}
          disabled={props.saving || props.deleting}
        />
      ) : null}
    </div>
  );
}
