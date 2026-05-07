import { InputText } from "primereact/inputtext";

/**
 * Quick search no padrão visual Liga (infolab-web — moldura, ícones limpar + lupa).
 */
export function ListQuickSearch(props: {
  value: string;
  onChange: (value: string) => void;
  /** Dispara consulta com o valor atual (Enter, lupa ou após limpar). */
  onApply: () => void;
  placeholder?: string;
  "aria-label"?: string;
}) {
  const hasText = props.value.trim().length > 0;
  const label = props["aria-label"] ?? props.placeholder ?? "Pesquisar";

  const limpar = () => {
    props.onChange("");
    queueMicrotask(() => props.onApply());
  };

  return (
    <div className="liga-listagem-toolbar-grupo-pesquisa">
      <div className="liga-listagem-toolbar-busca-linha">
        <div className="liga-listagem-busca-wrap">
          <div
            className="liga-listagem-busca liga-listagem-busca-com-icones"
            role="search"
            onKeyDownCapture={(ev) => {
              const alvo = ev.target;
              if (!(alvo instanceof HTMLInputElement)) return;
              if (ev.key !== "Enter" && ev.key !== "NumpadEnter") return;
              ev.preventDefault();
              ev.stopPropagation();
              props.onApply();
            }}
          >
            <InputText
              value={props.value}
              onChange={(e) => props.onChange(e.target.value)}
              placeholder={props.placeholder}
              className="liga-listagem-busca-input"
              aria-label={label}
              title="Enter para aplicar a pesquisa"
            />
            <div className="liga-listagem-busca-acoes-direita">
              {hasText ? (
                <button
                  type="button"
                  className="liga-listagem-busca-botao-icone"
                  onClick={limpar}
                  aria-label="Limpar busca"
                >
                  <i className="pi pi-times" aria-hidden />
                </button>
              ) : null}
              <button
                type="button"
                className="liga-listagem-busca-botao-icone liga-listagem-busca-icone-lupa"
                onClick={() => props.onApply()}
                aria-label="Aplicar pesquisa"
                title="Aplicar pesquisa"
              >
                <i className="pi pi-search" aria-hidden />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
