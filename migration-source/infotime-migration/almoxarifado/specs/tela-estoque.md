# Tela: Posição de Estoque
## Origem Scriptcase: `AlmoxarifadoProdutoEstoque_Lst`

### Colunas
| Coluna | Campo DB |
|---|---|
| Produto | `almoxarifado_produto.descricao` |
| Almoxarifado | `almoxarifado.sigla` |
| Lote | `almoxarifado_produto_estoque.lote` |
| Data Validade | `data_validade` |
| Quantidade | Σ de movimentações E - S |
| Valor Total | calculado |

### Alertas
- Estoque abaixo do mínimo: destacar em vermelho
- Produto próximo do vencimento: destacar em laranja
