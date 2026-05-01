# Regras Scriptcase — patrimonio

## events.md (corpus)

```markdown
# Eventos Scriptcase — patrimonio

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
# Regras de Negócio — patrimonio

## Categoria e Depreciação
- `patrimonio_categoria.percentual_depreciacao_anual`: % de depreciação por ano
- `qtd_anos_vida_util`: vida útil em anos
- Calcular valor atual = valor_compra × (1 - depreciacao_anual)^anos

## Atualizações de Valor
- `tipo = 'D'`: depreciação
- `tipo = 'V'`: valorização (para bens que apreciam)
- Registrar data e valor de cada atualização

## Eventos
- `tipo_patrimonio_bem_evento`: tipos configuráveis (manutenção, empréstimo, garantia)
- `qtd_dias_producao`: dias que o evento impacta a produção
- `valor_unitario` no evento: custo do evento

## Fotos
- Armazenadas em `bytea` no legado
- **Migrar para object storage**
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
