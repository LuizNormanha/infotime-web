# Tela: Formulário de Conta Caixa
## Origem Scriptcase: `ContaCaixa_Frm`

### Campos
| Campo | Coluna DB | Tipo |
|---|---|---|
| Empresa | `id_empresa` | select |
| Banco | `id_banco` | select |
| Agência | `id_agencia` | select |
| Número Conta | `numero_conta` | text |
| Descrição | `descricao` | text |
| Tipo Conta | `tipo_conta` | select (C=Corrente/P=Poupança/X=Caixa) |
| Data Abertura | `data_abertura` | date |
| Tipo Abertura | `tipo_abertura` | select |
| Tipo Fechamento | `tipo_fechamento` | select |
| Data Início Caixa | `data_inicio_caixa` | date |
| Saldo Inicial | `saldo_inicio_caixa` | decimal |
| Entra Extrato | `entra_extrato` | checkbox |
