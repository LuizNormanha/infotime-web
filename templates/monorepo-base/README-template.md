# Novo projeto — Monorepo (template Liga)

Este pacote foi gerado a partir do repositório **liga-prj-template** (shell Liga + domínio de referência) e serve como **base** para um novo produto: API NestJS + Prisma + PostgreSQL, frontend Next.js com BFF, login/sessão e padrão de menu/abas.

Após descompactar, siga também [docs/TEMPLATE-DERIVACAO.md](docs/TEMPLATE-DERIVACAO.md) na raiz do monorepo (checklist de banco, API, web e menu).

## Conteúdo do pacote

- Raiz: `package.json` (workspaces `api`, `web`), Nx, scripts de desenvolvimento.
- `api/`: backend NestJS, autenticação, Prisma, migrations.
- `web/`: Next.js, rotas BFF em `/api/*`, login, home com menu e abas.
- `templates/monorepo-base/`: documentação do template (`BASELINE.md`, `docs/`, `manifest.json`).
- `README.template.orig.md`: README original do monorepo de origem (referência).

## Pré-requisitos

- Node.js ≥ 22 (`nvm use` se usar `.nvmrc`)
- npm ≥ 10
- PostgreSQL acessível

## Passos após descompactar o ZIP

1. **Renomeie a pasta** do projeto para o nome desejado (ex.: `meu-produto-web`).

2. **Ajuste identidade no `package.json` raiz** (e opcionalmente em `api/package.json` / `web/package.json`):

   - `name`: nome do pacote npm (ex.: `meu-produto-web`).
   - `description`: descrição do novo produto.

   Veja também [template-config.json](templates/monorepo-base/template-config.json) para uma lista de campos sugeridos.

3. **Variáveis de ambiente**

   ```bash
   cp api/.env.example api/.env
   cp web/.env.example web/.env
   ```

   - `api/.env`: `DATABASE_URL`, `SUPORTE_SECRET_KEY`, `WEB_URL` (origem do Next.js para CORS), demais chaves já documentadas no exemplo.
   - `web/.env`: `API_URL` apontando para a API (ex.: `http://localhost:3003`).

4. **Banco de dados**

   ```bash
   cd api
   npx prisma migrate deploy
   npx prisma generate
   cd ..
   ```

   Em desenvolvimento local também pode usar `npx prisma migrate dev` conforme política do time.

5. **Instalar dependências (na raiz)**

   ```bash
   npm ci
   ```

6. **Subir desenvolvimento**

   ```bash
   npm run dev
   ```

   Portas padrão: API **3003**, Web **3004** (ajuste se conflitar).

## Personalização do novo produto

### Menu e telas

- Estrutura do menu: `web/src/data/menu-estrutura-dst-gerado.ts`.
- Home e abas: `web/src/components/navegacao/home/LigaHomeNavegacao.tsx`, `web/src/components/abas/LigaSistemaAbas.tsx`.
- Permissões por tela: hook `usePermissaoPerfilTelaAtiva`, BFF `/api/auth/permissoes`, API `/auth/permissoes`.

Detalhes: [MENU-ABAS.md](templates/monorepo-base/docs/MENU-ABAS.md).

### Novo módulo CRUD

Siga o guia [KIT-CRUD.md](templates/monorepo-base/docs/KIT-CRUD.md): páginas em `web/src/app/<modulo>/`, componentes base de formulário/listagem, módulo Nest em `api/src/<modulo>/`.

### Podar domínios herdados

O template pode incluir módulos de negócio do Infotime que **não** pertencem ao novo produto. Remova pastas em `api/src/` e `web/src/app/` correspondentes e atualize menu, BFF `recursos-permitidos-bff.ts`, e seeds/migrations apenas com **aprovação** de modelo de dados (regra do repositório).

### Internacionalização

Mensagens em `web/src/app/(comum)/i18n/mensagens/pt-BR.json`. Ver [I18N-BASE.md](templates/monorepo-base/docs/I18N-BASE.md).

## Documentação técnica do template

| Documento | Conteúdo |
|-----------|-----------|
| [BASELINE.md](templates/monorepo-base/BASELINE.md) | Lista obrigatório vs opcional |
| [AUTH-BACKEND.md](templates/monorepo-base/docs/AUTH-BACKEND.md) | Auth, JWT, sessão, tenant na API |
| [AUTH-BFF-FRONTEND.md](templates/monorepo-base/docs/AUTH-BFF-FRONTEND.md) | BFF, cookie, proxy, hooks |
| [MENU-ABAS.md](templates/monorepo-base/docs/MENU-ABAS.md) | Menu, home, permissões |
| [KIT-CRUD.md](templates/monorepo-base/docs/KIT-CRUD.md) | Template de CRUD |
| [I18N-BASE.md](templates/monorepo-base/docs/I18N-BASE.md) | i18n |
| [VALIDACAO-E-ZIP.md](templates/monorepo-base/docs/VALIDACAO-E-ZIP.md) | Checklist e geração do ZIP |

## Regenerar o ZIP a partir do monorepo fonte

Na raiz do repositório **fonte** (onde existe `scripts/gerar-template-zip.mjs`):

```bash
npm run template:zip
```

Saída: `templates/monorepo-base/output/liga-prj-template-<timestamp>.zip` (ver `manifest.json`).
