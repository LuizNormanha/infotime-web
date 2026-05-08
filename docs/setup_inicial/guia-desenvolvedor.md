# Setup inicial — ambiente do desenvolvedor

Guia para preparar máquina Windows (ou similar) com Node.js, PostgreSQL, clone do repositório e variáveis de ambiente para rodar **API** (`api/`) e **Web** (`web/`).

> **Segurança**
>
> - **Não commite** arquivos `.env`, tokens GitHub (`ghp_…`), senhas ou chaves em documentação versionada.
> - Obtenha senhas e tokens pelo canal seguro do time (senhas mestras, PAT para clone, etc.).
> - Se algum segredo vazou em chat ou doc antigo, **revogue** no GitHub e **troque** senhas no Postgres.

---

## 1. Pré-requisitos

| Ferramenta | Observação |
|------------|------------|
| **Node.js** | Instalar LTS (≥ 22 conforme `.nvmrc`); necessário para `npm install` e scripts do projeto. |
| **Git** | Para clonar e sincronizar o repositório. |
| **PostgreSQL** | Instalação local do servidor; versão alinhada ao time. |
| **Editor / Cursor** | Opcional: conta e preferências do desenvolvedor. |

### PostgreSQL (Windows)

Download oficial (installer EnterpriseDB é uma opção comum):

- [PostgreSQL — downloads](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads)

Instale seguindo o assistente; anote **porta** (padrão `5432`), **usuário superuser** e senha escolhidos na instalação — necessários para os passos abaixo.

---

## 2. Repositório GitHub

### Identidade Git (obrigatório para commit)

```powershell
git config --global user.name "Seu Nome"
git config --global user.email "seu-email-conforme-politica-do-time"
```

### Clone (HTTPS com PAT)

1. No GitHub: **Settings → Developer settings → Personal access tokens** — crie um token com escopo adequado ao clone (`repo`, conforme política).
2. Ao clonar, use o token **como senha** quando o Git pedir, ou incorpore na URL só em ambiente local (evite salvar em scripts versionados).

```powershell
git clone https://github.com/<organizacao>/<repositorio>.git
cd infotime-web
```

Substitua `<organizacao>/<repositorio>` pelo caminho real do projeto.

**Credenciais de desenvolvedor no GitHub** (login web / e-mail da conta): combinadas com o time; **não** documente senhas neste repositório.

---

## 3. Banco local PostgreSQL (uma vez por máquina)

Execute os comandos abaixo como superusuário (`postgres` ou equivalente), em ferramenta como **DBeaver**, **HeidiSQL**, **pgAdmin** ou `psql`.

> **Ajuste as senhas** entre aspas simples para valores definidos pelo time. Use **as mesmas** senhas depois nos `.env` da API (`DATABASE_URL` / `DATABASE_URL_MIGRATE`).

```sql
-- 1) Papéis de acesso (troque as senhas!)
CREATE ROLE "LigaDev" WITH LOGIN PASSWORD 'TROQUE_SENHA_LigaDev';
CREATE ROLE "LigaMaster" WITH LOGIN PASSWORD 'TROQUE_SENHA_LigaMaster';
CREATE ROLE "liga_infotime_rw" WITH LOGIN PASSWORD 'TROQUE_SENHA_liga_infotime_rw';

-- 2) Banco de dados
CREATE DATABASE liga_infotime OWNER "LigaMaster";

-- 3) LigaMaster: permissões para migrations / papéis (ajuste conforme política do projeto)
ALTER ROLE "LigaMaster" WITH SUPERUSER CREATEDB CREATEROLE REPLICATION BYPASSRLS;

-- 4) LigaDev: sem superusuário e sem criar banco
ALTER ROLE "LigaDev" WITH LOGIN NOSUPERUSER NOCREATEDB;

-- 5) liga_infotime_rw: sem superusuário e sem criar banco
ALTER ROLE "liga_infotime_rw" WITH LOGIN NOSUPERUSER NOCREATEDB;

-- 6) (Opcional / política de segurança do time) Reduzir uso do role postgres padrão
-- ALTER ROLE postgres NOLOGIN;
```

As migrations do projeto criam **roles e GRANTs** adicionais quando aplicadas (`api/prisma/migrations`). O banco precisa existir e os três roles acima devem estar criados conforme combinado com o time.

> **Encoding / locale:** siga padrão da equipe; problemas de collation aparecem em ordenação e comparações.

---

## 4. Dependências Node

Na **raiz** do repositório (`infotime-web/`):

```powershell
npm install
```

---

## 5. Variáveis de ambiente

Crie os arquivos **localmente**; não os envie ao Git (devem estar no `.gitignore`).

### `api/.env`

Veja o template completo em [`api/.env.example`](../../api/.env.example). Ajuste para o setup local:

