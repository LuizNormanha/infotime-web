# 03 — Duplicidades e versões do corpus

## Modelo evolutivo

Os pacotes **`v0`, `v1`, `v2` e `v3`** são **evolutivos**:

- **Versão mais recente prevalece** para conteúdo equivalente (mesma entidade, mesma regra, mesmo campo).
- Versões **antigas** servem para **recuperar detalhe ausente** na versão nova (regra extra, tabela esquecida, nota em spec).

## Conteúdo duplicado

- **Não** gerar documentos duplicados no repositório (dois `PADRAO_*` dizendo o mesmo, duas specs da mesma entidade sem necessidade).
- Quando o mesmo fato aparecer em `files_v2` e `files_v3`, manter **uma** seção canônica e, se útil, uma nota “confirmado em v2” em [`02_ENTIDADES_E_ARTEFATOS.md`](02_ENTIDADES_E_ARTEFATOS.md) ou em `specs/[entidade]/duvidas-abertas.md`.

## Registro de diffs importantes

Para divergências materiais (campo removido, regra alterada, prioridade diferente):

1. Registrar em **uma linha** na tabela de entidade ou em `duvidas-abertas.md`.
2. Indicar **qual versão** foi usada como decisão final (normalmente **v3**).

## `files_*` vs `infotime-migration_*`

- `files_v*`: visão **transversal** (índice, regras agregadas, arquitetura em poucos arquivos).
- `infotime-migration_v*`: corpus **por entidade** (artefato completo).

Conflito entre um markdown em `files_v3` e uma spec em `infotime-migration_v3` para a mesma entidade: **prevalência ao material dentro da pasta da entidade** no migration v3, e mencionar o conflito na spec.
