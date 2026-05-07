import { useEffect, useMemo, useState } from "react";
import { useNavigate } from "react-router-dom";
import { useQuery } from "@tanstack/react-query";
import { Button } from "primereact/button";
import type { ListQuery, ListResponse } from "@infotime/shared-types";
import { ListShell } from "../../shared/components/list/ListShell.js";
import { ListToolbar } from "../../shared/components/list/ListToolbar.js";
import { ListQuickSearch } from "../../shared/components/list/ListQuickSearch.js";
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

type ClienteRow = {
  idCliente: string;
  razaoSocial: string | null;
  nomeFantasia: string | null;
  cnpj: string | null;
  email: string | null;
  cidade: string | null;
  estado: string | null;
  cidadeUf: string;
};

const COLUMN_DEFS: Array<DataTableColumn<ClienteRow>> = [
  { field: "razaoSocial", header: "Razão social" },
  { field: "nomeFantasia", header: "Nome fantasia" },
  { field: "cnpj", header: "CNPJ / CPF" },
  { field: "cidadeUf", header: "Cidade / UF", sortKey: "cidade" },
  { field: "email", header: "E-mail" },
];

export function ClienteListPage() {
  const navigate = useNavigate();
  const [searchDraft, setSearchDraft] = useState("");

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
    getInitialVisibleFields(columnOptions, "clientes-v2"),
  );

  const [query, setQuery] = useState<ListQuery>({
    page: 1,
    pageSize: 10,
    search: "",
    sortField: "razaoSocial",
    sortOrder: "asc",
  });

  useEffect(() => {
    const t = window.setTimeout(() => {
      setQuery((q) => ({
        ...q,
        page: 1,
        search: searchDraft.trim() || undefined,
      }));
    }, 300);
    return () => window.clearTimeout(t);
  }, [searchDraft]);

  useEffect(() => {
    setQuery((prev) => {
      const display = COLUMN_DEFS.filter(
        (c) => c.hideable === false || visibleFields.includes(c.field),
      );
      const sf = prev.sortField;
      if (!sf) return prev;
      const ok = display.some((c) => (c.sortKey ?? c.field) === sf);
      if (!ok) {
        return { ...prev, sortField: "razaoSocial", sortOrder: "asc", page: 1 };
      }
      return prev;
    });
  }, [visibleFields]);

  const qs = useMemo(() => {
    const p = new URLSearchParams();
    p.set("page", String(query.page));
    p.set("pageSize", String(query.pageSize));
    if (query.search) p.set("search", query.search);
    if (query.sortField) p.set("sortField", query.sortField);
    if (query.sortOrder) p.set("sortOrder", query.sortOrder);
    return p.toString();
  }, [query]);

  const aplicarBusca = () => {
    setQuery((q) => ({
      ...q,
      page: 1,
      search: searchDraft.trim() || undefined,
    }));
  };

  const q = useQuery({
    queryKey: ["clientes", "list", qs],
    queryFn: () => httpJson<ListResponse<ClienteRow>>(`${API_V1_PREFIX}/clientes?${qs}`),
  });

  const rows: ClienteRow[] = useMemo(
    () =>
      q.data?.data.map((c) => ({
        ...c,
        idCliente: String(c.idCliente),
        cidadeUf: [c.cidade, c.estado].filter(Boolean).join(" / ") || "—",
      })) ?? [],
    [q.data],
  );

  const visibleSet = useMemo(() => new Set(visibleFields), [visibleFields]);

  return (
    <ListShell
      title="Clientes"
      subtitle="Cadastro de clientes — duplo clique em uma linha para editar."
      toolbar={
        <ListToolbar
          onRefresh={() => void q.refetch()}
          extra={
            <Button
              type="button"
              label="Novo"
              icon="pi pi-plus"
              className="liga-listagem-botao-novo"
              onClick={() => navigate("/clientes/novo")}
            />
          }
        />
      }
    >
      <div className="liga-listagem-barra-ferramentas">
        <div className="liga-listagem-barra-metade-tela liga-listagem-barra-ferramentas--busca-e-novo">
          <ListQuickSearch
            value={searchDraft}
            onChange={setSearchDraft}
            onApply={aplicarBusca}
            placeholder="Pesquisar por razão social, fantasia, CNPJ ou e-mail…"
            aria-label="Pesquisa rápida em clientes"
          />
          <ListColumnSelector
            columns={columnOptions}
            value={visibleFields}
            onChange={setVisibleFields}
            storageKey="clientes-v2"
          />
        </div>
      </div>

      <DataTablePage<ClienteRow>
        rows={rows}
        total={q.data?.total ?? 0}
        loading={q.isLoading}
        error={q.error instanceof Error ? q.error : null}
        query={query}
        onQueryChange={(partial) => setQuery((prev) => ({ ...prev, ...partial }))}
        columns={COLUMN_DEFS}
        visibleColumnFields={visibleSet}
        onRowDoubleClick={(row) => navigate(`/clientes/${row.idCliente}`)}
        onEditRow={(row) => navigate(`/clientes/${row.idCliente}`)}
        fallbackSortApiField="razaoSocial"
      />
    </ListShell>
  );
}
