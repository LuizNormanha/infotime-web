# Tela: Vale Alimentação e Transporte
## Origem Scriptcase: `ColaboradorValeAlimentacaoTransporte_Frm`

### Campos
| Campo | Coluna DB | Tipo |
|---|---|---|
| Período | `id_vale_alimentacao_transporte` | select |
| VA/Dia | `vale_alimentacao_dia` | decimal |
| VT/Dia | `vale_transporte_dia` | decimal |
| Dias Úteis | `quantidade_dias_uteis` | smallint |
| Dias Faltas | `quantidade_dias_faltas` | smallint |

> Total VA = VA/dia × (dias_uteis - dias_faltas)
