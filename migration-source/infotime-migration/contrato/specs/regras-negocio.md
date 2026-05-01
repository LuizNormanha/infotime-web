# Regras de Negócio — contrato

## Ciclo de Vida
1. Criado a partir de uma Proposta aceita
2. Tarefas de implantação geradas automaticamente
3. Situação: Ativo → Cancelado / Encerrado

## Cancelamento
- Obrigatório: `data_cancelamento` + `motivo_cancelamento`
- Registrar `id_usuario_cancelamento`

## Reajuste
- `id_indice_reajuste` → busca percentual em `indice_reajuste_data` para a data de referência
- Atualizar `contrato_item.valor_unitario` com reajuste aplicado
- Registrar histórico no campo `historico` (texto livre)

## Financeiro
- `dia_vencimento`: dia do mês para geração de lançamentos de receita
- Gerar lançamentos mensais automaticamente com base nos itens ativos
