# Regras Scriptcase — almoxarifado

## events.md (corpus)

```markdown
# Eventos Scriptcase — almoxarifado

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
# Regras de Negócio — almoxarifado

## Controle de Estoque
- Cada movimentação em `almoxarifado_produto_estoque`
- `tipo_movimentacao = 'E'`: entrada
- `tipo_movimentacao = 'S'`: saída
- Saldo = Σ(E) - Σ(S) por produto + almoxarifado + lote

## Ponto de Pedido
- `tipo_ponto_pedido = 'P'`: % do estoque máximo
- `tipo_ponto_pedido = 'Q'`: quantidade absoluta
- Alertar quando estoque ≤ ponto de pedido

## Controle por Grupo
- `tipo_controle_estoque = 'P'`: controla por produto individual
- `tipo_controle_estoque = 'G'`: controla somando todo o grupo

## Validade e Lote
- `tipo_validade = 'S'`: validade informada → obrigatório `data_validade`
- `tipo_validade = 'I'`: indeterminada
- Rastrear por lote para recall/qualidade

## Temperatura
- Campos: `temperatura_recebimento`, `temperatura_transporte`, `temperatura_padrao`
- Crítico para produtos farmacêuticos/biológicos

## Importação XML (NF-e)
- Parser de XML da nota fiscal eletrônica
- Criar entrada automaticamente a partir do XML
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
