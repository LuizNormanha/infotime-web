# Regras Scriptcase — conta-caixa

## events.md (corpus)

```markdown
# Eventos Scriptcase — conta-caixa

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
# Regras de Negócio — conta-caixa

## Saldo Calculado
- Saldo = `saldo_inicio_caixa` + Σreceitas - Σdespesas
- Calcular em tempo real ou via view materializada

## Fechamento de Caixa
- Ao fechar (`situacao = 'F'`): bloquear novos lançamentos nessa data
- `fechamento_financeiro`: período inteiro bloqueado

## Transferências
- Geram dois lançamentos: saída na origem + entrada no destino
- Usar transação atômica para garantir consistência

## Acesso por Usuário
- `conta_caixa_usuario`: lista de usuários que podem operar cada conta
- Usuários sem acesso não veem a conta na listagem
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
