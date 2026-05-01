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
