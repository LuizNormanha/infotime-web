# Regras Scriptcase — lancamento-despesa

## events.md (corpus)

```markdown
# Eventos Scriptcase — lancamento-despesa

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
# Regras de Negócio — lancamento-despesa

## Estágios de Workflow (5 usuários)
1. **Inclusão**: `id_usuario_inclusao`, `data_inclusao`
2. **Previsão**: `id_usuario_previsao`, `data_previsao`, `valor_previsao`
3. **Agendamento**: `id_usuario_agendamento`, `data_agendamento`
4. **Realização**: `id_usuario_realizacao`, `data_realizacao`, `valor_realizacao`
5. **Baixa**: `id_usuario_baixa`, `data_baixa`

## Parcelamento
- Gerar N lançamentos filhos via `id_lancamento_despesa_pai`
- Distribuir valor total entre as parcelas

## Recorrência
- Similar à receita: `id_lancamento_despesa_recorrente`

## Vinculação com Almoxarifado
- `id_almoxarifado_entrada`: quando despesa origina de entrada de NF do almoxarifado
- Manter rastreabilidade compra → despesa

## Fechamento Financeiro
- Bloquear alterações em períodos com `fechamento_financeiro` ativo

## Rateio
- Rateio entre empresas/planos via `lancamento_despesa_rateio`
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
