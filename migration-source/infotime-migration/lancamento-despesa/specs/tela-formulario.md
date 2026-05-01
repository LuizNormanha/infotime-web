# Tela: Formulário de Lançamento de Despesa
## Título real: "Inclusão Conta a Pagar (Despesa)"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório | Nota |
|---|---|---|---|
| Agente | radio (Cliente / Colaborador / Fornecedor) | Sim | Default: Fornecedor |
| Fornecedor (Nome Fantasia - CNPJ / CPF) | autocomplete | Sim | Muda conforme Agente |
| Id. | readonly | — | |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa | select | Sim |
| Plano de Contas | select | Sim |
| Valor previsto bruto | decimal + calculadora | Sim |
| Valor previsto líquido | decimal + calculadora | Sim |
| Previsto para | date | Sim |
| Previsto por | text (readonly) | Auto: usuário logado |
| Situação | select | Sim — default: Pendente |
| Competência | month/year | auto: mês atual |
| Conta Contábil | text | |
| Histórico | text | |

### Aba: Pagamento
_(data realização, valor realização, acréscimos, descontos, conta caixa, espécie, número documento)_

### Aba: Auditoria
_(histórico de alterações)_

### Aba: Arquivos
_(upload de boleto, NF, comprovante, anexo)_

### Ações disponíveis
- **Incluir**: salvar
- **Ações ▾**: parcelamento, recorrência, planejamento, etc.
- **Voltar**: retornar
