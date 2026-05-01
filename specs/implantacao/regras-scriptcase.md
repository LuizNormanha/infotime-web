# Regras Scriptcase — implantacao

## events.md (corpus)

```markdown
# Eventos Scriptcase — implantacao

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
# Regras de Negócio — implantacao

## Geração de Tarefas
- Ao criar contrato, copiar todas as tarefas de `categoria_produto_tarefa` dos produtos do contrato
- Módulo define a ordem: Iniciais (1) → Implantação (2) → Finais (3)

## Tipos de Tarefa
- `S` = Sintética: tarefa agrupadora (não tem atividade direta)
- `A` = Analítica: tarefa executável

## Workflow de Atividades (`contrato_tarefa_atividade`)
- Registra transição de situações: `de` → `para`
- Campos de tempo: `data_hora_inicio`, `data_hora_execucao`, `data_hora_fim`, `data_hora_retorno`
- Suporta até 5 arquivos anexos por atividade

## Nível de Prioridade
- 1 = Baixa
- 2 = Média
- 3 = Alta
- Ordenar por nível + módulo + prazo

## Exige Arquivo
- Se `exige_arquivo = 'S'`: bloquear conclusão sem upload de evidência
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
