# Tela: Lista de Contratos
## Origem Scriptcase: `Contrato_Lst`

### Colunas Exibidas
| Coluna | Campo DB |
|---|---|
| ID | `contrato.id_contrato` |
| Cliente | `cliente.nome_fantasia` |
| Tipo | `tipo_contrato.descricao` |
| Situação | `situacao_contrato` (A/C/X) |
| Data Início Implant. | `data_inicio_implantacao` |
| Data Fim Implant. | `data_fim_implantacao` |
| Empresa | `empresa.nome_fantasia` |

### Situações
- `A` = Ativo
- `C` = Cancelado (com motivo)
- `X` = Encerrado
