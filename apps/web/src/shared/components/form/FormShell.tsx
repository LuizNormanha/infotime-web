import type { ReactNode } from "react";

export type FormShellProps = {
  title: string;
  subtitle?: ReactNode;
  /** Erros ou alertas globais (acima do corpo). */
  globalError?: ReactNode;
  children: ReactNode;
  /**
   * Rodapé fixo do formulário: use `FormFooter` + `ActionsBar` (ações à direita, metadados à esquerda).
   */
  footer?: ReactNode;
};

export function FormShell(props: FormShellProps) {
  return (
    <section className="surface-card border-round shadow-1 overflow-hidden">
      <header className="p-4 pb-3">
        <h2 className="mt-0 mb-0">{props.title}</h2>
        {props.subtitle ? (
          <p className="text-color-secondary mt-2 mb-0">{props.subtitle}</p>
        ) : null}
        {props.globalError ? <div className="mt-3">{props.globalError}</div> : null}
      </header>

      <div className="px-4 pb-4 flex flex-column gap-3">{props.children}</div>

      {props.footer ? (
        <footer className="border-top-1 surface-border surface-section p-4">{props.footer}</footer>
      ) : null}
    </section>
  );
}
