# Regras Scriptcase — pop-documento

## events.md (corpus)

```markdown
# Eventos Scriptcase — pop-documento

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
# Regras de Negócio — pop-documento

## Upload de Arquivos
- Padrão: `nome_arquivo` (nome original) + `nome_referencia` (nome no storage)
- Migrar para object storage com URL pré-assinada para download

## Visibilidade
- Colaboradores podem ver POPs pelo app mobile (`MobileColaboradorPop_Lst`)
- `lista_pop_documento` em `colaborador`: filtrar POPs visíveis por colaborador

## Tipos de Documento
- Configuráveis em `tipo_documento`
- Exemplos: POP, ISO, PCMSO, PGR, Contrato
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
