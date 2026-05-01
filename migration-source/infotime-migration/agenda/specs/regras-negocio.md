# Regras de Negócio — agenda

## Agendas Compartilhadas
- Cada agenda pode ter múltiplos usuários (`agenda_usuario`)
- Evento vinculado a uma agenda e a um usuário criador

## Recorrência
- `recorrente = 'S'` + `periodo` (D=Diário/S=Semanal/M=Mensal/A=Anual)
- `recorrencia_informacao`: texto descritivo da regra de recorrência
- `id_agenda_evento_pai`: evento pai da série

## Integração Google Calendar
- `id_api`: ID interno da integração
- `id_google`: ID do evento no Google Calendar
- OAuth via `_lib/oauth` (migrar para OAuth 2.0 com tokens seguros)
- Sync bidirecional: Infotime ↔ Google Calendar
