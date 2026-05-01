# Regras Scriptcase — boleto

## events.md (corpus)

```markdown
# Eventos Scriptcase — boleto

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `GerarBoleto_Blk`

### Queries SQL encontradas
- `SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \`


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
# Regras de Negócio — boleto

## Geração
- `nosso_numero`: sequencial único por banco/carteira
- `codigo_barras`: calculado conforme padrão CNAB do banco
- Gerar PDF via biblioteca de boletos (ex: BoletoPHP, Laravel Boleto)

## Vínculo
- `boleto_nota_fiscal`: um boleto pode estar vinculado a uma NF
- Um lançamento de receita pode ter um boleto associado

## Baixa via CNAB
- Arquivo de retorno do banco marca boleto como pago
- Atualizar: `data_pagamento`, `valor_pagamento`, situação

## Cálculos
- Juros: `percentual_por_dia_juros` × dias em atraso × valor
- Multa: `percentual_multa` × valor original (cobrada uma vez)
- Desconto: `valor_outras_deducoes`
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
