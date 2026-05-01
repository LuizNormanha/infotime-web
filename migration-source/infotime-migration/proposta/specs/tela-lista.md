# Tela: Lista de Propostas
## Origem Scriptcase: `Proposta_Lst`

### Colunas Exibidas
| Coluna | Campo DB |
|---|---|
| Número | `proposta.id_proposta` |
| Cliente | `cliente.nome_fantasia` |
| Situação | situacao via `situacao_proposta` |
| Tipo Contrato | `tipo_contrato.descricao` |
| Empresa | `empresa.nome_fantasia` |
| Data Inclusão | `proposta.data_inclusao` |
| Valor | calculado dos itens |

### Situações de Proposta
- `P` = Pendente (em aberto)
- `F` = Fechada (convertida em contrato)
- `C` = Cancelada
