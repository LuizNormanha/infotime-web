import type { ReactNode } from "react";

/**
 * Layout padrão do rodapé do formulário: conteúdo auxiliar (`start`) e ações (`end`, ex. ActionsBar).
 */
export function FormFooter(props: { start?: ReactNode; end?: ReactNode }) {
  return (
    <div className="flex align-items-center justify-content-between flex-wrap gap-3 w-full">
      <div className="flex align-items-center gap-2 flex-wrap text-sm text-color-secondary">
        {props.start}
      </div>
      <div className="flex align-items-center gap-2 flex-wrap">{props.end}</div>
    </div>
  );
}
