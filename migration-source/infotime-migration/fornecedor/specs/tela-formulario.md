# Tela: Formulário de Fornecedor
## Título real: "Inclusão Fornecedor"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Pessoa | radio (FÍSICA / JURÍDICA) | Sim |
| Razão social | text | Sim |
| Fabricante | toggle (Sim/Não) | |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| CNPJ | text (masked) | Sim |
| Nome Fantasia | text | |
| Telefone | text | |
| Celular | text | |
| E-mail | email | |
| Contatos | text | |
| Site | url + botão "Navegar" | |
| Situação | select | Sim |

### Aba: Endereço
_(CEP, logradouro, número, complemento, bairro, cidade, estado)_

### Aba: Observações
_(texto livre)_

> Flag **Fabricante** aparece no cabeçalho como toggle — importante para
> o cadastro de produtos do almoxarifado (seleção de fabricante).
