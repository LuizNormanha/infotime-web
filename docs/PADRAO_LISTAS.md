# Padrão de listas (DataTable)

## Objetivo

Uma única experiência de listagem: **PrimeReact DataTable**, **paginação e filtros no servidor**, **permissões** na toolbar e ações.

## Requisitos

- Paginação **server-side** (page / pageSize).
- Filtro global **server-side** com **debounce** (search).
- Ordenação **server-side** (sortField / sortOrder).
- Filtros avançados em **Dialog** ou **Sidebar**.
- Estados: **loading**, **empty**, **error** (componentes compartilhados).
- **Row actions** padronizadas (ver, editar, excluir conforme permissão).
- **Toolbar** compartilhada (exportar, novo, refresh, se aplicável).
- **Nada** de layout isolado por tela quando existir componente compartilhado (`ListShell`, `DataTablePage`, `ListToolbar`).

## Contrato de query (obrigatório)

```ts
export interface ListQuery {
  page: number;
  pageSize: number;
  search?: string;
  sortField?: string;
  sortOrder?: 'asc' | 'desc';
  filters?: Record<string, unknown>;
}

export interface ListResponse<T> {
  data: T[];
  total: number;
  page: number;
  pageSize: number;
}
```

## Backend

- Query params validados com Zod (`pagination.schema.ts`).
- Repository aplica `id_tenacidade` e permissões de escopo.

## Frontend

- TanStack Query com chave que inclui filtros e página.
- Colunas e ações condicionadas a `usePermission`.
