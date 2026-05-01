# Tela: Formulário de Contrato
## Origem Scriptcase: `Contrato_Frm`

### Campos Principais
| Campo | Coluna DB | Tipo |
|---|---|---|
| Cliente | `id_cliente` | select |
| Proposta Origem | `id_proposta` | select (readonly) |
| Tipo Contrato | `id_tipo_contrato` | select |
| Empresa | `id_empresa` | select |
| Índice Reajuste | `id_indice_reajuste` | select |
| Colaborador Implant. | `id_colaborador_implantacao` | select |
| Dia Vencimento | `dia_vencimento` | integer |
| Situação | `situacao_contrato` | select |
| Data Cancelamento | `data_cancelamento` | date |
| Motivo Cancelamento | `motivo_cancelamento` | textarea |

### Itens do Contrato (grid `contrato_item`)
| Campo | Coluna DB |
|---|---|
| Produto | `id_produto` |
| Descrição | `descricao` |
| Valor Unitário | `valor_unitario` |
| Data Início Contrato | `data_inicio_contrato` |
| Data Fim Contrato | `data_fim_contrato` |
| Ativo | `ativo` |
