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

## Domínio legado e derivação

Em projetos derivados:

- Remova ou substitua módulos que não pertençam ao novo escopo.
- Mantenha a forma base (module + controller + service + DTOs) para novos CRUDs.
- Evite expor nomes internos de tabela em mensagens de API.

## Evolução

Renomeações amplas de models Prisma devem ser planejadas com cuidado, pois podem exigir migração de banco e ajustes de integração.
