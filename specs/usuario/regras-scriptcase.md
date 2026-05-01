# Regras Scriptcase — usuario

## events.md (corpus)

```markdown
# Eventos Scriptcase — usuario

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `Usuario_Lst`

### Queries SQL encontradas
- `SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \`
- `SELECT IdAplicacao FROM aplicacao WHERE Nome = '`


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
# Regras de Negócio — usuario

## Criação
- Login deve ser único (UNIQUE INDEX)
- Senha inicial enviada por e-mail ou definida pelo admin
- Ao criar, associar a um ou mais grupos de usuário

## Permissões Especiais
- `indicador_financeiro = 'S'`: pode ver dados financeiros sensíveis
- `acesso_auditoria = 'S'`: pode ver trilha de auditoria
- `acesso_autorizacoes = 'S'`: pode gerenciar autorizações
- `administrador = 'sim'`: bypass total de permissões de grupo

## Limites de Desconto
- `desconto_maximo_imp`: limite de desconto na implantação (%)
- `desconto_maximo_mes`: limite de desconto no mensalismo (%)
- Validar na geração de proposta/contrato
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
