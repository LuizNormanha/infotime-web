# Tela: Reajuste de Colaborador
## Origem Scriptcase: `ColaboradorReajuste_Frm`

### Campos
| Campo | Coluna DB | Tipo |
|---|---|---|
| Colaborador | `id_colaborador` | select |
| Motivo | `id_motivo_reajuste` | select |
| Data Reajuste | `data_reajuste` | date |
| Nível (novo) | `id_cargo_classificacao_nivel` | select |
| Valor Atual | `valor_atual` | decimal (readonly) |
| Índice Reajuste % | `indice_reajuste` | decimal |
| Valor Reajustado | `valor_reajustado` | decimal (calculado) |
