import { useMemo, useState } from "react";
import { useQuery } from "@tanstack/react-query";
import type { ListQuery, ListResponse } from "@infotime/shared-types";
import { ListShell } from "../../shared/components/list/ListShell.js";
import { ListToolbar } from "../../shared/components/list/ListToolbar.js";
import { DataTablePage } from "../../shared/components/list/DataTablePage.js";
import { API_V1_PREFIX } from "../../shared/api/constants.js";
import { httpJson } from "../../shared/api/httpClient.js";

type UsuarioRow = {
  idUsuario: string;
  nome: string | null;
  login: string | null;
  email: string | null;
  ativo: string | null;
};

export function UsuarioListPage() {
  const [query, setQuery] = useState<ListQuery>({
    page: 1,
    pageSize: 20,
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
      toolbar={<ListToolbar onRefresh={() => void q.refetch()} />}
    >
      <DataTablePage<UsuarioRow>
        rows={rows}
        total={q.data?.total ?? 0}
        loading={q.isLoading}
        error={q.error instanceof Error ? q.error : null}
        query={query}
        onQueryChange={(partial) => setQuery((prev) => ({ ...prev, ...partial }))}
        columns={[
          { field: "login", header: "Login" },
          { field: "nome", header: "Nome" },
          { field: "email", header: "E-mail" },
          { field: "ativo", header: "Ativo" },
        ]}
      />
    </ListShell>
  );
}
