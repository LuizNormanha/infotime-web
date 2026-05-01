# Regras de Negócio — almoxarifado-requisicao

## Tipos
- `E` = Estoque: retirada de produto do almoxarifado
- `C` = Compra: pedido de compra (gera entrada futura)

## Situações da Requisição
- `P` = Pendente
- `A` = Atendida (todos os itens atendidos)
- `R` = Parcialmente atendida
- `N` = Não atendida

## Situações por Item
- `P` = Pendente
- `A` = Atendido
- `R` = Atendido parcialmente
- `N` = Negado

## Atendimento
- Ao atender: criar saída em `almoxarifado_produto_estoque` (tipo = 'S')
- Verificar saldo disponível antes de atender
- Atualizar `quantidade_atendida` e `situacao_item`
- Recalcular situação geral da requisição

## Usuários Autorizados
- `almoxarifado_usuario_atender`: controla quem pode atender requisições por almoxarifado
