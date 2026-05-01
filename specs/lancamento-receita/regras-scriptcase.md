# Regras Scriptcase — lancamento-receita

## events.md (corpus)

```markdown
# Eventos Scriptcase — lancamento-receita

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
# Regras de Negócio — lancamento-receita

## Parcelamento
- `parcela`: número da parcela atual (0 = avulso)
- `id_lancamento_receita_pai`: link para o lançamento principal
- Ao parcelar: criar N lançamentos filhos com datas incrementadas

## Recorrência
- `id_lancamento_receita_recorrente`: template recorrente
- Job/cron: gerar lançamentos futuros automaticamente

## Baixa
- Atualizar: `data_realizacao`, `valor_realizacao`, `data_baixa`
- Registrar: `idusuario_baixa`
- Mudar situação para "Baixado"
- Se tiver boleto: baixar o boleto correspondente
- Se tiver nota fiscal: verificar integração

## E-mail de Cobrança
- Enviar para contato com `recebe_cobranca = 'S'`
- Registrar em `email_enviado`
- Marcar `enviou_email_cobranca = 'S'`
- Tracking de leitura: `lido_email_cobranca`

## Rateio
- Um lançamento pode ser rateado entre empresas/planos via `lancamento_receita_rateio`
- Soma dos rateios deve = valor total
- Validar ao salvar

## Fechamento Financeiro
- `fechamento_financeiro = 'S'`: lançamento em período fechado
- Bloquear alteração de lançamentos em períodos fechados
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