```env
DATABASE_URL=postgres://LigaDev:TROQUE_SENHA_LigaDev@LOCALHOST:5432/liga_infotime
DATABASE_URL_MIGRATE=postgres://LigaMaster:TROQUE_SENHA_LigaMaster@LOCALHOST:5432/liga_infotime
API_PORT=3003
API_HOST=127.0.0.1
WEB_URL=http://localhost:3004
SUPORTE_SECRET_KEY=troque-por-um-valor-seguro-aleatorio
```

- **Senhas** devem coincidir com as definidas no SQL da seção 3.
- Em URLs, caracteres especiais na senha podem exigir **encoding** (percent-encoding); se der erro de conexão, confira `@`, `#`, `%`, etc.
- Em dev no Windows, `localhost` costuma ligar só em IPv6 (`::1`). Use `127.0.0.1` no `API_HOST` para alinhar com o `API_URL` do Next.

### `web/.env`

Veja o template completo em [`web/.env.example`](../../web/.env.example). Ajuste para o setup local:

```env
WEB_PORT=3004
API_URL=http://127.0.0.1:3003
```

Ajuste porta/host se o time usar outros valores.

---

## 6. Prisma — migrations e cliente

Na pasta **`api/`**:

```powershell
cd api
npx prisma migrate deploy
npx prisma generate
```

| Comando | Uso típico |
|---------|------------|
| `migrate deploy` | Aplica migrations já versionadas (bom para banco vazio ou CI — **não** cria migration nova). |
| `migrate dev` | Desenvolvimento ao **criar** ou iterar migrations (interativo). |
| `db seed` | Popula dados iniciais (tenacidade, usuários de suporte, catálogos) conforme `api/prisma/seed.ts`. |

Se após `migrate deploy` tabelas como `tenacidade` estiverem vazias, rode:

```powershell
npx prisma db seed
```

Para **recriar** banco de desenvolvimento do zero (apaga dados locais):

```powershell
npx prisma migrate reset
```

(confirme quando solicitado; costuma rodar o seed ao final).

---

## 7. Comandos úteis (API)

### Hash bcrypt (ex.: senha `123`)

```powershell
cd api
node -e "const b=require('bcrypt'); b.hash('123',10).then(console.log)"
```

### Senha do dia (usuários técnicos `suporte` / `implantacao`)

```powershell
cd api
npm run senha-do-dia
```

O fluxo de login desses usuários usa a **senha do dia**; o hash armazenado no banco pode ser placeholder.

---

## 8. Subir API + Web

Na **raiz** do repositório:

```powershell
npm run dev
```

Com os `.env` deste guia, a interface web costuma responder em:

- **http://localhost:3004**

A API segue a porta definida em `api/.env` (ex.: `3003`).

---

## 9. Login local (exemplo)

Conforme seed e política do projeto:

| Usuário | Observação |
|---------|------------|
| `suporte@liga.br` | Senha do dia (`npm run senha-do-dia` na pasta `api`). |
| `implantacao@liga.br` | Senha do dia; perfil com fluxos de **Implantação** (ex.: criação de tenacidades), incluindo aba **Implantação** no menu quando aplicável. |

Domínio de e-mail e regras exatas vêm do código e do seed — alinhe com o time se o login falhar. O domínio administrativo padrão do template é **`liga.br`**; cada produto derivado pode adotar outro domínio próprio na linha canônica de `tenacidade_configuracao`.

---

## 10. Resolução rápida de problemas

| Sintoma | Verificar |
|---------|-----------|
| Git pede `user.name` / `user.email` | Seção 2 — `git config --global`. |
| Erro de conexão Prisma | `DATABASE_URL`, firewall, Postgres rodando, senha e encoding na URL. |
| Banco sem dados de tenant | `npx prisma db seed` na pasta `api`. |
| Migration falha (P3015, arquivo ausente) | Pastas em `api/prisma/migrations` sem `migration.sql`; restaurar do Git ou remover pasta órfã — ver documentação interna / time. |

---

## 11. Documentação relacionada

- [`README.md`](../../README.md) — visão geral do monorepo e setup rápido.
- [`docs/SEGURANCA-OPERACAO.md`](../SEGURANCA-OPERACAO.md) — checklist de segurança para produção.
- [`docs/TEMPLATE-DERIVACAO.md`](../TEMPLATE-DERIVACAO.md) — passo a passo para derivar um produto a partir do template.
- [`docs/prompts/`](../prompts) — prompts padronizados para fluxos comuns (sincronização de banco, GitHub, menu).

---

## 12. Manutenção deste documento

Ao mudar portas, nomes de roles ou fluxo de seed, atualize este README e avise o time. Novos passos (Docker, etc.) podem entrar como subpágina ou seção adicional.
