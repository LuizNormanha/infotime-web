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

  api-nest/
    src/
      app.module.ts
      main.ts
      modules/
        [entidade]/
          [entidade].module.ts
          [entidade].controller.ts
          [entidade].service.ts
          [entidade].repository.ts
          dto/
      shared/
        prisma/
        config/
        guards/
        interceptors/
        pipes/
        filters/

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
- **API:** Node.js, TypeScript, NestJS 11 + FastifyAdapter, Passport/JWT, Zod, Prisma.
- **Banco:** PostgreSQL, base `liga_infotime`, tabelas no schema `public`.

## Integração entre pacotes

- `apps/api-nest` importa `@infotime/database` (Prisma client) e `@infotime/shared-types`.
- `apps/web` importa `@infotime/shared-types` para DTOs de listagem e erros comuns.
