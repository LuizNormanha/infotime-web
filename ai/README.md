# IA aplicada neste monorepo

Este documento é o **runbook** da pasta `ai/`: o que existe, para que serve e como usar no desenvolvimento. Complementa o **código** em `api/` e `web/` e as regras do Cursor em **`.cursor/rules/`** (em especial **`ai-first`**). A documentação normativa por domínio fica em **`ai/domains/<tema>/`** (referências cruzadas também devem usar esse prefixo).

---

## 1. Glossário rápido

| Termo | O que é |
|--------|---------|
| **Domínio** | Uma pasta em `ai/domains/<nome>/` com arquivos Markdown padronizados (ver §2). O `<nome>` é o identificador usado na API (`dominio` em `POST /ai/generate`). |
| **JWT** | Token de autenticação. A rota `/ai/generate` exige usuário logado; o **tenant não entra no prompt** — só garante acesso controlado ao endpoint. |
| **BFF** | No Next.js, rotas em `web/src/app/api/...` que encaminham para a API Nest com cookies. O recurso `ai` está permitido no BFF. |
| **`migrate deploy`** | Aplica **apenas** migrations pendentes no PostgreSQL. Uso correto em **homologação e produção**. |
| **`migrate reset`** | **Apaga** o banco e recria do zero (e pode rodar seed). **Somente** em ambiente descartável (ex.: dev local). **Nunca** em produção com dados de clientes. |

---

## 2. Estrutura da pasta `ai/`

```
ai/
  README.md                 ← este guia
  domains/
    <dominio>/              ← por tema: **`padroes-ui`** (padrões de tela do template), **`login`**, **`tenacidade`**, **`usuario`**, e pastas por produto (ex.: `estoque-produto`).
      Context.md            ← visão de negócio, fluxos, exemplos narrativos
      Rules.md              ← regras explícitas, validações, if/else
      Schema.md             ← referência a modelos Prisma / tabelas (não inventar colunas)
      Examples.md           ← casos de uso, I/O, edge cases
```

**Padrão de nomes dos arquivos:** `Context.md`, `Rules.md`, `Schema.md`, `Examples.md` (com **C** e **R** maiúsculos na primeira letra do arquivo).

**Domínios fixos do template:** `padroes-ui` (UI/CRUD reutilizável), `login`, `tenacidade`, `usuario`. Cada aplicação acrescenta pastas sob `ai/domains/` para os domínios do produto.

**Código da API** (NestJS) que lê `Rules.md` do disco e expõe HTTP fica em `api/src/ai/` — o build do Nest só inclui `api/src`, por isso os serviços TypeScript **não** ficam dentro de `ai/` na raiz.

### 2.1 Alinhamento com as regras do Cursor (IA first)

- **`.cursor/rules/ai-first/ai-first.mdc`** — prioridade entre código e `ai/domains`; segurança de prompts.
- **`.cursor/rules/global/global.mdc`** — contexto do monorepo e política de schema/migrations.
- **`.cursor/rules/backend/backend.mdc`** e **`front-end/frontend.mdc`** — incluem pontos sobre o módulo `api/src/ai/` e o recurso BFF `ai`.

---

## 3. O que existe hoje

- **Documentação por domínio** versionada com o Git (`ai/domains`).
- **Endpoint `POST /ai/generate`**: lê **`Rules.md`** do domínio a partir do disco, monta o prompt com instruções de stack (agentes) e chama o **modelo de chat** da OpenAI. Não há indexação vetorial nem tabela `ai_documents` no Postgres.

O Cursor **não** passa a ler `ai/domains` automaticamente em todo chat. Para a IDE, continue usando **@arquivos** ou colando trechos.

---

## 4. Variáveis de ambiente (`api/.env`)

| Variável | Obrigatória para | Observação |
|----------|------------------|------------|
| `DATABASE_URL` | Prisma / API | Já exigida pelo projeto. |
| `SUPORTE_SECRET_KEY` | Bootstrap da API | Já exigida pelo projeto. |
| `OPENAI_API_KEY` | `POST /ai/generate` | Sem ela, a chamada ao modelo retorna erro. |
| `OPENAI_CHAT_MODEL` | Opcional | Padrão: `gpt-4o-mini`. |
| `OPENAI_CHAT_TEMPERATURE` | Opcional | Padrão: `0.2`. |
| `AI_DOMAINS_ROOT` | Opcional | Caminho absoluto para a pasta `domains`. Se omitido, a API tenta `../ai/domains` em relação ao diretório de trabalho (tipicamente ao rodar a partir de `api/`). |

### 4.1 Financeiro avançado — migrações em fatias, staging e PRs

