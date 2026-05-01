# Regras Scriptcase — grupo-usuario

## events.md (corpus)

```markdown
# Eventos Scriptcase — grupo-usuario

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

_Nenhum evento customizado detectado automaticamente. Verificar manualmente os arquivos .php._


## Mapeamento para o Novo Sistema

| Evento SC | Equivalente Novo | Observação |
|---|---|---|
| `onLoad` | ngOnInit / useEffect | Inicialização do componente |
| `onValidate` | Zod/Yup schema | Validação de formulário |
| `onAfterInsert` | Hook pós-save | Lógica após inserção |
| `onAfterUpdate` | Hook pós-update | Lógica após atualização |
| `sc_mail_send` | Nodemailer / SES | Envio de e-mail |
| `sc_redir` | navigate() / redirect | Redirecionamento |
| `sc_exec_sql` | Repository/Query | Execução de SQL |
| `sc_lookup` | API GET | Busca de dados |
```

## Trechos consolidados do corpus (specs)

```markdown
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
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
