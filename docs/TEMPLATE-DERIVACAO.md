# Derivar um produto a partir do `liga-prj-template`

Este monorepo combina um **shell estável** (autenticação, sessão, layout, menu em abas, componentes PrimeReact, CSS, padrões de listagem e formulário) com um **domínio** que você troca por produto. Neste repositório fonte, o domínio e o Prisma estão alinhados ao banco **InfoTIME**; em um clone derivado você aponta para outro banco e outro schema.

## Checklist resumido

| Passo | O que fazer |
|--------|-------------|
| **1. Origem** | Clonar este repositório ou descompactar o ZIP gerado por `npm run template:zip` (saída em `templates/monorepo-base/output/`). |
| **2. Identidade** | Ajustar `name` e `description` no [`package.json`](../package.json) raiz; opcionalmente renomear pacotes em [`web/package.json`](../web/package.json) e [`api/package.json`](../api/package.json) (hoje `@liga/template-web` e `@liga/template-api`). |
| **3. Ambiente** | Copiar `api/.env.example` → `api/.env` e `web/.env.example` → `web/.env`. Preencher `DATABASE_URL`, chaves de JWT/sessão, `WEB_URL`, `API_URL`, etc. |
| **4. Banco** | Substituir ou evoluir [`api/prisma/schema.prisma`](../api/prisma/schema.prisma) (introspect `db pull`, migrations novas, ou schema greenfield). Rodar `npx prisma generate` na pasta `api` e migrations conforme política do time. |
| **5. API** | Incluir ou remover módulos em `api/src/`. Manter módulos transversais listados em [ESTRUTURA-API.md](ESTRUTURA-API.md) como referência do que é “perene” vs domínio. |
| **6. Web** | Novas rotas em `web/src/app/`, páginas que reutilizam os mesmos blocos de lista/formulário. Ajustar BFF e permissões se criar telas novas. |
| **7. Menu** | Ver [MENU-TEMPLATE-VS-DST.md](MENU-TEMPLATE-VS-DST.md): menu mínimo do template vs catálogo DST gerado. |
| **8. i18n** | Textos em `web/src/app/(comum)/i18n/mensagens/pt-BR.json` (e outros locales, se existirem). |

## Especificação antes de codar

Para não perder o padrão de trabalho entre produtos, use o roteiro em [TEMPLATE-ESPECIFICACAO-PRODUTO.md](TEMPLATE-ESPECIFICACAO-PRODUTO.md): entidades, telas, IDs de menu estáveis e regras por endpoint.

## O que **não** convém reescrever no derivado (preservar a “cara” Liga)

- Tokens de tema e variáveis CSS globais usadas pelo layout.
- Componentes base de shell: cabeçalho, menu lateral/barra, sistema de abas (`LigaHomeNavegacao`, `LigaSistemaAbas`), login.
- Fluxo BFF de autenticação e hooks de sessão, salvo extensão documentada.

Domínio (CRUD, regras, Prisma, textos de negócio) é onde cada produto diverge.

## Documentação adicional no repositório

| Documento | Conteúdo |
|-----------|-----------|
| [MENU-TEMPLATE-VS-DST.md](MENU-TEMPLATE-VS-DST.md) | Menu padrão enxuto vs menu gerado DST. |
| [ESTRUTURA-API.md](ESTRUTURA-API.md) | Módulos perenes vs exemplo InfoTIME. |
| [TEMPLATE-ESPECIFICACAO-PRODUTO.md](TEMPLATE-ESPECIFICACAO-PRODUTO.md) | Modelo de especificação para o time ou para agentes. |
| [`templates/monorepo-base/docs/`](../templates/monorepo-base/docs/) | AUTH, MENU-ABAS, KIT-CRUD, I18N, validação do ZIP. |

## Estratégia de menu

Detalhado em [MENU-TEMPLATE-VS-DST.md](MENU-TEMPLATE-VS-DST.md). Em uma linha: use o menu em `menu-home-template-infotime.ts` como padrão do template; só dependa de `menu-estrutura-dst-gerado.ts` se o produto for portar o ecossistema DST completo.
