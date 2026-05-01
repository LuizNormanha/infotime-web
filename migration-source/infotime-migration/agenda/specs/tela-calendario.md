# Tela: Calendário de Eventos
## Origem Scriptcase: `AgendaEvento_Cal`

### Visualizações
- Mês, Semana, Dia
- Por agenda (filtro)
- Por categoria (cor)

### Campos do Evento
| Campo | Coluna DB | Tipo |
|---|---|---|
| Título | `agenda_evento.titulo` | text (max 64) |
| Descrição | `descricao` | text (max 128) |
| Categoria | `id_tipo_agenda_categoria` | select (com cor) |
| Data Início | `data_inicio` + `hora_inicio` | datetime |
| Data Fim | `data_fim` + `hora_fim` | datetime |
| Recorrente | `recorrente` | checkbox |
| Período | `periodo` | select (D/S/M/A) |
| Cor | `cor` | color picker |
