# Tela: Template de Tarefas por Produto
## Origem Scriptcase: `CategoriaProdutoTarefa_Lst`

### Propósito
- Cadastrar tarefas padrão associadas a uma categoria de produto
- Ao criar contrato, essas tarefas são copiadas automaticamente

### Colunas
| Coluna | Campo DB |
|---|---|
| Código | `categoria_produto_tarefa.codigo_tarefa` |
| Descrição | `categoria_produto_tarefa.descricao` |
| Tipo | `tipo` (S=Sintética, A=Analítica) |
| Nível | `nivel_tarefa` (1=baixa,2=média,3=alta) |
| Prazo (horas) | `prazo_horas` |
| Exige Arquivo | `exige_arquivo` |
