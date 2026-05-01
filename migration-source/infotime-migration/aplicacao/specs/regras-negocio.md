# Regras de Negócio — aplicacao

## Catálogo de Aplicações
- Cada tela/módulo do sistema é uma "aplicação"
- Usado como base para o RBAC (grupo_usuario_aplicacao)
- Nome deve ser único (UNIQUE INDEX)

## Sincronização
- `aplicacao_sync`: sincroniza lista de aplicações entre ambientes
- Facilita migração de permissões entre dev/staging/prod

## No Novo Sistema
- "Aplicação" = rota/módulo do frontend
- Manter o mesmo catálogo para compatibilidade com grupos já configurados
- Mapear: nome_antigo_scriptcase → rota_nova (ex: `Cliente_Lst` → `/clientes`)
