# Regras Scriptcase — configuracao

## events.md (corpus)

```markdown
# Eventos Scriptcase — configuracao

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
# Regras de Negócio — configuracao

## Uma Configuração por Tenacidade
- Tabela tem `id_tenacidade` único
- Criar configuração padrão ao registrar novo cliente

## Módulos Habilitados
- `relacao_modulos`: lista de módulos ativos (ex: `FIN,ALM,RH`)
- Usar para controlar visibilidade de menus e funcionalidades

## Padrões Financeiros
- IDs de contas/planos/espécies usados como default em operações automáticas
- Exemplo: ao gerar NF automaticamente, usar `id_conta_caixa_lancamento_receita_nota_fiscal`

## Auditoria
- `gravar_auditoria = 'S'`: ativa o log em `auditoria` e `auditoria_campo`
- Performance: considerar logs assíncronos no novo sistema
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
