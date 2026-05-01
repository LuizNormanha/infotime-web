# Regras Scriptcase — colaborador

## events.md (corpus)

```markdown
# Eventos Scriptcase — colaborador

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
# Regras de Negócio — colaborador

## Tipo de Colaborador
- CLT: `exige_data_clt = 'S'` → campos de carteira obrigatórios
- PJ: não exige carteira de trabalho

## Flags de Implantação
- `implanta`: pode ser atribuído a tarefas de implantação
- `lider_implantacao`: aparece como opção de líder na seleção
- `consultor_implantacao`: perfil de consultor

## Foto
- Campo `foto` armazenado em `bytea` no legado
- **Migrar para object storage** no novo sistema
- Endpoint: `POST /colaboradores/{id}/foto`

## Login no App Mobile
- Campos `login` e `senha` para acesso ao app mobile dos colaboradores
- Separado do login do sistema principal
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
