# Tela: Formulário de Empresa
## Título real: "Inclusão Empresa"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Razão social | text | Sim |
| CNPJ | text (masked) | Sim |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório | Nota |
|---|---|---|---|
| Tipo | radio (Matriz / Filial) | Sim | |
| Nome fantasia | text | Sim | |
| Inscrição Estadual | text | | |
| Alíquota ISS | decimal | | Para emissão de NF-e |
| E-mail | email | | |
| Contatos | text | | |
| Site | url + botão "Navegar" | | |
| Ativa | radio (Sim / Não) | Sim | Default: Sim |

### Aba: Endereço
_(CEP, logradouro, número, complemento, bairro, cidade, estado)_

### Aba: Integração
_(configurações de integração com sistemas externos)_

### Aba: Observações
_(texto livre)_

### Aba: Imagem
_(upload do logotipo da empresa — usado em relatórios e NF-e)_
