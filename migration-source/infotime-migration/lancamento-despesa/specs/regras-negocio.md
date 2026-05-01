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
