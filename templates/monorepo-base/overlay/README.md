# liga-prj-template (export ZIP)

Monorepo **mínimo** gerado a partir do repositório InfoTIME Web: API NestJS + Prisma + Web Next.js (PrimeReact), com apenas **login/sessão**, **usuário**, **permissões**, **grupo-perfil**, **tenacidade**, **configuração da tenacidade**, **implantação**, **layout/aplicação/dicionário** e **IA genérica**.

## Como este ZIP foi produzido

No repositório de origem, o script `npm run template:zip` copia o monorepo para staging, remove módulos de domínio listados em `templates/monorepo-base/manifest.json`, substitui `api/prisma/migrations` pelo baseline `0001_baseline_template` e aplica o overlay em `templates/monorepo-base/overlay/`. O **projeto InfoTIME Web no disco não é alterado**.

## Primeiros passos

1. Descompacte o ZIP e entre na pasta `liga-prj-template/`.
2. Copie `api/.env.example` → `api/.env` e `web/.env.example` → `web/.env` e ajuste URLs/senhas.
3. Crie o banco PostgreSQL e o role `LigaDev` (ou ajuste o nome nas `GRANT`s em `api/prisma/migrations/0001_baseline_template/migration.sql`).
4. Na raiz do monorepo: `npm install`
5. `cd api && npx prisma migrate deploy && npx prisma generate`
6. `npm run dev` (na raiz) e abra o front (porta padrão do exemplo: 3004).

Documentação de derivação de produtos: `docs/TEMPLATE-DERIVACAO.md`.

## Banco zerado

A migration `0001_baseline_template` cria tabelas essenciais e um seed mínimo (tenant `id_tenacidade=1`, grupo, usuário `admin@liga.local`, usuários técnicos `suporte` / `implantacao` globais). Ajuste domínio e JWT em `tenacidade_configuracao` conforme seu ambiente.
