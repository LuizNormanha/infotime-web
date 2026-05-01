# Regras de Negócio — grupo-usuario

## Modelo RBAC
- Usuário → N grupos → N aplicações com permissões CRUD
- Permissões são aditivas: se usuário tem 2 grupos, recebe a união das permissões
- Administrador bypassa todo RBAC

## Granularidade
1. **Nível aplicação**: consulta/inclusão/exclusão/alteração/exportação/impressão
2. **Nível bloco**: seções da tela que podem ser ocultadas
3. **Nível campo**: visibilidade individual de campo (oculto/leitura/edição)

## Checklist de Implementação
- [ ] Endpoint de permissões: `GET /me/permissions`
- [ ] Middleware de autorização por rota
- [ ] Hook/HOC no frontend para ocultar elementos por permissão
- [ ] Cache de permissões (Redis recomendado, TTL curto)
