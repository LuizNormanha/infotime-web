# Tela: Formulário de Proposta
## Título real: "Inclusão Proposta"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa | select | Sim (pré-selecionada: LIGA SISTEMAS DE INFORMATICA LTDA.) |
| Cliente (Nome Fantasia - CNPJ - Id.) | autocomplete | Sim |
| Tipo do contrato | select | Sim |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Nota |
|---|---|---|
| Solicitado por | text | |
| Incluído em | datetime (readonly) | Auto-preenchido |
| Incluído por | select (usuario) | Auto-preenchido com usuário logado |
| Situação | select | Default: Pendente |

### Aba: Condições
_(prazo, forma de pagamento, validade, observações das condições)_

### Aba: Financeiro
_(desconto único, desconto mensal, índice de reajuste, parcelamento)_

### Aba: Observações
_(texto livre)_

### Aba: Produtos e Serviços
_(grid de itens da proposta: produto, descrição, quantidade, valor)_

### Aba: Arquivo
_(upload do contrato/proposta assinada)_

### Ações disponíveis
- **Incluir**: salvar nova proposta
- **Ações ▾**: menu com opções adicionais
- **Voltar**: retornar à lista
