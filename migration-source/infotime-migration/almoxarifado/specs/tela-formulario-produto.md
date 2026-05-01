# Tela: Formulário de Produto
## Origem Scriptcase: `AlmoxarifadoProduto_Frm`

### Campos
| Campo | Coluna DB | Tipo |
|---|---|---|
| Sigla | `sigla` | text |
| Código | `codigo` | text |
| Descrição | `descricao` | text |
| Código Externo | `codigo_externo` | text |
| Código Barras | `codigo_barras` | text |
| Grupo | `id_almoxarifado_produto_grupo` | select |
| Classificação | `id_almoxarifado_produto_classificacao` | select |
| Volume Padrão | `id_almoxarifado_produto_volume` | select |
| Fornecedor | `id_fornecedor` | select |
| Local Armazenamento | `id_almoxarifado_produto_local_armazenamento` | select |
| Estoque Mínimo | `estoque_minimo` | decimal |
| Estoque Máximo | `estoque_maximo` | decimal |
| Ponto de Pedido | `valor_ponto_pedido` | decimal |
| Tipo Ponto Pedido | `tipo_ponto_pedido` | select (P=Percentagem/Q=Quantidade) |
| Ativo | `ativo` | checkbox |
