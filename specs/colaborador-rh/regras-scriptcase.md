# Regras Scriptcase — colaborador-rh

## events.md (corpus)

```markdown
# Eventos Scriptcase — colaborador-rh

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
# Regras de Negócio — colaborador-rh

## Férias
- Período aquisitivo: 1 ano após admissão
- Vencimento: até 2 anos após início do período
- Máximo de dias a vender: 1/3 dos dias de férias
- Férias em dobro: pagamento em dobro se extrapolado o prazo

## Atestados
- CID-10: código internacional de doenças
- Impactar: desconto de faltas do VT/VA, controle de afastamentos

## Medidas Disciplinares
- Tipos: advertência verbal, escrita, suspensão
- Gerar documento PDF a partir do formulário

## Mobile
- Colaboradores acessam holerites, atestados, avaliações pelo app
- Autenticação separada via `colaborador.login` e `colaborador.senha`
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
