# Tela: Formulário de Cliente
## Título real: "Inclusão Cliente"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório | Nota |
|---|---|---|---|
| Pessoa | radio (FÍSICA / JURÍDICA) | Sim | Controla campos exibidos |
| Razão Social | text | Sim | |
| Id. | readonly | — | Gerado automaticamente |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Nome fantasia | text | Sim |
| Telefone | text | |
| Celular | text | |
| Situação | select | Sim |
| Conta Caixa | select | Sim |
| Município Nota Fiscal | select (autocomplete) | |
| Contatos | text | |
| E-mail | email | |

### Aba: Dados adicionais
_(campos de cadastro complementar: canal, origem, concorrente, plano de conta, etc.)_

### Aba: Documentos
_(upload e listagem de documentos do cliente)_

### Aba: Endereço
_(CEP, logradouro, número, complemento, bairro, cidade, estado)_

### Aba: Observações
_(campo texto livre de observações)_

### Rodapé
- `* Campo obrigatório`
- Timestamp: `Quarta-feira, 29/04/2026 às 17:28`

### Comportamento
- Ao selecionar FÍSICA/JURÍDICA: ajustar validação do CPF/CNPJ e campos exibidos
- Situação padrão: "Ativo"
- Conta Caixa: pré-preenchida com a conta padrão da configuração
