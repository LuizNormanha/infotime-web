# Regras de Negócio — almoxarifado

## Controle de Estoque
- Cada movimentação em `almoxarifado_produto_estoque`
- `tipo_movimentacao = 'E'`: entrada
- `tipo_movimentacao = 'S'`: saída
- Saldo = Σ(E) - Σ(S) por produto + almoxarifado + lote

## Ponto de Pedido
- `tipo_ponto_pedido = 'P'`: % do estoque máximo
- `tipo_ponto_pedido = 'Q'`: quantidade absoluta
- Alertar quando estoque ≤ ponto de pedido

## Controle por Grupo
- `tipo_controle_estoque = 'P'`: controla por produto individual
- `tipo_controle_estoque = 'G'`: controla somando todo o grupo

## Validade e Lote
- `tipo_validade = 'S'`: validade informada → obrigatório `data_validade`
- `tipo_validade = 'I'`: indeterminada
- Rastrear por lote para recall/qualidade

## Temperatura
- Campos: `temperatura_recebimento`, `temperatura_transporte`, `temperatura_padrao`
- Crítico para produtos farmacêuticos/biológicos

## Importação XML (NF-e)
- Parser de XML da nota fiscal eletrônica
- Criar entrada automaticamente a partir do XML
