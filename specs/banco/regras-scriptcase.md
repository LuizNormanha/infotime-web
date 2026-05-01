# Regras Scriptcase — banco

## events.md (corpus)

```markdown
# Eventos Scriptcase — banco

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
# Regras de Negócio — banco

## Configuração de Boleto
- Campos no `banco`: agencia_boleto, conta_boleto, convenio_boleto, carteira_boleto
- Esses dados são usados na geração de boletos CNAB

## Bandeiras de Cartão
- `taxa_cartao`: taxa por bandeira, por conta caixa
- `tipo_cartao`: 'CD'=débito, 'CC'=crédito
- `taxa_adiantamento`: taxa para recebimento antecipado

## Configuração de Cobrança
- Define comportamento para cada combinação: conta × espécie × bandeira
- `baixa_automatica`: baixar automaticamente após N dias
- `qtd_dias`: dias para baixa automática ou repasse do cartão
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
