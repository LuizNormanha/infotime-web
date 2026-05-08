# Baseline do template monorepo

Este documento consolida **arquivos e pastas obrigatórias** versus **opcionais (addons)** para o ZIP base usado ao iniciar um novo projeto no `trunk`.

## Obrigatório — orquestração do monorepo

| Área | Caminhos |
|------|----------|
| Raiz | `package.json`, `package-lock.json` (recomendado para installs reproduzíveis), `nx.json`, `.editorconfig`, `.gitignore`, `.nvmrc` |
| Workspaces | Pastas `api/`, `web/` completas (código-fonte, configs, testes) |
| Nx por app | `api/project.json`, `web/project.json` |
| Scripts raiz | `scripts/` (ex.: `prisma-generate-dev.mjs`, `prisma-generate-api.mjs`) |
| CI | `.github/workflows/` (ex.: `ci.yml`) |
| Segurança / política | `SECURITY.md` (se existir na origem) |

## Obrigatório — backend (API)

| Área | Caminhos |
|------|----------|
| Nest | `api/src/main.ts`, `api/src/app.module.ts`, `api/nest-cli.json` |
| Auth / sessão | `api/src/autenticacao/` (controller, service, guard, strategy, módulo) |
| Prisma + tenant | `api/src/prisma/`, `api/prisma/schema.prisma`, `api/prisma/migrations/` |
| Comum | `api/src/comum/` (decorators públicos, tenant, usuário, etc., conforme imports do projeto) |
| DTO / validation | Padrão `dto/` por módulo já existente |
| Env | `api/.env.example` |

## Obrigatório — frontend (Web) + BFF

| Área | Caminhos |
|------|----------|
| Next | `web/next.config.mjs`, `web/tsconfig.json`, `web/eslint.config.mjs`, `web/project.json`, `web/package.json` |
| Proxy / gate | `web/src/proxy.ts` |
| Auth BFF | `web/src/app/api/auth/` (login, logout, sessão, status, permissoes, proxy para Nest) |
| Catch-all API | `web/src/app/api/[...path]/route.ts`, `recursos-permitidos-bff.ts` |
| Lib auth | `web/src/lib/autenticacao/`, `web/src/lib/resolve-backend-api-url.ts`, `web/src/lib/fetch-com-timeout.ts` |
| Hooks | `web/src/hooks/useSessaoAtual.ts`, `usePermissaoPerfilTelaAtiva.ts` |
| Login UI | `web/src/app/login/` |
| Layout raiz | `web/src/app/layout.tsx`, `web/src/app/home/page.tsx` |
| Env | `web/.env.example` |

## Obrigatório — menu, home e abas

| Área | Caminhos |
|------|----------|
| Dados do menu | `web/src/data/menu-estrutura-dst-gerado.ts` |
| Navegação | `web/src/components/navegacao/` (home, topbar, menu, drawer) |
| Abas | `web/src/components/abas/` |
| Estado abas | `web/src/lib/navegacao/home-estado-abas.ts` |
| Layout backend (menu persistido) | `api/src/layout/` (controller, service, validação) |

## Obrigatório — kit CRUD base (UI)

| Área | Caminhos |
|------|----------|
| Formulário | `web/src/components/formulario-base/`, `web/src/components/formulario-cadastro/` |
| Listagem | `web/src/components/formulario-pesquisa/` |
| Hooks | `web/src/hooks/useCadastroFormulario.ts`, `useListagemCrudServidor.ts`, `useLayoutFormulario.ts` |
| Tipos | `web/src/types/formulario-cadastro.types.ts`, tipos de listagem em `liga-listagem.types.ts` |

## Obrigatório — i18n

| Área | Caminhos |
|------|----------|
| Provider / request | `web/src/app/(comum)/i18n/request.ts`, mensagens `web/src/app/(comum)/i18n/mensagens/pt-BR.json` |
| Erros API | `web/src/lib/validacao-api-i18n.ts` |

## Exclusões na geração do ZIP (artefatos locais)

Não incluir no pacote: `node_modules/`, `dist/`, `.next/`, `.nx/`, `coverage/`, `.env` (exceto `*.example`), logs temporários, `.git/`, pastas de staging do próprio gerador (`templates/monorepo-base/.staging/`).

## Opcional — addons recomendados por contexto

| Addon | Caminhos | Quando remover |
|-------|----------|----------------|
| IA domínio | `ai/README.md`, `ai/domains/**` | Produto sem fluxo IA em `ai/domains` |
| MCP Cursor | `tools/infolab-mcp/`, `.cursor/mcp.json` | Sem Cursor / sem briefing MCP |
| Regras Cursor | `.cursor/rules/**` | Time não usa Cursor; pode manter como documentação |
| Legado MCP pasta | `mcp/` | Preferir `ai/domains`; remover se redundante |
| Manuais públicos | `web/public/manuais/`, `web/public/ajuda-ligia/` | Novo produto sem essa ajuda |
| Domínios de negócio específicos | `api/src/soroteca/`, `web/src/app/soroteca/`, etc. | **Podar** módulos que não pertencem ao novo produto (após copiar template) |

## Leitura obrigatória pós-descompactar

1. [README-template.md](./README-template.md) — setup e renomeação do projeto.
2. [docs/VALIDACAO-E-ZIP.md](./docs/VALIDACAO-E-ZIP.md) — checklist de validação e como regenerar o ZIP.
3. [docs/AUTH-BACKEND.md](./docs/AUTH-BACKEND.md), [docs/AUTH-BFF-FRONTEND.md](./docs/AUTH-BFF-FRONTEND.md) — contratos de sessão.
4. [docs/MENU-ABAS.md](./docs/MENU-ABAS.md), [docs/KIT-CRUD.md](./docs/KIT-CRUD.md), [docs/I18N-BASE.md](./docs/I18N-BASE.md) — extensão do produto.
