# Tela: Formulário de Entrada de Almoxarifado
## Título real: "Novo registro de Entrada Almoxarifado"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Fornecedor | select (autocomplete) | Sim |
| CNPJ | text (readonly, auto-preenche) | |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório |
|---|---|---|
| Empresa/Almoxarifado | select | Sim |

### Aba: Nota fiscal
_(número NF, série, chave NF-e, data emissão, natureza)_

### Aba: Valores
_(valor total, valor desconto, valor líquido, rateio entre parcelas)_

### Aba: Observações
_(texto livre)_

### Aba: Suporte
_(informações técnicas)_

> Botão especial na lista: **Importar XML** — permite importar NF-e diretamente
> do XML, preenchendo automaticamente todos os campos.
