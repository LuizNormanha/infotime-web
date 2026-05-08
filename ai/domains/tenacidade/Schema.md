# Schema — tenacidade

Estrutura física e relacionamentos: consulte `api/prisma/schema.prisma` (modelos Prisma) e as migrations do repositório.

Tabelas físicas relevantes (nomes via `@@map` no Prisma):

| Tabela | Papel |
|--------|-------|
| `tenacidade` | Identidade do tenant: identificador, status (`ativo`), auditoria. |
| `tenacidade_configuracao` | Configuração canônica do laboratório/cliente: `dominio_tenacidade`, `data_expiracao`, `quantidade_licenca`, `chave_jwt`, `razao_social`, `nome_fantasia`, `chave_acesso`, `ultimo_ano`, `ultimo_atendimento`. |

> **Nota:** `tenacidade` e `tenacidade_configuracao` **não usam RLS** (ver migrations de remoção de RLS no schema atual).

Não inventar colunas, FKs ou cardinalidade fora do que está versionado no schema.
