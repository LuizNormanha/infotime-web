# Tela: Aniversários de Contratos
## Origem Scriptcase: `ContratoAniversario_Lst`

### Propósito
- Listar contratos com vencimento/renovação próxima
- Filtrar por período (mês/trimestre)
- Acionar renovação ou cancelamento

### Colunas
| Coluna | Campo DB |
|---|---|
| Cliente | `cliente.nome_fantasia` |
| Tipo Contrato | `tipo_contrato.descricao` |
| Data Início | `contrato_item.data_inicio_contrato` |
| Data Fim | `contrato_item.data_fim_contrato` |
| Dias p/ Vencimento | calculado |
