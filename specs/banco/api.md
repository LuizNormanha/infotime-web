# API — banco

## Endpoints alvo (REST)

Conforme [`docs/PADRAO_API_CRUD.md`](../../docs/PADRAO_API_CRUD.md):

```text
GET    /api/banco   # ajustar pluralização real na implementação
GET    /api/.../:id
POST   /api/...
PUT    /api/.../:id
DELETE /api/.../:id
```

## Query de lista

- `ListQuery` / `ListResponse` padrão.

## Schemas Zod

- Body e query em `apps/api/src/modules/banco/` *(path kebab a definir na implementação)*.

## Tenancy e auditoria

- Todas as operações com `id_tenacidade` do contexto.
- Auditoria em mutações conforme [`docs/PADRAO_TENANCY_AUDITORIA.md`](../../docs/PADRAO_TENANCY_AUDITORIA.md).

## Erros

- `ApiErrorResponse` padronizado.
