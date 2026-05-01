import { Button } from "primereact/button";
import type { ReactNode } from "react";

export function ListToolbar(props: {
  onRefresh?: () => void;
  extra?: ReactNode;
}) {
  return (
    <div className="flex gap-2">
      {props.extra}
      {props.onRefresh ? (
        <Button type="button" icon="pi pi-refresh" rounded text onClick={props.onRefresh} aria-label="Atualizar" />
      ) : null}
    </div>
  );
}
