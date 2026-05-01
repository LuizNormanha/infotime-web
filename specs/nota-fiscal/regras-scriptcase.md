# Regras Scriptcase — nota-fiscal

## events.md (corpus)

```markdown
# Eventos Scriptcase — nota-fiscal

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
# Regras de Negócio — nota-fiscal

## Numeração
- Sequencial por empresa: `empresa_nota_fiscal.sequencial_nota_fiscal`
- Incrementar atomicamente ao emitir (usar transação/lock)

## Emissão NFSe Nacional
- Integrar com plataforma nacional de NFS-e
- Enviar XML assinado com certificado digital
- Receber: `numero_lote`, `protocolo`, `numero_nota_fiscal_completo`

## Cancelamento
- Registrar: `id_usuario_cancelamento` + data
- Comunicar à prefeitura (cancelamento da NFS-e)

## Vinculação
- Uma NF pode ter um ou mais boletos via `boleto_nota_fiscal`
- Uma NF sempre vinculada a um `lancamento_receita`
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
