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
