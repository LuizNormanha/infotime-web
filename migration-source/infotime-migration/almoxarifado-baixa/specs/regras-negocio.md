# Regras de Negócio — almoxarifado-baixa

## Tipos de Motivo
- Validade expirada
- Descarte
- Quebra/Dano
- Outros

## Rastreabilidade
- Registrar: usuário, data/hora, lote, quantidade
- Criar movimentação de saída em `almoxarifado_produto_estoque`

## Bloqueios
- Não permitir baixa de quantidade maior que o estoque atual
- Validar lote ao realizar baixa por lote específico
