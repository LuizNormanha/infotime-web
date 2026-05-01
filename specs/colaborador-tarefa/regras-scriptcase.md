# Regras Scriptcase — colaborador-tarefa

## events.md (corpus)

```markdown
# Eventos Scriptcase — colaborador-tarefa

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
# Regras de Negócio — colaborador-tarefa

## Prioridade
- A = Alta (vermelho)
- M = Média (amarelo)
- B = Baixa (verde)

## Prorrogação
- Registrar em `colaborador_tarefa_historico` cada alteração de prazo
- Motivo da prorrogação via `colaborador_tarefa_motivo_prorrogacao`
- Contador `qtd_alteracao_data`: quantas vezes o prazo foi alterado

## Lembretes
- `EnviarLembreteTarefa_Blk`: enviar e-mail de lembrete de tarefa atrasada
- Configurar job diário para alertas de tarefas vencendo

## Dashboard
- `TarefasHoje_Lst`: tarefas previstas para hoje
- `TarefasAtrasadas_Lst`: tarefas com previsão passada e não concluídas
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
