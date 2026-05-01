# Regras Scriptcase — cargo

## events.md (corpus)

```markdown
# Eventos Scriptcase — cargo

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
# Regras de Negócio — cargo

## Hierarquia
- Cargo → Classificação → Nível (3 níveis obrigatórios)
- Colaborador vinculado ao Nível (`id_cargo_classificacao_nivel`)

## Tabela Salarial
- Histórica: vários registros por nível com datas diferentes
- Apenas o mais recente com `ativo = 'S'` é o salário vigente
- Ao reajustar: criar novo registro com `ativo = 'S'` e desativar o anterior

## Motivos de Reajuste
- Promoção, Mérito, Dissídio, Equiparação etc.
- Configuráveis em `tipo_motivo_reajuste`

## Histórico de Reajustes
- `colaborador_reajuste`: registra cada reajuste individual do colaborador
- Manter histórico completo de evoluções salariais
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
