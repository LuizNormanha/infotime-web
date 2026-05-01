# Tela: Formulário de Almoxarifado
## Título real: "Novo registro de Almoxarifado"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa | select (autocomplete) | Sim |
| Sigla | text | Sim |
| Descrição | text | Sim |
| Permite entrada | toggle | |
| Ativo | radio (Sim/Não) | Sim |
| Id. | readonly | — |

### Aba: Característica
| Campo | Tipo |
|---|---|
| Usuários que podem atender requisição | list box (seleção múltipla) |
| Baixa automática | toggle |

### Aba: Contato
_(campos de contato do almoxarifado)_

### Aba: Endereço
_(localização física do almoxarifado)_

### Aba: Observações
_(texto livre)_

---

## Tela: Formulário de Produto do Almoxarifado
## Título real: "Novo registro de Produto"
## Screenshot: `produtos-formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| SKU (Sigla) | text | Sim |
| Descrição | text | Sim |
| Ativo | select | Sim |
| Id. | readonly | — |

### Seção: Estoque
| Campo | Tipo | Obrigatório |
|---|---|---|
| Grupo | select | Sim |
| Mínimo | decimal | Sim |
| Máximo | decimal | Sim |
| Tipo ponto pedido | select | Sim |
| Valor ponto pedido | decimal | Sim |
| Estoque atual do produto | decimal (readonly) | |

### Aba: Características
| Campo | Tipo |
|---|---|
| Classificação | select |
| Volume | select |
| Local de armazenamento padrão | select |
| Fabricante | select |
| Código de barras | text |
| Código externo | text |

### Aba: Observações
_(texto livre)_

### Aba: Suporte
_(informações técnicas)_

---

## Tela: Formulário de Grupo de Produto
## Título real: "Novo registro de Grupo produtos"
## Screenshot: `grupos-formulario.png`

### Identificação
| Campo | Tipo | Obrigatório |
|---|---|---|
| Sigla | text | Sim |
| Descrição | text | Sim |
| Ativo | radio (Sim/Não) | Sim |
| Id. | readonly | — |

### Seção: Estoque
| Campo | Tipo | Obrigatório |
|---|---|---|
| Tipo de controle do estoque | select | Sim |
| Mínimo | decimal | |
| Máximo | decimal | |
| Tipo ponto pedido | select | |
| Valor ponto pedido | decimal | |
| Estoque atual do grupo | decimal (readonly) | |
