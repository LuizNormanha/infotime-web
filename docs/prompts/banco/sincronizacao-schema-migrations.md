# Banco de dados: sincronização, migrations e impacto no Prisma

Prompt padronizado para **alterações físicas no PostgreSQL** (novos campos, renomeação, tipos, índices) com **rastreio no código** e orientação para quem clonar o repositório e rodar Prisma.

---

## Contexto técnico no repositório (confirmar antes de editar)

| Área | Caminho típico |
|------|----------------|
| Schema Prisma | `api/prisma/schema.prisma` (modelos refletem tabelas físicas via `@@map`) |
| Migrations SQL | `api/prisma/migrations/` |
| Cliente gerado | `npx prisma generate` na pasta `api/` (após mudanças no schema) |
| Aplicar migrations no ambiente | `npx prisma migrate deploy` (CI/prod) ou `prisma migrate dev` (dev local, conforme política do time) |
| Regra global do projeto | Não alterar `schema.prisma` nem criar migration **sem confirmação explícita de produto/arquitetura** — um prompt neste formato dirigido ao agente conta como pedido explícito da tarefa, desde que o solicitante tenha autoridade para mudar o modelo físico. |

### O que os desenvolvedores precisam fazer após o pull

Ordem usual após entrar uma PR que mexe em banco:

1. `git pull` na branch atualizada.
2. Na pasta **`api/`**: instalar dependências se necessário (`npm ci` / `pnpm install`, conforme o projeto).
3. Aplicar migrations pendentes no banco local (ex.: `npx prisma migrate deploy` ou fluxo equivalente documentado pelo time).
4. Regenerar o cliente: `npx prisma generate`.
5. Rebuild/restart da API e, se houver tipos compartilhados ou código que referencia colunas, rodar **typecheck** (`api` e `web` conforme scripts do monorepo).

Se algo falhar (migration já aplicada, drift, etc.), seguir o runbook interno de banco antes de forçar estado.

---

## Escopo do agente neste tipo de tarefa

- Vasculhar **`api/`** e **`web/`** (e pastas compartilhadas, ex. DTOs, queries raw, relatórios) por **nomes de coluna/campo** antigos e por `@map` / nomes Prisma.
- Atualizar **schema Prisma**, **migrations** (SQL idempotente / rename seguro), **serviços**, **DTOs**, **queries**, **testes** e **telas** que referenciem os campos.
- **Não** inventar nomes de tabela ou cardinalidade: usar exatamente os nomes acordados no pedido e conferir no schema atual antes de alterar.
- Manter **diff mínimo** fora do estritamente necessário para renomear e compilar.

---

## Prompt genérico (copiar e colar)

Substitua os blocos `[...]` pelos valores reais. Cole **somente** o texto entre os delimitadores abaixo (sem as linhas de crases externas se o destino não suportar markdown cru).

````text
Tarefa: alteração de banco + alinhamento de código (Prisma + API + web)

Contexto:
- Tabela física: [NOME_TABELA_POSTGRES]
- Alterações pedidas (lista explícita):
  - [ação: criar / renomear / alterar tipo / remover] coluna [nome_antigo] → [nome_novo] [(tipo, se criar/alterar tipo)]
  - (repetir para cada coluna)

Escopo estrito:
1. Localizar no repositório todas as referências aos nomes atuais dos campos (Prisma, SQL raw, DTOs, JSON de API, front, testes, seeds).
2. Produzir um mapa resumido: arquivo → trecho / uso (para revisão humana).
3. Alterar `api/prisma/schema.prisma` e adicionar migration em `api/prisma/migrations/` coerente com PostgreSQL (RENOMEAR coluna com `ALTER TABLE ... RENAME COLUMN ...` quando for só rename).
4. Atualizar todo código que quebraria após `prisma generate` e após aplicar a migration.
5. Não refatorar domínios não relacionados; não mudar regra de negócio além do necessário para o novo nome/tipo.

Pós-condição esperada para desenvolvedores após `git pull`:
- Rodar na pasta `api/`: `npx prisma migrate deploy` (ou comando que o time usa) e `npx prisma generate`.
- Projeto deve compilar (typecheck) nos pacotes afetados.

Ao terminar: listar arquivos alterados, comandos Prisma sugeridos e qualquer passo manual no banco legado (se existir).

Restrições do repositório: nomes de modelo/coluna conforme schema e convenções existentes; mensagens de commit/PR em pt-BR se houver commit.
````

---

## Exemplo pronto: renomear colunas em `tenacidade_configuracao`

Use este bloco como modelo concreto. O exemplo aqui é **ilustrativo** (verifique no `api/prisma/schema.prisma` se as colunas existem com esses nomes antes de mandar a tarefa); os domínios `tenacidade` e `usuario` são as referências canônicas do template para casos de exemplo.

````text
Tarefa: renomear colunas na tabela tenacidade_configuracao e alinhar código + Prisma

Na tabela física **tenacidade_configuracao**, renomear:

1. Coluna **dominio_tenacidade** → **dominio_tenacidade_canonico**
2. Coluna **chave_jwt** → **chave_jwt_assinatura**

(substitua pelos pares reais antes de mandar; estes são exemplos para a estrutura do prompt)

Passos obrigatórios:

1. Vasculhar no código (`api/`, `web/` e demais pastas relevantes) onde **dominio_tenacidade** e **chave_jwt** aparecem (incluindo nomes gerados pelo Prisma, `@map`, strings SQL e DTOs). Produzir uma lista dos arquivos e pontos de alteração.

2. Criar migration PostgreSQL que execute apenas os `RENAME COLUMN` necessários (nomes de tabela e colunas exatamente como acima).

3. Atualizar `schema.prisma` e todo o código que referencia os campos antigos para os novos nomes, mantendo comportamento igual salvo se o time pedir mudança de regra.

4. Garantir que, após `git pull`, um desenvolvedor possa rodar em `api/`: `npx prisma migrate deploy` e `npx prisma generate` sem erros de cliente Prisma ou TypeScript nos pontos tocados.

Não alterar outras tabelas nem nomes não listados. Diff mínimo fora do escopo dos dois renomes + ajustes de referência.

Ao terminar: resumo dos arquivos tocados e comandos Prisma recomendados.
````

> **Nota:** os domínios padrão do template para exemplos são **`tenacidade`** e **`usuario`** (esta ordem de preferência). Para tarefas reais, troque pelos nomes do domínio que você está alterando, conferindo a tabela física no schema antes.

---

## Manutenção deste documento

Arquivo em **`docs/prompts/banco/`** (junto aos demais prompts do repositório).

Ao mudar o fluxo oficial de migrations (ex.: só `migrate dev` em ambiente X), atualize a seção **O que os desenvolvedores precisam fazer após o pull** e, se existir runbook em `ai/` ou `docs/setup_inicial/`, referencie-o aqui em uma linha.
