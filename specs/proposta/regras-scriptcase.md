# Regras Scriptcase — proposta

## events.md (corpus)

```markdown
# Eventos Scriptcase — proposta

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
# Regras de Negócio — proposta

## Limites de Desconto
- `valor_desconto_unico` ≤ `usuario.desconto_maximo_imp` %
- `valor_desconto_mensal` ≤ `usuario.desconto_maximo_mes` %
- Se ultrapassar: exigir autorização de superior

## Conversão em Contrato
- Proposta `situacao_proposta = 'P'` → aceita → `situacao_proposta = 'F'`
- Cria automaticamente um `contrato` com os mesmos dados
- Cria `contrato_item` para cada `proposta_item`
- `proposta.id_contrato` recebe o ID do contrato gerado

## Validade da Proposta
- `dias_validade`: dias até expiração
- Proposta expirada: alertar na listagem, bloquear conversão

## Relatório PDF
- Template configurável em `tipo_contrato.nome_arquivo`
- Gerar PDF com dados da proposta, itens, totais, assinatura
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
