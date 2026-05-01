import { DataTable } from "primereact/datatable";
import { Column } from "primereact/column";
import type { DataTablePageEvent } from "primereact/datatable";
import type { ListQuery } from "@infotime/shared-types";
import { LoadingState } from "../feedback/LoadingState.js";
import { EmptyState } from "../feedback/EmptyState.js";
import { ErrorState } from "../feedback/ErrorState.js";

type Props<T extends Record<string, unknown>> = {
  rows: T[];
  total: number;
  loading: boolean;
  error: Error | null;
  query: ListQuery;
  onQueryChange: (q: Partial<ListQuery>) => void;
  columns: Array<{ field: keyof T & string; header: string }>;
};

export function DataTablePage<T extends Record<string, unknown>>(props: Props<T>) {
  const first = (props.query.page - 1) * props.query.pageSize;

  const onPage = (e: DataTablePageEvent) => {
    props.onQueryChange({
      page: (e.page ?? 0) + 1,
      pageSize: e.rows ?? props.query.pageSize,
    });
  };

  if (props.loading && props.rows.length === 0) return <LoadingState />;
  if (props.error) return <ErrorState message={props.error.message} />;

  return (
    <DataTable
      value={props.rows}
      lazy
      paginator
      rows={props.query.pageSize}
      totalRecords={props.total}
      first={first}
      onPage={onPage}
      rowsPerPageOptions={[10, 20, 50]}
      emptyMessage={<EmptyState />}
    >
      {props.columns.map((c) => (
        <Column key={c.field} field={c.field} header={c.header} sortable={false} />
      ))}
    </DataTable>
  );
}
