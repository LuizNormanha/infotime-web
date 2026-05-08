# O que é o Infotime Web

Documento de visão geral do repositório **infotime-web**: produto, arquitetura, stack, padrões e onde buscar a “fonte da verdade”. Complementa o [README](../README.md) na raiz e o runbook [ai/README.md](../ai/README.md).

---

## 1. Produto

**Infotime Web** é um sistema de **gestão laboratorial** em formato de **monorepo**: aplicação web para operação diária de laboratórios (cadastros, atendimentos, produção, faturamento, usuários, multi-tenant por **tenacidade**, integrações e fluxos de implantação/suporte).

---

## 2. Estrutura do monorepo

| Pasta | Conteúdo |
|--------|-----------|
| **`api/`** | API REST **NestJS** + **Prisma** + **PostgreSQL** |
| **`web/`** | Interface **Next.js** (App Router) + **BFF** (rotas `/api/*` que encaminham para a API) |
| **`ai/`** | Documentação por domínio em Markdown (`ai/domains/<tema>/`) e guia de uso da IA aplicada |
| **`tools/infolab-mcp/`** | Servidor MCP (Cursor) com tool de briefing para CRUDs |
| **`.cursor/rules/`** | Regras de desenvolvimento do time (backend, frontend, global, ai-first) |

Orquestração com **Nx**; **Node.js ≥ 22** e **npm ≥ 10** (workspaces: `api`, `web`).

**Portas padrão de desenvolvimento:** API **3003**, Web **3004** (configurável via env).

---

## 3. Stack técnico

### 3.1 Backend (`api/`)

- **NestJS 11**
- **Prisma 6** + **PostgreSQL**
- Autenticação **JWT** (Passport), **bcrypt**, **Helmet**, **class-validator** / **class-transformer**
- **Rate limiting** (`@nestjs/throttler`), armazenamento Redis opcional para limite distribuído
- Testes: **Jest** (unitário + e2e na API)

### 3.2 Frontend (`web/`)

- **Next.js 16** (App Router)
- **React 19**
- **PrimeReact** + **PrimeIcons** (componentes de UI)
- **next-intl** (mensagens / i18n)
- Testes: **Vitest**

### 3.3 Dados

- Tabelas físicas em **`liga_infotime`** sem prefixo (ex.: `tenacidade`, `usuario`); modelos Prisma historicamente nomeados `infolab_*` mapeiam para essas tabelas via **`@@map`**
- Escopo por tenant em geral via **`id_tenacidade`** (alinhado ao schema; não assumir nomes genéricos como `tenant_id` sem consultar o modelo)

---

## 4. Arquitetura de execução

### 4.1 Fluxo de requisições

```
Navegador → Next.js (BFF /api/*) → NestJS → PostgreSQL
```

O frontend **não** chama a API Nest diretamente no fluxo normal: o tráfego passa pelo **BFF** em `web/src/app/api/`, com cookies JWT e uma **lista explícita de recursos** permitidos no proxy genérico (`RECURSOS_PERMITIDOS`). Novos endpoints expostos ao browser precisam ser **autorizados nessa lista** (ou em rotas BFF dedicadas).

### 4.2 Autenticação

- **Usuário comum:** login → JWT em **cookie HTTP-only** → guards na API
- **Suporte/implantação:** fluxo próprio (ex.: registro de acesso antes de usar o sistema)

### 4.3 Multi-tenant e RLS

- Isolamento por **tenacidade**
- **PostgreSQL RLS** com variável de sessão **`app.current_tenant_id`**
- Na API: middleware + **extensão do cliente Prisma** que aplica o tenant da requisição; em transações, seguir os padrões já usados no código para `set_config` / RLS
- **Não** confiar em tenant enviado no body quando o contrato é “tenant vem da sessão/JWT”

Algumas tabelas (ex.: configuração global de tenacidade) **não** usam RLS — o comentário no `schema.prisma` da API é a referência.

---

## 5. Backend em detalhe

### 5.1 Organização

- Padrão **módulo Nest** por área de negócio: `controller` → `service` → **Prisma** (não acessar Prisma direto no controller de forma indisciplinada)
- Entrada HTTP tipada com **DTOs** e **ValidationPipe** global
- Muitos módulos no `AppModule`: clientes, atendimentos, convênios, exames, mapas, faturas, orçamentos, usuários, tenacidade, layout, etc.

### 5.2 Módulo de IA (`api/src/ai/`)

- Endpoint **`POST /ai/generate`**: lê **`Rules.md`** do domínio em disco, monta o prompt (incluindo blocos de “agente” para Nest/Next — são **instruções no texto**, não um multiagente autônomo) e chama o modelo de chat (**OpenAI**)
- Requer **`OPENAI_API_KEY`**; variáveis opcionais incluem modelo e temperatura, e **`AI_DOMAINS_ROOT`** para apontar a pasta de domínios