- **Migrações:** o schema financeiro evolui em **fatias** ordenadas em `api/prisma/migrations/` (`20260520100000` … `20260520100600`, prefixo `financeiro_fatia_*`). Cada `migration.sql` é idempotente onde faz sentido (`IF NOT EXISTS`, `ADD COLUMN IF NOT EXISTS`) e aplica **RLS + GRANTs** na mesma fatia que cria tabelas com `id_tenacidade`.
- **Staging (smoke):** em homologação, após `npm run prisma:migrate:deploy -w api` (ou `prisma migrate deploy` na pasta `api/`), correr `API_SMOKE_URL=… API_SMOKE_TOKEN=… npm run smoke:financeiro -w api` (opcional: `SMOKE_STRICT=1` para exigir também `/financeiro/aging`, `/financeiro/dre` e `/financeiro/regua/cobranca`). Validar ainda jobs/filas (Redis/BullMQ) se estiverem ativos no ambiente.
- **PRs pequenos:** preferir um PR por fatia (ou fatia + código que a consome), em vez de um único PR monolítico com todas as tabelas e todos os módulos — revisão e rollback mais seguros.

---

## 5. Desenvolvimento: fluxo do dia a dia

### 5.1 Criar ou alterar um domínio

Crie (ou edite) `ai/domains/<dominio>/Context.md`, `Rules.md`, `Schema.md`, `Examples.md`. O endpoint `generate` monta o texto de regras assim: se existir **`Rules.manifest.json`** na pasta do domínio, concatena os arquivos listados em `arquivos` (Markdown na ordem); caso contrário, lê só **`Rules.md`**. Arquivos listados que não existem em disco são silenciosamente ignorados (ver `api/src/ai/services/leitor-markdown-dominio.service.ts`). `Context.md` e os demais servem a humanos e à IDE quando você os referencia com `@`.

### 5.2 Desenvolver uma tela ou feature “seguindo as regras”

- **Regra que o sistema obrigatoriamente cumpre** continua no **código** (DTOs, services, Prisma, RLS) e no **schema** versionado; consulte também o Markdown do mesmo tema em **`ai/domains/<tema>/`** quando existir.
- **`ai/domains`** e o `generate` servem para **documentar** e para a **IA** (humana na IDE ou endpoint) sugerir código/alinhamentos. Trate a saída da IA como **rascunho** a revisar e testar.

### 5.3 Gerar sugestão (`generate`)

**API Nest:**

- `POST /ai/generate`
- Exemplo de corpo:

```json
{
  "solicitacao": "Sugira validações de login alinhadas ao Nest e ao Prisma deste repositório.",
  "dominio": "login",
  "modo": "completo"
}
```

- `solicitacao` (obrigatório): pergunta em texto livre.
- `dominio` (opcional): pasta em `ai/domains/<dominio>`. Se omitido, heurísticas do serviço escolhem um domínio a partir da solicitação (`padroes-ui` / `login` / `usuario` / `tenacidade`) ou o primeiro nome de pasta em ordem alfabética.
- `modo` (opcional): `completo` | `backend` | `frontend` (instruções diferentes no prompt).

**BFF Next:** `POST /api/ai/generate` com o mesmo JSON.

Resposta inclui `sugestaoBackend`, `sugestaoFrontend`, `notas`, `dominio`, `modo`. O campo `trechosRecuperados` permanece na API como lista vazia (compatibilidade).

### 5.4 “Agentes” e multiagente

Em `api/src/ai/agents/` existem classes como `AgenteBackend` e `AgenteFrontend` que **injetam parágrafos de instrução** no montador de prompt (`PromptBuilderService`). **Não** é um orquestrador multiagente autônomo; é **preparação** e **separação de papéis** no texto do prompt.

---

## 6. Schema do banco e releases

### 6.1 Ambiente novo ou após pull

Na pasta `api/`, com `DATABASE_URL` apontando para esse ambiente:

```bash
npx prisma migrate deploy
```

### 6.2 Banco só seu, sem dados de cliente (ex.: dev local)

Se quiser **zerar tudo** e recriar:

```bash
npx prisma migrate reset
```

**Atenção:** apaga dados. **Não use em produção** com informação real.

### 6.3 Produção

- **Só** `npx prisma migrate deploy` (ou o equivalente no pipeline de deploy), nunca `migrate reset`.
- Subir **migration e código** compatíveis na mesma janela de release.

---

## 7. Onde está o quê (referência rápida)

| O quê | Onde |
|--------|------|
| Markdown de domínios | `ai/domains/` |
| Controller HTTP `/ai/*` | `api/src/ai/ai.controller.ts` |
| Geração (Rules.md + OpenAI chat) | `api/src/ai/geracao-ia.service.ts`, `api/src/ai/services/prompt-builder.service.ts`, `api/src/ai/services/ai.service.ts` |
| Montagem do prompt + agentes | `api/src/ai/services/prompt-builder.service.ts`, `api/src/ai/agents/` |
| BFF permitindo `ai` | `web/src/app/api/[...path]/route.ts` (`RECURSOS_PERMITIDOS`) |

---

## 8. Resumo em uma frase

**Edite `ai/domains` (sobretudo `Rules.md`) → use `POST /ai/generate` ou a IDE com @ nos arquivos; em produção use `migrate deploy`, nunca `migrate reset`, e trate a IA como rascunho revisável.**

Se algo neste README divergir do código, prevalece o repositório; considere atualizar este arquivo na mesma PR que mudar o comportamento.
