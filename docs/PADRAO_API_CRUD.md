# Padrão de API CRUD (Fastify)

## Camadas

```text
routes -> controller -> service -> repository -> prisma
```

- **Rotas:** registro de plugins, prefixos, somente ligação HTTP.
- **Controllers:** parse de request, chamada ao service, status HTTP, sem regra de negócio.
- **Services:** regras de negócio, orquestração, validação de invariantes.
- **Repositories:** queries Prisma, sempre com escopo de tenant.
- **Schemas Zod:** body, query e params de entrada.

## Multi-tenant

- Toda operação de leitura/escrita em dados de negócio usa `id_tenacidade` do contexto autenticado (não do cliente).

## Endpoints padrão

```text
GET    /api/[entidades]
GET    /api/[entidades]/:id
POST   /api/[entidades]
PUT    /api/[entidades]/:id
DELETE /api/[entidades]/:id
```

(use plural kebab-case consistente com nome do módulo; pluralização em português conforme convenção do projeto, ex.: `/api/usuarios`.)

## Listagens

- Sempre paginadas server-side (ver [`PADRAO_LISTAS.md`](PADRAO_LISTAS.md)).

## Erros

Resposta JSON padronizada:

```ts
interface ApiErrorResponse {
  code: string;
  message: string;
  fieldErrors?: Array<{ field: string; message: string }>;
}
```

- Códigos estáveis (`VALIDATION_ERROR`, `NOT_FOUND`, `FORBIDDEN`, `CONFLICT`, etc.).

## Auditoria

- Toda mutação relevante dispara preenchimento de auditoria (ver [`PADRAO_TENANCY_AUDITORIA.md`](PADRAO_TENANCY_AUDITORIA.md)).
