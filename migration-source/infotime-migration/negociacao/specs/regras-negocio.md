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
