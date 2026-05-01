# Regras de Negócio — almoxarifado-entrada

## Entrada de Produtos
- Ao salvar: criar movimentações de entrada em `almoxarifado_produto_estoque`
- Tipo = 'E', quantidade = qtd da entrada

## Parcelas → Despesa
- Cada parcela pode virar um `lancamento_despesa` automaticamente
- Manter vínculo via `lancamento_despesa.id_almoxarifado_entrada`

## Importação XML
- Upload de arquivo XML NF-e
- Parser extrai: fornecedor, produtos, valores, parcelas
- Criar entrada automaticamente

## Validação de Temperatura
- Produtos com temperatura configurada exigem validação ao receber
- Registrar temperatura de recebimento
