import { useMemo } from "react";
import { MultiSelect } from "primereact/multiselect";

export type ListColumnOption = { field: string; header: string; hideable?: boolean };

const STORAGE_PREFIX = "infotime.list.columns.";

function readStoredFields(key: string, allowed: Set<string>): string[] | null {
  try {
    const raw = localStorage.getItem(STORAGE_PREFIX + key);
    if (!raw) return null;
    const arr = JSON.parse(raw) as unknown;
    if (!Array.isArray(arr)) return null;
    const next = arr.filter((x) => typeof x === "string" && allowed.has(x)) as string[];
    return next.length > 0 ? next : null;
  } catch {
    return null;
  }
}

export function writeStoredFields(key: string, fields: string[]) {
  try {
    localStorage.setItem(STORAGE_PREFIX + key, JSON.stringify(fields));
  } catch {
    /* ignore */
  }
}

/** Campos ocultáveis: default = todos visíveis; com `storageKey` restaura localStorage. */
export function getInitialVisibleFields(
  columns: ListColumnOption[],
  storageKey: string | undefined,
): string[] {
  const hideable = columns.filter((c) => c.hideable !== false).map((c) => c.field);
  const allowed = new Set(hideable);
  if (storageKey) {
    const stored = readStoredFields(storageKey, allowed);
    if (stored) return stored;
  }
  return hideable;
}

type Props = {
  columns: ListColumnOption[];
  value: string[];
  onChange: (visibleFields: string[]) => void;
  /** Persiste escolha em `localStorage` (ex.: `clientes`). */
  storageKey?: string;
};

/**
 * Seletor de colunas visíveis (padrão infolab-web: MultiSelect, chips, `liga-listagem-seletor-colunas`).
 */
export function ListColumnSelector(props: Props) {
  const { options, hideableList } = useMemo(() => {
    const h = props.columns.filter((c) => c.hideable !== false);
    return {
      options: h.map((c) => ({ label: c.header, value: c.field })),
      hideableList: h.map((c) => c.field),
    };
  }, [props.columns]);

  if (options.length === 0) return null;

  const onInternalChange = (raw: string[]) => {
    let next = raw;
    if (next.length === 0) {
      next = [...hideableList];
    }
    if (props.storageKey) {
      writeStoredFields(props.storageKey, next);
    }
    props.onChange(next);
  };

  return (
    <MultiSelect
      value={props.value}
      options={options}
      optionLabel="label"
      optionValue="value"
      onChange={(e) => onInternalChange((e.value as string[]) ?? [])}
      display="chip"
      maxSelectedLabels={1}
      selectedItemsLabel="{0} colunas"
      className="liga-listagem-seletor-colunas"
      placeholder="Colunas visíveis"
      filter={false}
      showSelectAll={false}
      appendTo={typeof document !== "undefined" ? document.body : undefined}
      aria-label="Colunas visíveis na listagem"
    />
  );
}
