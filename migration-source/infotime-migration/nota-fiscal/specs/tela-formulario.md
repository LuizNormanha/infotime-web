# Tela: Formulário de Nota Fiscal
## Título real: "Inclusão Nota Fiscal"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Serviços prestados em | date | Sim |
| Empresa | select | Sim — default: "Liga Sistemas - M" |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome Fantasia - CNPJ | text (autocomplete) | Sim |
| Plano de Contas | select | Sim |
| Data do Vencimento | date | Sim |
| Valor dos Serviços | decimal | Sim |
| Valor do ISS (%) | decimal | |
| Valor Líquido | decimal (calculado) | Sim |
| Emitido por | select (usuario) | Auto: logado |
| Situação | select | Sim — default: Pendente |
| Boleto liberado | radio (Não/Sim) | Default: Não |

### Aba: Financeiro
_(conta caixa, plano de conta, lançamento de receita vinculado)_

### Aba: Dados da nota
_(número NF, série, código verificação, número lote, protocolo)_

### Aba: Discriminação
_(texto da discriminação dos serviços para a NF-e)_

### Aba: Arquivos
_(PDF emitido, XML da NF)_
