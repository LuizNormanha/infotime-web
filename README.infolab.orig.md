# Infotime Web — Monorepo

Sistema de gestão laboratorial. Monorepo [Nx](https://nx.dev/) composto por:

| Pacote | Tecnologia | Porta padrão |
|--------|-----------|-------------|
| `api/` | NestJS 11 + Prisma (PostgreSQL) | 3003 |
| `web/` | Next.js 16 (App Router + Turbopack) | 3004 |

---

## Pré-requisitos

- **Node.js ≥ 22** (use `.nvmrc` com `nvm use`)
- **npm ≥ 10**
- **PostgreSQL** acessível (local ou Docker)

---

## Setup rápido

```bash
# 1. Instalar dependências (tudo na raiz — workspace npm)
npm ci

# 2. Copiar variáveis de ambiente
cp api/.env.example api/.env
cp web/.env.example web/.env
# Edite os dois arquivos com suas credenciais

# 3. Gerar cliente Prisma e aplicar migrations
cd api
npx prisma migrate dev
cd ..

# 4. Iniciar em desenvolvimento (API + Web em paralelo)
npm run dev
```

### MCP no Cursor (briefing CRUD — opcional)

Para o time usar a tool **`infolab.crud_briefing`** no Cursor:

1. Abra a **raiz do monorepo** no Cursor.
2. Rode `npm run mcp:infotime:build` (ou `cd tools/infolab-mcp && npm ci && npm run build`) após clonar ou atualizar essa pasta.
3. O arquivo **`.cursor/mcp.json`** já referencia o servidor MCP do monorepo. Reinicie o Cursor se necessário.

Detalhes: **`tools/infolab-mcp/README.md`**.

---

## Arquitetura

```
infotime-web/
├── api/          NestJS — API REST com autenticação JWT multi-tenant, RLS via Prisma
├── web/          Next.js — Frontend + BFF (Route Handlers como proxy para a API)
├── docs/         Documentação técnica (matriz BFF, configuração de ambiente)
├── scripts/      Scripts auxiliares de desenvolvimento
└── .github/      CI/CD (GitHub Actions)
```

### Fluxo de dados

```
Browser → Next.js Route Handler (BFF) → NestJS API → PostgreSQL (com RLS por tenant)
```

O frontend **nunca** chama a API diretamente. Todo tráfego passa pelo BFF em `/api/*`,
que autentica, valida paths via allowlist e repassa com `fetchComTimeout`.

### Autenticação

- **Usuário comum**: login → JWT no cookie HTTP-only → guard multi-tenant verifica por tenant
- **Suporte/implantação**: login técnico → redirect `/suporte/acesso` → registrar acesso → `/home`

---

## Comandos disponíveis

```bash
# Desenvolvimento
npm run dev           # API + Web em paralelo
npm run dev:api       # Só API
npm run dev:web       # Só Web

# Build
npm run build         # API + Web
npm run build:api
npm run build:web

# Testes
npm test              # Unitários (API Jest + Web Vitest)
cd api && npm run test:e2e   # E2E (API)

# Lint
npm run lint          # Verifica API + Web
cd api && npm run lint:fix   # Corrige automaticamente (só local)
cd web && npm run lint:fix

# Auditoria de segurança
npm audit --audit-level=high
```

---

## Variáveis de ambiente

| Arquivo | Referência |
|---------|-----------|
| `api/.env` | `api/.env.example` |
| `web/.env` | `web/.env.example` |

Variáveis obrigatórias na API: `DATABASE_URL`, `SUPORTE_SECRET_KEY`.
A aplicação **não inicia** se alguma delas estiver ausente.

---

## CI/CD

O pipeline GitHub Actions (`.github/workflows/ci.yml`) executa em todo push/PR:

1. `npm ci` + cache npm
2. `npm audit --audit-level=high`
3. `prisma generate`
4. `lint` (API + Web)
5. `test` unitários (API + Web)
6. `test:e2e` (API)
7. `build` (API + Web)

---

## Template de novo monorepo (ZIP)

Para gerar um pacote base para um novo projeto no `trunk`:

```bash
npm run template:zip
```

O artefato é criado em `templates/monorepo-base/output/`. Instruções pós-descompactação e baseline obrigatório/opcional: [`templates/monorepo-base/README-template.md`](templates/monorepo-base/README-template.md) e [`templates/monorepo-base/BASELINE.md`](templates/monorepo-base/BASELINE.md).

---

## Documentação técnica

- [`docs/BFF_API_ROUTE_MATRIX.md`](docs/BFF_API_ROUTE_MATRIX.md) — Matriz completa de rotas BFF → API
- [`docs/CONFIGURACAO_AMBIENTE.md`](docs/CONFIGURACAO_AMBIENTE.md) — Configuração detalhada do ambiente

---

## Segurança

Consulte [`SECURITY.md`](SECURITY.md) para reportar vulnerabilidades.
