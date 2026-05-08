# Estrutura da API (`api/src`)

Separação conceitual entre o que é **infraestrutura do template** (quase todo produto precisa) e o que é **domínio de negócio** (muda a cada derivado). Não é obrigatório mover pastas agora; use este documento como mapa.

## Módulos perenes (shell / transversal)

Costumam permanecer ao portar um novo banco e novas regras:

| Área | Exemplos de pastas / responsabilidade |
|------|----------------------------------------|
| Bootstrap | `main.ts`, `app.module.ts` — composição dos módulos. |
| Configuração | `config/`, variáveis de ambiente, CORS, throttling. |
| Prisma | `prisma/prisma.service.ts`, `prisma/prisma.module.ts`, [`set-current-tenant-local`](../api/src/prisma/set-current-tenant-local.ts), RLS/tenant storage. |
| Autenticação | `autenticacao/` ou equivalente — login, JWT, sessão, permissões. |
| Comum | `comum/` — filtros de listagem, paginação, tipos de tenant, utilitários compartilhados. |

Qualquer novo módulo de negócio deve **reutilizar** autenticação, tenant e padrões de DTO/validação já usados nestes módulos.

## Domínio de exemplo (InfoTIME / legado)

Grande parte das pastas em `api/src/` com controllers REST nomeados por entidade de negócio (clientes, convênios, faturas, usuários, etc.) representam o **domínio InfoTIME** atual, espelhado no `schema.prisma` com tabelas prefixadas (`infolab_*` no Prisma).

Em um **projeto derivado**:

- Remova ou substitua módulos que não existam no novo schema.
- Mantenha a **forma** (Nest module + controller + service + DTOs) como referência de CRUD.
- Mensagens de erro e textos voltados ao usuário final devem usar vocabulário do **novo** produto, não nomes internos de tabela.

## Evolução gradual

Não é necessário renomear todos os models Prisma de uma vez (isso implica migração de banco). O template pode conviver com `infolab_*` enquanto o BD for InfoTIME; produtos novos podem introduzir models com nomes neutros à medida que o schema for reescrito.
