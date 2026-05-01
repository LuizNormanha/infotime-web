# Prompts operacionais (Cursor)

## Analisar uma entidade (sem código)

```text
Analise a entidade [entidade] do Infotime.
Não gere código funcional ainda.
Use as evidências em:
- migration-source/infotime-migration/[entidade]/screenshots
- migration-source/infotime-migration/[entidade]/database
- migration-source/infotime-migration/[entidade]/scriptcase
- migration-source/infotime-migration/[entidade]/specs

Gere ou atualize:
- specs/[entidade]/README.md
- specs/[entidade]/telas.md
- specs/[entidade]/modelo-dados.md
- specs/[entidade]/regras-scriptcase.md
- specs/[entidade]/mapa-campos.md
- specs/[entidade]/api.md
- specs/[entidade]/frontend.md
- specs/[entidade]/permissoes.md
- specs/[entidade]/checklist.md
- specs/[entidade]/duvidas-abertas.md

Cruze screenshot + TLL + Scriptcase + specs.
Marque incertezas explicitamente.
Não invente campos.
Não gere backend ou frontend ainda.
```

## Gerar backend de uma entidade

```text
Implemente o backend da entidade [entidade] com NestJS, Prisma, PostgreSQL e Zod (padrão do monorepo em apps/api-nest).

Use:
- specs/[entidade]/README.md
- specs/[entidade]/modelo-dados.md
- specs/[entidade]/regras-scriptcase.md
- specs/[entidade]/api.md
- docs/PADRAO_API_CRUD.md
- docs/PADRAO_PRISMA.md
- docs/PADRAO_TENANCY_AUDITORIA.md
- docs/PADRAO_AUTH_RBAC.md

Regras:
- regras de negócio ficam no service;
- acesso a banco fica no repository;
- validação com DTOs Zod / pipes;
- controllers finos — sem lógica de negócio;
- usar paginação server-side;
- aplicar tenant em todas as consultas;
- aplicar auditoria em insert/update/delete lógico;
- não inventar campos.

Gere ou atualize:
- apps/api-nest/src/modules/[entidade]/[entidade].module.ts
- apps/api-nest/src/modules/[entidade]/[entidade].controller.ts
- apps/api-nest/src/modules/[entidade]/[entidade].service.ts
- apps/api-nest/src/modules/[entidade]/[entidade].repository.ts
- apps/api-nest/src/modules/[entidade]/dto/*.ts
- testes básicos das regras críticas
```

## Gerar frontend de uma entidade

```text
Implemente o frontend da entidade [entidade] com React, TypeScript, PrimeReact, React Hook Form, Zod e TanStack Query.

Use:
- specs/[entidade]/README.md
- specs/[entidade]/telas.md
- specs/[entidade]/modelo-dados.md
- specs/[entidade]/regras-scriptcase.md
- specs/[entidade]/frontend.md
- docs/PADRAO_LISTAS.md
- docs/PADRAO_FORMULARIOS.md
- docs/PADRAO_TANSTACK_QUERY.md
- docs/PADRAO_AUTH_RBAC.md

Regras:
- usar componentes compartilhados de lista e formulário;
- não criar layout isolado;
- usar PrimeReact DataTable para lista;
- validação com Zod;
- React Hook Form no formulário;
- queries e mutations com TanStack Query;
- aplicar permissões na UI;
- manter consistência visual com screenshots;
- não inventar campos.

Gere ou atualize:
- apps/web/src/pages/[entidade]/[Entidade]ListPage.tsx
- apps/web/src/pages/[entidade]/[Entidade]FormPage.tsx
- apps/web/src/features/[entidade]/api/[entidade]Api.ts
- apps/web/src/features/[entidade]/components/[Entidade]Form.tsx
- apps/web/src/features/[entidade]/hooks/use[Entidade]List.ts
- apps/web/src/features/[entidade]/hooks/use[Entidade]Mutations.ts
- apps/web/src/features/[entidade]/schemas/[entidade]Schema.ts
- apps/web/src/features/[entidade]/types.ts
```
