import { DataTable } from "primereact/datatable";
import type { DataTableStateEvent } from "primereact/datatable";
import { Column } from "primereact/column";
import type { DataTablePageEvent } from "primereact/datatable";
import type { ListQuery } from "@infotime/shared-types";
import { useMemo } from "react";
import { LoadingState } from "../feedback/LoadingState.js";
import { EmptyState } from "../feedback/EmptyState.js";
import { ErrorState } from "../feedback/ErrorState.js";

/** Mesmo `paginatorTemplate` de `LigaListagemBase` (infolab-web). */
export const LIGA_LISTAGEM_PAGINATOR_TEMPLATE =
  "FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink RowsPerPageDropdown";

/** Equivalente a `listagem.comum.paginacaoIntervalo` (pt-BR) no infolab-web. */
export const LIGA_LISTAGEM_CURRENT_PAGE_REPORT_TEMPLATE = "{first} a {last} de {totalRecords}";

/** Mesmo default de `opcoesLinhasPorPagina` em `LigaListagemBase` (infolab-web). */
export const LIGA_LISTAGEM_LINHAS_POR_PAGINA_OPCOES: readonly number[] = [5, 10, 20, 50];

export type DataTableColumn<T extends Record<string, unknown>> = {
  field: keyof T & string;
  header: string;
  /** default: true — se `false`, coluna não entra no seletor e permanece sempre visível. */
  hideable?: boolean;
  /** default: true quando omitido */
  sortable?: boolean;
  /** Campo enviado em `sortField` na API (ex.: `cidade` para coluna `cidadeUf`). */
  sortKey?: string;
};

type Props<T extends Record<string, unknown>> = {
  rows: T[];
  total: number;
  loading: boolean;
  error: Error | null;
  query: ListQuery;
  onQueryChange: (q: Partial<ListQuery>) => void;
  columns: Array<DataTableColumn<T>>;
  /**
   * Campos `hideable` atualmente visíveis. Se omitido, todas as colunas ocultáveis aparecem.
   * Colunas com `hideable: false` ignoram este conjunto.
   */
  visibleColumnFields?: Set<string> | null;
  onRowDoubleClick?: (row: T) => void;
  /** Coluna de ação com ícone de editar (padrão infolab-web). */
  onEditRow?: (row: T) => void;
  /**
   * Campo enviado à API quando a ordenação é removida no UI (removableSort).
   * Ex.: `login` na lista de usuários, `razaoSocial` em clientes.
   */
  fallbackSortApiField?: string;
  /** Sobrescreve linhas por página (default: `LIGA_LISTAGEM_LINHAS_POR_PAGINA_OPCOES`). */
  rowsPerPageOptions?: number[];
};

function apiFieldToTableField<T extends Record<string, unknown>>(
  apiField: string | undefined,
  columns: Array<DataTableColumn<T>>,
): string | undefined {
  if (!apiField) return undefined;
  const bySortKey = columns.find((c) => c.sortKey === apiField);
  if (bySortKey) return bySortKey.field;
  return columns.some((c) => c.field === apiField) ? apiField : undefined;
}

function tableFieldToApiField<T extends Record<string, unknown>>(
  tableField: string,
  columns: Array<DataTableColumn<T>>,
): string {
  const col = columns.find((c) => c.field === tableField);
  return col?.sortKey ?? tableField;
}

export function DataTablePage<T extends Record<string, unknown>>(props: Props<T>) {
  const first = (props.query.page - 1) * props.query.pageSize;

  const displayColumns = useMemo(() => {
    const vis = props.visibleColumnFields;
    return props.columns.filter((c) => {
      if (c.hideable === false) return true;
      if (vis == null || vis.size === 0) return true;
      return vis.has(c.field);
    });
  }, [props.columns, props.visibleColumnFields]);

  const sortFieldUiRaw = apiFieldToTableField(props.query.sortField, displayColumns);
  const sortFieldUi = displayColumns.some((c) => c.field === sortFieldUiRaw)
    ? sortFieldUiRaw
    : apiFieldToTableField(props.fallbackSortApiField, displayColumns) ??
      displayColumns.find((c) => c.sortable !== false)?.field;

  const sortOrderNum =
    props.query.sortOrder === "desc" ? -1 : props.query.sortOrder === "asc" ? 1 : undefined;

  const onPage = (e: DataTablePageEvent) => {
    props.onQueryChange({
      page: (e.page ?? 0) + 1,
      pageSize: e.rows ?? props.query.pageSize,
    });
  };

  const onSort = (e: DataTableStateEvent) => {
    const order = e.sortOrder;
    const tf = e.sortField as string | undefined;
    if (order == null || order === 0 || !tf) {
      const fb =
        props.fallbackSortApiField ??
        displayColumns.find((c) => c.sortable !== false)?.sortKey ??
        displayColumns.find((c) => c.sortable !== false)?.field ??
        "razaoSocial";
      props.onQueryChange({
        sortField: typeof fb === "string" ? fb : String(fb),
        sortOrder: "asc",
        page: 1,
      });
      return;
    }
    const apiField = tableFieldToApiField(tf, displayColumns);
    props.onQueryChange({
      sortField: apiField,
      sortOrder: order === 1 ? "asc" : "desc",
      page: 1,
    });
  };

  if (props.loading && props.rows.length === 0) return <LoadingState />;
  if (props.error) return <ErrorState message={props.error.message} />;

  return (
    <div className="liga-listagem-moldura-tabela">
      <DataTable
        className="liga-listagem-grid p-datatable-striped"
        value={props.rows}
        lazy
        paginator
        paginatorPosition="bottom"
        paginatorTemplate={LIGA_LISTAGEM_PAGINATOR_TEMPLATE}
        currentPageReportTemplate={LIGA_LISTAGEM_CURRENT_PAGE_REPORT_TEMPLATE}
        rows={props.query.pageSize}
        totalRecords={props.total}
        first={first}
        onPage={onPage}
        rowsPerPageOptions={
          props.rowsPerPageOptions ?? [...LIGA_LISTAGEM_LINHAS_POR_PAGINA_OPCOES]
        }
        emptyMessage={<EmptyState />}
        stripedRows
        sortMode="single"
        removableSort
        sortField={sortFieldUi}
        sortOrder={sortOrderNum}
        onSort={onSort}
        onRowDoubleClick={
          props.onRowDoubleClick
            ? (e) => {
                if (e.data != null) props.onRowDoubleClick?.(e.data as T);
              }
            : undefined
        }
      >
        {props.onEditRow ? (
          <Column
            key="__liga-acoes-editar"
            header={<span className="liga-listagem-cabecalho-acoes-visivel">Ações</span>}
            body={(rowData: T) => (
              <div className="liga-listagem-acoes-linha">
                <button
                  type="button"
                  className="liga-listagem-acao-icone"
                  onClick={(e) => {
                    e.stopPropagation();
                    props.onEditRow?.(rowData);
                  }}
                  aria-label="Editar"
                  title="Editar"
                >
                  <i className="pi pi-pencil" aria-hidden />
                </button>
              </div>
            )}
            exportable={false}
            sortable={false}
            style={{ width: "min(3.55rem, 12vw)", textAlign: "center" }}
            headerClassName="liga-listagem-celula--nowrap"
            bodyClassName="liga-listagem-celula--nowrap"
          />
        ) : null}
        {displayColumns.map((c) => (
          <Column
            key={c.field}
            field={c.field}
            header={c.header}
            sortable={c.sortable !== false}
          />
        ))}
      </DataTable>
    </div>
  );
}
