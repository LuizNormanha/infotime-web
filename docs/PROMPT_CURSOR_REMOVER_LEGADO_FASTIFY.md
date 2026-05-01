# PROMPT — Cursor Agent: Remover Legado Fastify v1 e Limpar Monorepo

> Cole este prompt completo no Cursor em modo **Agent** (Ctrl+I → Agent).
> O agente executará todos os passos de forma autônoma via terminal integrado.

---

Você é um engenheiro sênior trabalhando no monorepo pnpm localizado em `C:\prj\lann\infotime-web`.

O projeto passou por uma evolução de stack:
- **v1 (LEGADO — REMOVER):** `apps/api` — Fastify puro, sem NestJS, sem DI, sem Guards
- **v2 (ATIVA — MANTER):** `apps/api-nest` — NestJS 11 + FastifyAdapter, arquitetura corporativa SaaS

Sua missão é:
1. Preservar o registro histórico do legado em `docs/historico/`
2. Remover completamente a pasta `apps/api` do projeto ativo
3. Limpar todas as referências ao legado no monorepo
4. Garantir que apenas o `apps/api-nest` seja o backend ativo

Execute TODOS os passos em ordem usando o terminal integrado. Não peça confirmações — execute de forma autônoma e reporte o resultado de cada passo.

---

## PASSO 1 — Diagnóstico inicial

```bash
cd C:\prj\lann\infotime-web
ls apps/
cat apps/api/package.json
cat apps/api-nest/package.json
cat package.json
cat pnpm-workspace.yaml
```

---

## PASSO 2 — Criar estrutura de histórico

```bash
mkdir -p docs/historico/api-fastify-v1
```

---

## PASSO 3 — Criar documento de histórico

Crie o arquivo `docs/historico/api-fastify-v1/HISTORICO_STACK_V1.md` com este conteúdo exato:

```markdown
# Histórico — Stack v1: Fastify Puro (apps/api)

## Contexto

Este documento registra a primeira versão do backend do infotime-web,
implementada com Fastify puro (sem NestJS), removida e substituída
pela stack v2 (NestJS + FastifyAdapter) em Maio de 2026.

A pasta apps/api foi removida do projeto ativo em Maio/2026.
O código-fonte desta versão está arquivado nesta pasta apenas para referência histórica.
Não utilize estes arquivos para desenvolvimento.

---

## Por que foi substituído

| Limitação do Fastify puro          | Solução na stack NestJS v2                  |
|------------------------------------|---------------------------------------------|
| Sem DI container — acoplamento manual | @Injectable() — DI nativo               |
| Sem modularização forçada          | @Module() — estrutura obrigatória           |
| Guards manuais via hooks Fastify   | JwtAuthGuard, TenantGuard, RolesGuard       |
| Sem Pipes de validação             | ZodValidationPipe global                    |
| Sem Interceptors                   | AuditInterceptor, TenantInterceptor         |
| Multi-tenancy não implementado     | PrismaService + ClsService automático       |
| Baixa testabilidade                | DI container permite mocks nativos          |
| Onboarding lento — sem padrão      | Padrão NestJS documentado e replicável      |

---

## Stack v1 — removida

- **Localização original:** apps/api/
- **Framework:** Fastify 5 standalone (sem NestJS)
- **Entrypoints:** src/app.ts + src/server.ts
- **Validação:** nenhuma (sem Pipes)
- **Autenticação:** não implementada
- **Multi-tenancy:** não implementado
- **Módulos:** src/modules/ (convenção manual, sem @Module)
- **ORM:** @infotime/database (Prisma 6) — compartilhado com v2
- **Score geral:** 84/100

---

## Stack v2 — ativa em apps/api-nest

- **Localização:** apps/api-nest/
- **Framework:** NestJS 11 + FastifyAdapter
- **Performance HTTP:** mantida — mesmo engine Fastify
- **DI Container:** @Injectable() nativo
- **Guards:** JwtAuthGuard + TenantGuard + RolesGuard
- **Pipes:** ZodValidationPipe global
- **Interceptors:** AuditInterceptor + TenantInterceptor
- **Multi-tenancy:** PrismaService.$use() + nestjs-cls (AsyncLocalStorage)
- **Autenticação:** JWT access (15min) + refresh (7d) + argon2id
- **ORM:** @infotime/database (Prisma 6) — mesmo package da v1
- **Score geral:** 91/100

---

## Score comparativo

| Dimensão              | v1 Fastify puro | v2 NestJS + FastifyAdapter |
|-----------------------|-----------------|----------------------------|
| Score geral           | 84/100          | 91/100                     |
| Arquitetura           | 70              | 95                         |
| Segurança             | 40              | 92                         |
| Multi-tenancy         | 0               | 87                         |
| Testabilidade         | 50              | 88                         |
| Configuração (.env)   | 60              | 95                         |

---

## Arquivos preservados nesta pasta

Os arquivos abaixo são cópias do código legado para referência histórica:

- `package.json` — configuração do package legado
- `tsconfig.json` — configuração TypeScript legada
- `src/` — código-fonte completo da v1

**Atenção:** estes arquivos são somente leitura histórico.
O backend ativo é `apps/api-nest/`.
```

---

## PASSO 4 — Copiar código-fonte legado para o histórico

```bash
cp apps/api/package.json docs/historico/api-fastify-v1/
cp apps/api/tsconfig.json docs/historico/api-fastify-v1/ 2>/dev/null || true
cp -r apps/api/src docs/historico/api-fastify-v1/src 2>/dev/null || true
```

---

## PASSO 5 — Remover apps/api completamente

```bash
rm -rf apps/api
```

Confirmar que foi removido:

```bash
ls apps/
```

**Resultado esperado:** apenas `api-nest` e `web`.

