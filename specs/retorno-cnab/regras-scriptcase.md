# Regras Scriptcase — retorno-cnab

## events.md (corpus)

```markdown
# Eventos Scriptcase — retorno-cnab

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
# Regras de Negócio — retorno-cnab

## Formatos Suportados
- CNAB 240 (padrão Febraban para grandes bancos)
- CNAB 400 (padrão mais antigo)

## Processamento
1. Ler arquivo linha por linha
2. Identificar ocorrências de pagamento (código de ocorrência)
3. Cruzar `nosso_numero` com `lancamento_receita.nosso_numero`
4. Baixar automaticamente: atualizar situação, data baixa, valor
5. Registrar histórico em `retorno.historico_pagamento`

## Erros
- Título não encontrado: registrar em `historico_registro`
- Valor divergente: alertar para revisão manual
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
