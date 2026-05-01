# Tela: Formulário de Baixa de Produto
## Título real: "Novo registro de Baixa de produtos em lote"
## Screenshot: `formulario.png`

### Layout: Grid de inclusão em lote
| Coluna | Tipo | Obrigatório |
|---|---|---|
| Empresa/Almoxarifado | select | Sim |
| Motivo da baixa | select | Sim |
| Produto | select | Sim |
| Lote | text | |
| Quantidade | decimal | Sim |

> Interface em formato de grid editável inline (não é um formulário de abas).
> Permite incluir múltiplos produtos de uma só vez.
> Ação: **+ Novo** para adicionar linha / **Incluir** para salvar todas.
