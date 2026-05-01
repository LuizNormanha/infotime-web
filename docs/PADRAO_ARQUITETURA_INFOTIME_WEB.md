# Padrão de arquitetura — Infotime Web

Monorepo **pnpm**, API **REST**, frontend **SPA** React.

## Estrutura de pastas (alvo)

```text
apps/
  web/
    src/
      app/
      pages/
      features/
        [entidade]/
          api/
          components/
          hooks/
          schemas/
          types.ts
      shared/
        components/
          list/
          form/
            FormShell.tsx
            FormFooter.tsx
            ActionsBar.tsx
          fields/
          layout/
          feedback/
        hooks/
        api/
        auth/
        utils/

  api/
    src/
      app.ts
      server.ts
      modules/
        [entidade]/
          [entidade].routes.ts
          [entidade].controller.ts
          [entidade].service.ts
          [entidade].repository.ts
          [entidade].schema.ts
      shared/
        prisma/
        auth/
        errors/
        pagination/
        tenancy/
        audit/
        validation/
        storage/

packages/
  database/
    prisma/
      schema.prisma
      migrations/
      seed.ts
    src/
      index.ts

  shared-types/
    src/
      index.ts
      pagination.ts
      auth.ts
```

## Stack

- **Web:** React, TypeScript, PrimeReact, React Hook Form, Zod, TanStack Query.
- **API:** Node.js, TypeScript, Fastify, Zod, Prisma.
- **Banco:** PostgreSQL, base `liga_infotime`, tabelas no schema `public`.

## Integração entre pacotes

- `apps/api` importa `@infotime/database` (Prisma client) e `@infotime/shared-types`.
- `apps/web` importa `@infotime/shared-types` para DTOs de listagem e erros comuns.
