# Regras Scriptcase — auth

## events.md (corpus)

```markdown
# Eventos Scriptcase — auth

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
# Regras de Negócio — auth

## Autenticação
- Login único por tenacidade (UNIQUE INDEX em `usuario.login`)
- Senha armazenada em MD5 no legado — **migrar para bcrypt**
- Campo `ativo` controla acesso: apenas `'sim'` permite login
- Campo `administrador = 'sim'` concede acesso total, ignorando permissões de grupo

## Ativação de Cadastro
- Novos usuários recebem `codigo_ativacao` por e-mail
- Devem acessar link de ativação antes do primeiro login
- Após ativação: `data_ativacao` preenchida, `codigo_ativacao` zerado

## Recuperação de Senha
- Envio de e-mail com link temporário (via SMTP configurado em `configuracao`)
- Token de recuperação deve expirar em 24h (implementar no novo)

## Controle Multi-Empresa
- `lista_empresa`: lista de IDs de empresas que o usuário pode acessar
- Vazio = acesso a todas as empresas da tenacidade
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
