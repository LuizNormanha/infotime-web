# Regras Scriptcase — fornecedor

## events.md (corpus)

```markdown
# Eventos Scriptcase — fornecedor

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
# Regras de Negócio — fornecedor

## Flag Fabricante
- `fabricante = 'S'`: aparece como opção de fabricante em cadastros de produto/patrimônio

## Plano de Contas
- `fornecedor_plano_conta`: pré-associar planos de conta ao fornecedor
- Ao criar despesa para este fornecedor: sugerir o plano associado
- `fornecedor_plano_conta` para almoxarifado: plano específico para compras

## Situação
- Situação bloqueada: impedir criação de novas despesas
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
