import { useMemo, useState } from "react";
import { useQuery } from "@tanstack/react-query";
import type { ListQuery, ListResponse } from "@infotime/shared-types";
import { ListShell } from "../../shared/components/list/ListShell.js";
import { ListToolbar } from "../../shared/components/list/ListToolbar.js";
import {
  ListColumnSelector,
  getInitialVisibleFields,
} from "../../shared/components/list/ListColumnSelector.js";
import {
  DataTablePage,
  type DataTableColumn,
} from "../../shared/components/list/DataTablePage.js";
import { API_V1_PREFIX } from "../../shared/api/constants.js";
import { httpJson } from "../../shared/api/httpClient.js";

type UsuarioRow = {
  idUsuario: string;
  nome: string | null;
  login: string | null;
  email: string | null;
  ativo: string | null;
};

const COLUMN_DEFS: Array<DataTableColumn<UsuarioRow>> = [
  { field: "login", header: "Login", hideable: false, sortable: false },
  { field: "nome", header: "Nome", sortable: false },
  { field: "email", header: "E-mail", sortable: false },
  { field: "ativo", header: "Ativo", sortable: false },
];

export function UsuarioListPage() {
  const columnOptions = useMemo(
    () =>
      COLUMN_DEFS.map((c) => ({
        field: c.field,
        header: c.header,
        hideable: c.hideable,
      })),
    [],
  );

  const [visibleFields, setVisibleFields] = useState<string[]>(() =>
    getInitialVisibleFields(columnOptions, "usuarios"),
  );

  const visibleSet = useMemo(() => new Set(visibleFields), [visibleFields]);

  const [query, setQuery] = useState<ListQuery>({
    page: 1,
    pageSize: 10,
    search: "",
  });

  const qs = useMemo(() => {
    const p = new URLSearchParams();
    p.set("page", String(query.page));
    p.set("pageSize", String(query.pageSize));
    if (query.search) p.set("search", query.search);
    return p.toString();
  }, [query]);

  const q = useQuery({
    queryKey: ["usuarios", "list", qs],
    queryFn: () =>
      httpJson<ListResponse<UsuarioRow>>(`${API_V1_PREFIX}/usuarios?${qs}`),
  });

  const rows =
    q.data?.data.map((u) => ({
      ...u,
      idUsuario: String(u.idUsuario),
    })) ?? [];

  return (
    <ListShell
      title="Usuários"
      subtitle="Gestão de usuários do tenant."
      toolbar={<ListToolbar onRefresh={() => void q.refetch()} />}
    >
      <div className="liga-listagem-barra-ferramentas">
        <div className="liga-listagem-barra-metade-tela liga-listagem-barra-ferramentas--busca-e-novo">
          <ListColumnSelector
            columns={columnOptions}
            value={visibleFields}
            onChange={setVisibleFields}
            storageKey="usuarios"
          />
        </div>
      </div>

      <DataTablePage<UsuarioRow>
        rows={rows}
        total={q.data?.total ?? 0}
        loading={q.isLoading}
        error={q.error instanceof Error ? q.error : null}
        query={query}
        onQueryChange={(partial) => setQuery((prev) => ({ ...prev, ...partial }))}
        columns={COLUMN_DEFS}
        visibleColumnFields={visibleSet}
        fallbackSortApiField="login"
      />
    </ListShell>
  );
}
