# Regras Scriptcase — almoxarifado-entrada

## events.md (corpus)

```markdown
# Eventos Scriptcase — almoxarifado-entrada

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
# Regras de Negócio — almoxarifado-entrada

## Entrada de Produtos
- Ao salvar: criar movimentações de entrada em `almoxarifado_produto_estoque`
- Tipo = 'E', quantidade = qtd da entrada

## Parcelas → Despesa
- Cada parcela pode virar um `lancamento_despesa` automaticamente
- Manter vínculo via `lancamento_despesa.id_almoxarifado_entrada`

## Importação XML
- Upload de arquivo XML NF-e
- Parser extrai: fornecedor, produtos, valores, parcelas
- Criar entrada automaticamente

## Validação de Temperatura
- Produtos com temperatura configurada exigem validação ao receber
- Registrar temperatura de recebimento
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
