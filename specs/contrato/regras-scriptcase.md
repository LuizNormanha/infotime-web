# Regras Scriptcase — contrato

## events.md (corpus)

```markdown
# Eventos Scriptcase — contrato

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
# Regras de Negócio — contrato

## Ciclo de Vida
1. Criado a partir de uma Proposta aceita
2. Tarefas de implantação geradas automaticamente
3. Situação: Ativo → Cancelado / Encerrado

## Cancelamento
- Obrigatório: `data_cancelamento` + `motivo_cancelamento`
- Registrar `id_usuario_cancelamento`

## Reajuste
- `id_indice_reajuste` → busca percentual em `indice_reajuste_data` para a data de referência
- Atualizar `contrato_item.valor_unitario` com reajuste aplicado
- Registrar histórico no campo `historico` (texto livre)

## Financeiro
- `dia_vencimento`: dia do mês para geração de lançamentos de receita
- Gerar lançamentos mensais automaticamente com base nos itens ativos
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
