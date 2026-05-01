# Regras Scriptcase — portal-cliente

## events.md (corpus)

```markdown
# Eventos Scriptcase — portal-cliente

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
# Regras de Negócio — portal-cliente

## Autenticação
- Credenciais: CNPJ + chave_acesso (não usa o sistema de usuários interno)
- Verificar validade: `data_expiracao > hoje`
- Sessão separada do sistema interno

## Acesso
- JWT específico do portal com `id_cliente` e `id_tenacidade`
- Sem acesso a APIs internas (diferentes endpoints)

## Funcionalidades
- GET /portal/boletos: boletos do cliente
- GET /portal/contratos: contratos ativos
- POST /portal/avaliacao: enviar avaliação
- PATCH /portal/senha: alterar senha de acesso

## Tenacidade
- `tenacidade`: controla o tenant do portal
- URL do portal pode ser por subdomínio do cliente
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
