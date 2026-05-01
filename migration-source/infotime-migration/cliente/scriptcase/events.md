# Eventos Scriptcase — cliente

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `Cliente_Lst`

### Queries SQL encontradas
- `SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \`
- `SELECT IdAplicacao FROM aplicacao WHERE Nome = '`
- `SELECT Descricao, IdSituacaoCliente FROM situacaocliente WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_a`
- `SELECT Descricao, IdTipoCliente FROM tipocliente WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_apos LIKE`
- `SELECT Descricao, IdClienteCanal FROM clientecanal WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_apos LI`


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
