# Regras Scriptcase — aplicacao

## events.md (corpus)

```markdown
# Eventos Scriptcase — aplicacao

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
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
