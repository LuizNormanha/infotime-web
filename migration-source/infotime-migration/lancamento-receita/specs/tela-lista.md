# Tela: Lista de Lançamentos de Receita
## Origem Scriptcase: `LancamentoReceita_Lst`

### Colunas
| Coluna | Campo DB |
|---|---|
| Cliente | `cliente.nome_fantasia` |
| Empresa | `empresa.nome_fantasia` |
| Plano de Conta | `plano_conta.descricao` |
| Conta Caixa | `conta_caixa.descricao` |
| Situação | `situacao_documento.descricao` |
| Espécie | `tipo_especie.descricao` |
| Data Previsão | `lancamento_receita.data_previsao` |
| Valor Previsão | `lancamento_receita.valor_previsao` |
| Data Realização | `lancamento_receita.data_realizacao` |
| Valor Realização | `lancamento_receita.valor_realizacao` |
| Parcela | `lancamento_receita.parcela` |

### Views Derivadas
- **Em Atraso**: `LancamentoReceita_Atraso_Lst` — previsão < hoje, situação = pendente
- **Boletos**: `LancamentoReceita_Boleto_Lst` — com boleto emitido
- **Baixados**: `LancamentoReceita_Baixa_Lst` — situação = baixado
