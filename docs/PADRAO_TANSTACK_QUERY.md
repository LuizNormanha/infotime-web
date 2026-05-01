# Padrão TanStack Query

## Cliente

- Uma instância de `QueryClient` na raiz (`apps/web/src/app/queryClient.ts`).
- Defaults: `staleTime` moderado para listas (ex.: 30s), `retry` 1 para erros de rede.

## Convenções

- **Queries:** `useQuery` com chave estável incluindo tenant implícito (não enviar tenant na chave se vier só do token).
- **Mutations:** `useMutation` com `onSuccess` invalidando queries relacionadas (`queryClient.invalidateQueries`).
- **Listas:** chave do tipo `['entidade','list', listQuery]`.
- **Detalhe:** `['entidade','detail', id]`.

## Erros

- Interceptor HTTP central em `httpClient` mapeia `ApiErrorResponse` para exibição (toast + field errors no form).

## SSR

- Projeto atual é SPA; se futuro SSR, hidratar queries conforme doc TanStack.
