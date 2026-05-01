# Tela: Formulário de Tarefa do Colaborador
## Título real: "Inclusão Tarefa"
## Screenshot: `formulario.png`

### Identificação (cabeçalho sempre visível)
| Campo | Tipo | Obrigatório |
|---|---|---|
| Projeto (Contrato) | select | Sim |
| Id. | readonly | — |

### Aba: Características
| Campo | Tipo | Obrigatório | Nota |
|---|---|---|---|
| Descrição | text | Sim | Campo em destaque (fundo azul) |
| Responsável | select | Sim | |
| Data de Início | datetime | Sim | Default: agora |
| Data da Previsão | datetime | Sim | |
| Data da Conclusão | datetime | | Preenchida ao concluir |
| Prioridade | select | Sim | |
| Situação | select | Sim | Default: Pendente |

### Aba: Observações
_(texto livre de observações sobre a tarefa)_
