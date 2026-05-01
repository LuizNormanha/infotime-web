# Regras Scriptcase — almoxarifado-requisicao

## events.md (corpus)

```markdown
# Eventos Scriptcase — almoxarifado-requisicao

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
# Regras de Negócio — almoxarifado-requisicao

## Tipos
- `E` = Estoque: retirada de produto do almoxarifado
- `C` = Compra: pedido de compra (gera entrada futura)

## Situações da Requisição
- `P` = Pendente
- `A` = Atendida (todos os itens atendidos)
- `R` = Parcialmente atendida
- `N` = Não atendida

## Situações por Item
- `P` = Pendente
- `A` = Atendido
- `R` = Atendido parcialmente
- `N` = Negado

## Atendimento
- Ao atender: criar saída em `almoxarifado_produto_estoque` (tipo = 'S')
- Verificar saldo disponível antes de atender
- Atualizar `quantidade_atendida` e `situacao_item`
- Recalcular situação geral da requisição

## Usuários Autorizados
- `almoxarifado_usuario_atender`: controla quem pode atender requisições por almoxarifado
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
