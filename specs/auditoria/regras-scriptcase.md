# Regras Scriptcase — auditoria

## events.md (corpus)

```markdown
# Eventos Scriptcase — auditoria

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `Auditoria_Lst`

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
# Regras de Negócio — auditoria

## Quando Registrar
- Habilitado via `configuracao.gravar_auditoria = 'S'`
- Operações: I=Insert, U=Update, D=Delete

## O que Registrar
- Em `auditoria`: quem, quando, onde, qual operação, qual registro
- Em `auditoria_campo`: quais campos foram alterados (antes × depois)

## Implementação no Novo
- Usar interceptors/middleware na camada de serviço
- Considerar mensageria (Kafka/RabbitMQ) para logs assíncronos
- Separar banco de dados de auditoria (recomendado)

## Retenção
- Definir política de retenção (ex: 12 meses)
- Particionamento da tabela por data
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
