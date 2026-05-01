import { useMemo, useState } from "react";
import { useQuery } from "@tanstack/react-query";
import type { ListQuery, ListResponse } from "@infotime/shared-types";
import { ListShell } from "../../shared/components/list/ListShell.js";
import { ListToolbar } from "../../shared/components/list/ListToolbar.js";
import { DataTablePage } from "../../shared/components/list/DataTablePage.js";
import { API_V1_PREFIX } from "../../shared/api/constants.js";
import { httpJson } from "../../shared/api/httpClient.js";

type ClienteRow = {
  idCliente: string;
  razaoSocial: string | null;
  nomeFantasia: string | null;
  cnpj: string | null;
  email: string | null;
};

export function ClienteListPage() {
  const [query, setQuery] = useState<ListQuery>({
    page: 1,
    pageSize: 20,
  });

  const qs = useMemo(() => {
    const p = new URLSearchParams();
    p.set("page", String(query.page));
    p.set("pageSize", String(query.pageSize));
    if (query.search) p.set("search", query.search);
    return p.toString();
  }, [query]);

  const q = useQuery({
    queryKey: ["clientes", "list", qs],
    queryFn: () => httpJson<ListResponse<ClienteRow>>(`${API_V1_PREFIX}/clientes?${qs}`),
  });

  const rows =
    q.data?.data.map((c) => ({
      ...c,
      idCliente: String(c.idCliente),
    })) ?? [];

  return (
    <ListShell title="Clientes" toolbar={<ListToolbar onRefresh={() => void q.refetch()} />}>
      <DataTablePage<ClienteRow>
        rows={rows}
        total={q.data?.total ?? 0}
        loading={q.isLoading}
        error={q.error instanceof Error ? q.error : null}
        query={query}
        onQueryChange={(partial) => setQuery((prev) => ({ ...prev, ...partial }))}
        columns={[
          { field: "razaoSocial", header: "Razão social" },
          { field: "nomeFantasia", header: "Nome fantasia" },
          { field: "cnpj", header: "CNPJ" },
          { field: "email", header: "E-mail" },
        ]}
      />
    </ListShell>
  );
}
