# Schema — usuario

Estrutura física e relacionamentos: consulte `api/prisma/schema.prisma` (modelos Prisma) e as migrations do repositório.

Tabelas físicas relevantes (nomes via `@@map` no Prisma):

| Tabela | Papel |
|--------|-------|
| `usuario` | Conta de acesso ao sistema. |
| `grupo_usuario` | Agrupamento de permissões / papel (ex.: Administrador, Atendente). |
| `usuario_permissoes` | Permissões finas por usuário/tela. |
| `unidade` | Unidade física/organizacional vinculada ao usuário. |

Não inventar colunas, FKs ou cardinalidade fora do que está versionado no schema.
