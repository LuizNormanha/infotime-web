# Padrão Tenancy e Auditoria

## Tenancy

- `id_tenacidade` obtido do **usuário autenticado** / JWT após validação.
- **Nunca** aceitar `id_tenacidade` livre do frontend em operações CRUD padrão (exceções administrativas globais, se existirem, exigem role específica e trilha de auditoria reforçada).
- **Repository:** primeiro parâmetro de escopo ou objeto de contexto contendo `tenantId`; todas as queries filtram por tenant.

## Auditoria

- Em mutações (insert/update/delete lógico), preencher automaticamente quando o modelo tiver campos equivalentes ao legado:
  - usuário da operação
  - IP de origem
  - aplicação/código da operação
  - entidade e tipo de operação
  - diff ou snapshot quando possível
- Implementação sugerida: **middleware Prisma** ou **helper** chamado pelos services antes do `create`/`update`.

## Configuração

- Se `configuracao.gravar_auditoria = 'S'` (ou equivalente), auditoria ativa; caso contrário, avaliar se ainda registramos mínimo para compliance (definir por decisão de produto).

## Logs

- Auditoria de negócio (tabela `auditoria` ou similar) separada de logs técnicos da aplicação (stdout/APM).
