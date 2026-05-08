# Schema — login

Estrutura física e relacionamentos: consulte `api/prisma/schema.prisma` (modelos Prisma) e as migrations do repositório.

Tabelas físicas relevantes (nomes via `@@map` no Prisma):

| Tabela | Papel |
|--------|-------|
| `tenacidade` | Identidade do tenant (ativo, auditoria). |
| `tenacidade_configuracao` | Configuração canônica do laboratório (domínio, expiração, limites, `chave_jwt`). |
| `usuario` | Conta de acesso ao sistema (login, senha, vínculo com tenacidade e grupo). |
| `sessao_usuario` | Sessão ativa de usuário comum (controle de licença simultânea). |
| `sessao_suporte` | Sessão de usuários `suporte` / `implantacao` (sem limite de licenças). |

Não inventar colunas, FKs ou cardinalidade fora do que está versionado no schema.
