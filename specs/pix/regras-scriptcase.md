# Regras Scriptcase — pix

## events.md (corpus)

```markdown
# Eventos Scriptcase — pix

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `ApiItau`

### Queries SQL encontradas
- `SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \`


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
# Regras de Negócio — pix

## Tipos de Cobrança
- `cob`: cobrança imediata (sem vencimento)
- `cobv`: cobrança com vencimento
- `pix_direto`: PIX direto sem cobrança prévia

## TXID
- 26 a 35 caracteres alfanuméricos
- Único por cobrança
- Usado para rastrear pagamento

## Webhook (retorno_api_pix)
- `e2e_id`: identificador fim-a-fim do pagamento (único)
- `txid`: referência da cobrança
- `valor`: valor recebido
- `horario`: momento do pagamento
- Ao receber: baixar `lancamento_receita` correspondente

## Segurança
- Validar certificado SSL do webhook
- Verificar assinatura do payload
- Idempotência: não baixar o mesmo e2eid duas vezes

## API Itaú
- OAuth 2.0 para autenticação
- Certificado mTLS obrigatório
- Ambiente sandbox × produção via `configuracao`
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
