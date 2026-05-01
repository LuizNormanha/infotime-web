# Regras Scriptcase — negociacao

## events.md (corpus)

```markdown
# Eventos Scriptcase — negociacao

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `Negociacao_Pipeline_Blk`

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
# Regras de Negócio — negociacao

## Funil de Vendas
- Negociação é vinculada a um cliente e um tipo de negócio
- Cada negociação percorre as fases configuradas em `proposta_fase`
- Para cada fase: uma entrada em `negociacao_proposta_fase`
- Fases têm `valor_percentual` (probabilidade de fechamento)

## Tarefas por Fase
- Cada fase pode ter N tarefas (`negociacao_tarefa`)
- Tarefa tem: colaborador responsável, data execução, data retorno, situação
- Situações: via tabela `situacao_tarefa`

## Perda de Negociação
- Ao marcar fase como perdida: `situacao_fase` = perdida
- Obrigatório informar `id_negociacao_motivo_perda`
- Registrar `data_encerramento` e `observacoes`

## Ganho de Negociação
- Negociação ganha → gera `proposta` automaticamente
- `negociacao.ativo = 'S'` enquanto em andamento

## Indicadores
- Taxa de conversão por fase
- Motivos de perda mais frequentes
- Evolução temporal (ganhos × perdas)
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
