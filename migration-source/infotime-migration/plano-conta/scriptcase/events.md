# Eventos Scriptcase — plano-conta

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `Dre_Lst`

### Queries SQL encontradas
- `SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \`
- `SELECT IdPlanoConta, Classificador, Descricao, Tipo, Custo, CodigoContaDre, CalculoDre, Origem `
- `SELECT Janeiro, Fevereiro, Marco, Abril, Maio, Junho, Julho, Agosto, Setembro, Outubro, Novembro, De`
- `SELECT IdAplicacao FROM aplicacao WHERE Nome = '`
- `SELECT IdPlanoConta, Classificador, Descricao, Tipo, Custo, CodigoContaDre, CalculoDre, Origem `


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
