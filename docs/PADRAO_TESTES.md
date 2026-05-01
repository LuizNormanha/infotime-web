# Padrão de testes

## Pirâmide

- **Unitário:** services e validadores Zod (puro) com casos limite.
- **Integração:** API + Prisma com banco de teste (Docker ou SQLite se viável; preferência PostgreSQL espelhando produção).
- **E2E (opcional fase inicial):** Playwright para fluxos críticos (login, listagem, salvar).

## API

- Fastify inject ou supertest; subir app com `DATABASE_URL` de teste.
- Fixtures mínimas por tenant.

## Web

- Testing Library para componentes isolados; mocks de TanStack Query.

## Migração legado

- Para regras financeiras críticas, testes com **vetores** (valores de entrada/saída) documentados na spec.

## CI

- `pnpm test` na raiz deve rodar pacotes configurados; falha bloqueia merge.
