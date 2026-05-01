# Regras Scriptcase — cliente-licenca

## events.md (corpus)

```markdown
# Eventos Scriptcase — cliente-licenca

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
# Regras de Negócio — cliente-licenca

## Chave de Acesso
- UUID ou hash único por cliente
- Usada para autenticação no portal do cliente e no InfoLAB
- Ao renovar: gerar nova chave e invalidar a anterior

## Validade
- `data_expiracao < hoje`: licença expirada → bloquear acesso ao portal
- Enviar alertas de vencimento próximo (30, 15, 7, 1 dia antes)

## Download de Licença
- `Cliente_Download_Licenca_Ctr`: gera arquivo de licença para o InfoLAB
- Arquivo contém: CNPJ, chave_acesso, data_expiracao, qtd_licenca
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
