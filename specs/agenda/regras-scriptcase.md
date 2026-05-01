# Regras Scriptcase — agenda

## events.md (corpus)

```markdown
# Eventos Scriptcase — agenda

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

_Nenhum evento customizado detectado automaticamente. Verificar manualmente os arquivos .php._


## Mapeamento para o Novo Sistema

| Evento SC | Equivalente Novo | Observação |
|---|---|---|
| `onLoad` | ngOnInit / useEffect | Inicialização do componente |
| `onValidate` | Zod/Yup schema | Validação de formulário |
| `onAfterInsert` | Hook pós-save | Lógica após inserção |
| `onAfterUpdate` | Hook pós-update | Lógica após atualização |
| `sc_mail_send` | Nodemailer / SES | Envio de e-mail |
| `sc_redir` | navigate() / redirect | Redirecionamento |
| `sc_exec_sql` | Repository/Query | Execução de SQL |
| `sc_lookup` | API GET | Busca de dados |
```

## Trechos consolidados do corpus (specs)

```markdown
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
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
