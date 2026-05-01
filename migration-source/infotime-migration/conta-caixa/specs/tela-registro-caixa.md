# Tela: Registro de Caixa (Fechamento Diário)
## Origem Scriptcase: `ContaCaixaRegistro_Frm`

### Campos
| Campo | Coluna DB |
|---|---|
| Conta Caixa | `id_conta_caixa` |
| Data Referência | `data_referencia` |
| Situação | `situacao` (A=Aberto/F=Fechado) |
| Saldo Inicial | `saldo_inicial` |
| Saldo Final | `saldo_final` (calculado) |

### Lançamentos do Registro (`conta_caixa_registro_lancamento`)
| Campo | Coluna DB |
|---|---|
| Data | `data_lancamento` |
| Origem | `origem` (R=Receita/D=Despesa) |
| Espécie | `id_tipo_especie` |
| Valor | `valor_lancamento` |
