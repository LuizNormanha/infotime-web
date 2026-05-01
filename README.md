# Infotime Web

Código-fonte no GitHub: **[github.com/LuizNormanha/infotime-web](https://github.com/LuizNormanha/infotime-web)**.

## Visão geral

**Infotime Web** é o monorepo da modernização do ecossistema **Infotime / RP Financeiro**: uma SPA em **React** consome uma API REST em **NestJS** (adaptador **Fastify**), com persistência em **PostgreSQL** via **Prisma**, no padrão de workspaces **pnpm**. O trabalho é guiado por documentação e especificações extraídas do sistema legado, para reprodutibilidade e paridade gradual de funcionalidades.

## Origem

O projeto surge da necessidade de **substituir de forma incremental** o sistema legado construído em **Scriptcase e PHP**, mantendo regras de negócio e continuidade operacional. O repositório referencia o **corpus de migração** (`migration-input/`, `migration-source/`, `docs/`, `specs/`), alinhado a pacotes como `infotime-migration_v3.zip` e aos padrões descritos em `docs/PADRAO_*`.

## Stack tecnológica

| Camada | Tecnologias |
|--------|-------------|
| Monorepo | **pnpm** workspaces |
| Frontend | **React 18**, **TypeScript**, **Vite**, **PrimeReact** / PrimeFlex / PrimeIcons, **React Router**, **TanStack Query**, **React Hook Form**, **Zod** |
| API | **NestJS** com **@nestjs/platform-fastify**, **Passport/JWT**, **Zod**, módulos por domínio (auth, usuários, clientes, grupos, aplicações, health) — único backend em [`apps/api-nest`](apps/api-nest) |
| Dados | **PostgreSQL** (base `liga_infotime`), **Prisma** no pacote `@infotime/database`, pacote `@infotime/shared-types` |
| Infra prevista | **Redis** (filas **BullMQ**), **S3/MinIO** para uploads — conforme `.env.example` |
| Qualidade | **Vitest** na API, **ESLint**, script **`pnpm verify`** (alinhado ao CI) |

## Evoluções planejadas

- Avançar a **migração funcional** a partir do corpus e de `specs/`, cobrindo módulos e telas ainda não portados do legado.
- Consolidar **multi-tenant**, **papéis**, **auditoria** e consistência da API em todos os fluxos.
- Colocar em produção gradual **filas (BullMQ)** e **armazenamento de objetos** quando os fluxos exigirem.
- Ampliar **testes automatizados** (API e, no tempo, frontend) e observabilidade.
- Manter **documentação de arquitetura** e padrões atualizados à medida que novos domínios entram no monorepo.

## Estrutura principal

- **API (única):** [`apps/api-nest`](apps/api-nest) (`@infotime/api`) — prefixo global **`/api/v1`**.
- **Histórico da stack Fastify v1 (somente referência):** [`docs/historico/api-fastify-v1/`](docs/historico/api-fastify-v1/) — código arquivado, não usar em desenvolvimento.

## Documentação

- Entrada do corpus: [`docs/ENTRADA_MIGRACAO.md`](docs/ENTRADA_MIGRACAO.md)
- Padrões do projeto: [`docs/PADRAO_MIGRACAO_INFOTIME.md`](docs/PADRAO_MIGRACAO_INFOTIME.md) e demais `docs/PADRAO_*`
- Inventário das fontes: [`docs/fontes/`](docs/fontes/)
- Especificações por entidade: [`specs/`](specs/)

## Pré-requisitos

- Node.js 20+
- pnpm 9+
- PostgreSQL 15+ — base **`liga_infotime`** já existente; tabelas da app em **`public`** (via `DATABASE_URL` com `?schema=public`).

## Instalação

```bash
pnpm install
```

## Variáveis de ambiente

Copie [`.env.example`](.env.example) para `.env` na raiz e por app se necessário.

| Variável | Descrição |
|----------|-----------|
| `DATABASE_URL` | Base **`liga_infotime`** + **`?schema=public`** (tabelas no schema padrão PostgreSQL). |
| `JWT_SECRET` | Segredo para assinatura de JWT. |
| `JWT_REFRESH_SECRET` | Segredo para refresh token (mín. 16 caracteres — exigido pelo Nest). |
| `CORS_ORIGINS` | Lista separada por vírgulas (Nest); padrão `http://localhost:5173`. |
| `REDIS_URL` | Redis (fila BullMQ / uso futuro). |
| `VITE_API_URL` | Base da API no browser; vazio = mesma origem com proxy Vite (`/api` → :3333). Ex.: `http://localhost:3333/api/v1` só se o cliente usar paths sem `/api/v1`. |
| `S3_ENDPOINT`, `S3_BUCKET`, `S3_ACCESS_KEY`, `S3_SECRET_KEY` | MinIO/S3 para uploads (quando habilitado). |

## Comandos úteis

```bash
# Gerar cliente Prisma (atalho na raiz — recomendado após clone ou mudança no schema)
pnpm db:generate

# Build do pacote Prisma + tipos consumidos pela API
pnpm --filter @infotime/database run build

# Criar schema/tabelas no PostgreSQL (primeira vez ou sem migrations versionadas)
pnpm db:push

# Migrações (desenvolvimento, quando usar migrate em vez de db push)
pnpm db:migrate

# Seed — tenant 1, admin/admin123, grupo, aplicação, 2 clientes (ver `packages/database/prisma/seed.ts`)
pnpm db:seed

# Criar tabelas e carregar dados demo num só passo (dev)
pnpm db:setup-dev

# API + Web (Nest em http://localhost:3333/api/v1; Vite com proxy `/api` → 3333)
pnpm dev

# API Nest só
pnpm --filter @infotime/api dev

# Web só
pnpm --filter @infotime/web dev

# Mesmo pipeline que o GitHub Actions (generate, builds, testes da API)
pnpm verify
```

### Primeira execução local

1. Garanta que a base **`liga_infotime`** existe no PostgreSQL (ex.: DBeaver em `localhost:5432`). Copie [`.env.example`](.env.example) para `.env` na raiz e ajuste `DATABASE_URL` (credenciais); não é necessário criar uma base nova com outro nome.
2. `pnpm install`, depois `pnpm db:generate`, `pnpm db:push` e `pnpm db:seed`.
3. Defina `JWT_SECRET` e `JWT_REFRESH_SECRET` (mínimo exigido pelo Nest para refresh).
4. Na Web, mantenha `VITE_API_URL` vazio (padrão em `.env.example`): o cliente chama caminhos `/api/v1/...` na mesma origem do Vite e o proxy encaminha `/api` para a API na porta 3333.
5. `pnpm dev` (compila `@infotime/database` antes da API via `predev`) ou suba API e Web em terminais separados após `pnpm --filter @infotime/database run build`.
6. Login piloto (após seed): usuário `admin`, senha `admin123`, tenant `1` (campo id tenacidade no formulário).

## Corpus de migração

1. Coloque os zips em `migration-input/zips-originais/`.
2. Extraia o corpus principal:  
   `unzip -o migration-input/zips-originais/infotime-migration_v3.zip -d migration-source/`

O diretório `migration-source/` pode ser grande; a equipe pode versioná-lo ou mantê-lo apenas localmente.

## Licença

Proprietário / uso interno conforme política da organização.
