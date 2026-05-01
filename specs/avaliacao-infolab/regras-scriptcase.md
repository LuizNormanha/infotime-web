# Regras Scriptcase — avaliacao-infolab

## events.md (corpus)

```markdown
# Eventos Scriptcase — avaliacao-infolab

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
# Regras de Negócio — avaliacao-infolab

## Origem
- Avaliação enviada automaticamente pelo InfoLAB após uso
- Identificada por CNPJ + usuário do InfoLAB

## Métricas
- NPS calculável a partir das notas
- Filtrar por período, por cliente, por nota
- Dashboard de satisfação

## InfoLAB Noticias
- `info_lab_noticias`: comunicados enviados do Infotime para o InfoLAB
- `urgente = 'S'`: aparecer em destaque no InfoLAB
- `ativo = 'S'`: visível para os clientes
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