---

## PASSO 6 — Atualizar package.json da raiz

Substitua o conteúdo completo de `package.json` na raiz por:

```json
{
  "name": "infotime-web",
  "private": true,
  "packageManager": "pnpm@9.15.0",
  "scripts": {
    "dev": "pnpm --parallel --filter @infotime/api --filter @infotime/web dev",
    "build": "pnpm -r run build",
    "lint": "pnpm -r run lint",
    "test": "pnpm -r run test",
    "db:generate": "pnpm --filter @infotime/database exec prisma generate",
    "db:migrate": "pnpm --filter @infotime/database exec prisma migrate dev",
    "db:push": "pnpm --filter @infotime/database exec prisma db push",
    "db:seed": "pnpm --filter @infotime/database exec prisma db seed",
    "db:studio": "pnpm --filter @infotime/database exec prisma studio"
  },
  "devDependencies": {
    "typescript": "^5.7.2"
  }
}
```

---

## PASSO 7 — Verificar pnpm-workspace.yaml

```bash
cat pnpm-workspace.yaml
```

Deve conter:

```yaml
packages:
  - 'apps/*'
  - 'packages/*'
```

Se já estiver assim, não altere nada. O glob `apps/*` vai incluir automaticamente apenas as pastas existentes (`api-nest` e `web`).

---

## PASSO 8 — Verificar .gitignore

```bash
cat .gitignore
```

Garantir que as linhas abaixo existem. Adicionar caso estejam faltando:

```
dist/
node_modules/
.env
.env.local
*.log
.DS_Store
Thumbs.db
```

---

## PASSO 9 — Reinstalar dependências com o workspace limpo

```bash
cd C:\prj\lann\infotime-web
pnpm install
```

**Resultado esperado:** apenas 4 workspaces reconhecidos:
- `@infotime/api` (apps/api-nest)
- `@infotime/web` (apps/web)
- `@infotime/database` (packages/database)
- `@infotime/shared-types` (packages/shared-types)

---

## PASSO 10 — Verificar git status

```bash
git status
```

Resultado esperado:
- `deleted:` — arquivos removidos de apps/api/
- `new file:` — arquivos criados em docs/historico/api-fastify-v1/
- `modified:` — package.json da raiz

Se o projeto não tiver git inicializado, pule este passo.

---

## PASSO 11 — Testar a API NestJS

```bash
pnpm --filter @infotime/api dev
```

**Resultado esperado:**
```
[API] NestJS + Fastify rodando em http://localhost:3333/api/v1
```

Em outro terminal, verificar a resposta:

```bash
node -e "fetch('http://127.0.0.1:3333/').then(r=>r.json()).then(d=>console.log(JSON.stringify(d,null,2)))"
```

Deve retornar JSON com `name: "@infotime/api"` referenciando NestJS — sem nenhuma menção ao Fastify puro.

Depois, testar o `pnpm dev` completo (API + Web em paralelo):

```bash
pnpm dev
```

---

## PASSO 12 — Relatório final

Após concluir todos os passos, reporte:

```bash
# 1. Estrutura final de apps/
ls apps/

# 2. Estrutura do histórico preservado
ls docs/historico/api-fastify-v1/

# 3. Workspaces reconhecidos pelo pnpm
pnpm ls -r --depth 0

# 4. Confirmar API NestJS respondendo
node -e "fetch('http://127.0.0.1:3333/api/v1').then(r=>r.json()).then(d=>console.log(JSON.stringify(d,null,2)))"
```

---

## Estrutura final esperada do projeto

```
C:\prj\lann\infotime-web\
  apps\
    api-nest\                  ← ✅ ÚNICO backend ativo (NestJS + FastifyAdapter)
    web\                       ← ✅ Frontend React + Vite
  packages\
    database\                  ← ✅ Prisma 6 + PostgreSQL remoto
    shared-types\              ← ✅ Tipos TypeScript compartilhados
  docs\
    historico\
      api-fastify-v1\
        HISTORICO_STACK_V1.md  ← 📋 Registro histórico da v1
        package.json           ← 📋 Config legada (somente referência)
        tsconfig.json          ← 📋 Config legada (somente referência)
        src\                   ← 📋 Código legado (somente referência)
    PADRAO_*.md                ← ✅ Documentação de padrões ativos
    PROMPTS_OPERACIONAIS_CURSOR.md
  specs\                       ← ✅ 370 specs dos 37 módulos de negócio
  migration-source\            ← ✅ Corpus legado Scriptcase (fonte de migração)
  migration-input\             ← ✅ Zips originais v0→v3
  scripts\                     ← ✅ generate_entity_specs.py
  package.json                 ← ✅ Scripts atualizados (4 workspaces)
  pnpm-workspace.yaml          ← ✅ apps/* + packages/*
  tsconfig.base.json           ← ✅ Config TypeScript base compartilhada
  pnpm-lock.yaml               ← ✅ Lockfile atualizado
  .env                         ← ✅ DATABASE_URL + JWT_SECRET configurados
  .env.example                 ← ✅ Template documentado
  .gitignore                   ← ✅ dist/, node_modules/, .env excluídos
```

---

## Critério de sucesso

O prompt foi executado com sucesso quando:

- [ ] `ls apps/` mostra apenas `api-nest` e `web`
- [ ] `docs/historico/api-fastify-v1/HISTORICO_STACK_V1.md` existe
- [ ] `pnpm install` reconhece exatamente 4 workspaces
- [ ] `pnpm dev` sobe apenas o NestJS (sem Fastify puro)
- [ ] `GET http://localhost:3333/api/v1` responde com JSON do NestJS
- [ ] Nenhuma referência ativa ao `apps/api` legado no projeto
