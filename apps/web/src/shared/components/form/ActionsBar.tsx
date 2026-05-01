import { Button } from "primereact/button";

export function ActionsBar(props: {
  onSave?: () => void;
  onCancel?: () => void;
  onDelete?: () => void;
  saving?: boolean;
}) {
  return (
    <div className="flex gap-2">
      {props.onSave ? (
        <Button label="Salvar" icon="pi pi-check" loading={props.saving} onClick={props.onSave} />
      ) : null}
      {props.onCancel ? <Button label="Cancelar" severity="secondary" text onClick={props.onCancel} /> : null}
      {props.onDelete ? <Button label="Excluir" severity="danger" outlined onClick={props.onDelete} /> : null}
    </div>
  );
}
