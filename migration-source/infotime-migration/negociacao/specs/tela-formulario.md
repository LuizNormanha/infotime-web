# Tela: Formulário de Negociação
## Título real: sem título explícito (abertura a partir da lista)
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Cliente | select (autocomplete) | Sim |
| Tipo de negócio | select | Sim |
| Situação | select | Sim — default: "Em andamento" |
| Id. | readonly | — |

### Aba: Evolução
| Campo | Tipo |
|---|---|
| Observações / Histórico | textarea livre |

> Área de texto ampla para registrar a evolução da negociação,
> comunicações com o cliente, próximos passos.

### Aba: Suporte
_(informações técnicas e de suporte ao sistema)_

### Ações
- **Incluir**: salvar
- **Voltar**: retornar

> A criação de tarefas e o avanço de fase são feitos pelo Pipeline Kanban
> (`pipeline-kanban.png`), não pelo formulário de inclusão.
