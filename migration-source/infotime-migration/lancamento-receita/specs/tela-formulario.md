# Tela: Formulário de Lançamento de Receita
## Título real: "Inclusão Conta a Receber (Receita)"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório | Nota |
|---|---|---|---|
| Agente | radio (Cliente / Colaborador / Fornecedor) | Sim | Define qual campo de busca aparece |
| Cliente (Nome Fantasia - CNPJ / CPF) | autocomplete | Sim | |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa | select | Sim |
| Plano de Contas | select | |
| Valor bruto | decimal + calculadora | |
| Valor previsto | decimal + calculadora | Sim |
| Previsto para | date | Sim |
| Competência | month/year | auto: mês atual |
| Situação | select | Sim — default: Pendente |
| Histórico | text | |

### Aba: Recebimento
_(data realização, valor realização, acréscimos, descontos, multa, juros, espécie, conta caixa)_

### Aba: Observações
_(texto livre)_

### Aba: Arquivos
_(upload de comprovante, boleto, nota fiscal)_

### Aba: Auditoria
_(histórico de alterações do registro)_

### Ações disponíveis
- **Incluir**: salvar
- **Ações ▾**: parcelamento, recorrência, rateio, gerar boleto, etc.
- **Voltar**: retornar