### 5.3 Schema e migrations

Alterações de banco (**migrations**, novas colunas, FKs, tabelas**) exigem **confirmação explícita** de produto/arquitetura. Em dúvida sobre cardinalidade ou nome de coluna, **alinhar com humanos** antes de mudar o Prisma.

---

## 6. Frontend em detalhe

### 6.1 App Router e shell

- Layout raiz com **next-intl**, tema PrimeReact e componentes “Liga” que montam o **shell** (home com abas, menu, tema claro/escuro)
- Rotas por módulo: em geral **`listagem/page.tsx`** e **`formulario-cadastro/page.tsx`** para cadastros

### 6.2 Componentes e padrões de UI

- Componentes reutilizáveis com prefixo **`Liga*`** (formulário base, cadastro, listagem, navegação, diálogos)
- Formulários: **seções**, sidebar de navegação, contratos tipados em **`web/src/types/formulario-cadastro.types.ts`**
- Listagens: **`LigaListagemBase`** e utilitários de formatação (datas, etc.)
- Documentação normativa de UI: **`ai/domains/padroes-ui/`** (`Context.md`, `Rules.md`, …)

### 6.3 Layout dinâmico (preferências)

- A API pode devolver o layout de formulário por tela/usuário (**GET** `/layout/:tela/formulario-cadastro`). Se vier vazio, a página usa o **layout padrão** definido no código (ex.: `*LayoutPadrao.ts`)

### 6.4 Internacionalização

- Mensagens em **`web/src/app/(comum)/i18n/mensagens/`**
- Evitar strings de interface fixas no meio do componente quando o padrão da tela for i18n

### 6.5 BFF e IA no browser

- Chamadas autenticadas via **`/api/...`** com cookies
- O recurso **`ai`** está na allowlist: **`POST /api/ai/generate`** segue o mesmo padrão de autenticação que o restante

---

## 7. Pasta `ai/domains` — domínios documentados

Cada **domínio** é uma pasta **`ai/domains/<nome>/`** com arquivos padronizados:

| Arquivo | Uso |
|---------|-----|
| **`Context.md`** | Contexto de negócio, fluxos |
| **`Rules.md`** | Regras explícitas — **usado pelo endpoint `generate`** |
| **`Schema.md`** | Referência a modelos Prisma / tabelas |
| **`Examples.md`** | Exemplos e casos limite |

**Finalidade:**

1. Documentação versionada com o Git  
2. Suporte a **IA** (IDE com `@` ou `POST /ai/generate`) — a saída é **rascunho**; a implementação real está em **`api/`**, **`web/`** e no **schema Prisma**  
3. **Segurança:** sem dados reais de clientes; não usar o tenant do JWT como contexto de negócio em prompts para provedores externos

Há dezenas de domínios (ex.: paciente, atendimento, convênio, fatura, tenacidade, login, integrações, mapa-produção, **padroes-ui**, etc.).

---

## 8. Ferramentas e CI

- **Nx:** `npm run dev`, `build`, `lint`, `test` na raiz  
- **GitHub Actions:** instalação, audit, `prisma generate`, lint, testes, e2e API, build  
- **MCP Infotime:** após build em `tools/infolab-mcp`, a tool **`infolab.crud_briefing`** gera briefing Markdown (Nest, Next, RLS, componentes, trechos de `padroes-ui` e do domínio escolhido)

---

## 9. Convenções gerais

- **Português (pt-BR)** para nomes de negócio e domínio alinhados ao schema  
- **Inglês** para termos de framework (`Controller`, `Service`, `Dto`, hooks `use…`)  
- Features com **mestre e detalhe** devem gravar de forma **transacional** quando uma falha em qualquer parte não pode deixar dados inconsistentes  
- Prioridade de verdade: **código executável** e **schema** > **`ai/domains`** > suposições não verificadas  

---

## 10. Onde ler mais

| Tema | Local |
|------|--------|
| Setup e comandos | [README.md](../README.md) na raiz |
| IA, `generate`, variáveis de ambiente | [ai/README.md](../ai/README.md) |
| Padrões de UI e CRUD | `ai/domains/padroes-ui/` |
| Regras do editor | `.cursor/rules/` |
| Segurança (reporte) | [SECURITY.md](../SECURITY.md) (se existir na raiz) |

---

*Se algum trecho deste documento divergir do código ou do schema versionado, prevalece o repositório; atualize este arquivo na mesma alteração que mudar o comportamento.*
