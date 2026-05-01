# Regras Scriptcase — cliente

## events.md (corpus)

```markdown
# Eventos Scriptcase — cliente

Documentação dos eventos e comportamentos customizados encontrados nos fontes PHP.

## `Cliente_Lst`

### Queries SQL encontradas
- `SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \`
- `SELECT IdAplicacao FROM aplicacao WHERE Nome = '`
- `SELECT Descricao, IdSituacaoCliente FROM situacaocliente WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_a`
- `SELECT Descricao, IdTipoCliente FROM tipocliente WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_apos LIKE`
- `SELECT Descricao, IdClienteCanal FROM clientecanal WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_apos LI`


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
# Regras de Negócio — cliente

## Tipo de Pessoa
- `tipo_pessoa = 'J'`: Pessoa Jurídica → CNPJ 14 dígitos, Razão Social obrigatória
- `tipo_pessoa = 'F'`: Pessoa Física → CPF 11 dígitos, campo `sexo` e `data_nascimento`

## Hierarquia de Clientes
- `id_cliente_pai`: cliente pode ter um "pai" (matriz/filial)
- Exibir hierarquia na listagem e formulário

## Licenciamento de Software
- `chave_acesso`: token de acesso ao portal do cliente
- `data_expiracao`: validade da licença
- `qtd_licenca`: número de licenças ativas
- Geração de chave: UUID ou hash único

## Contatos Especiais
- `assina_proposta = 'S'`: aparece como signatário nas propostas
- `recebe_cobranca = 'S'`: recebe e-mails de cobrança automáticos

## Integração InfoLAB
- `id_cliente_infolab`: ID no sistema InfoLAB (integrações externas)

## Busca de CEP
- Integrar com API ViaCEP: `https://viacep.com.br/ws/{cep}/json/`
- Preencher automaticamente: logradouro, bairro, cidade, estado
```

## Extração manual (preencher)

Para cada regra relevante, seguir o template em [`docs/PADRAO_MIGRACAO_SCRIPTCASE.md`](../../docs/PADRAO_MIGRACAO_SCRIPTCASE.md).

| # | Nome | Origem PHP | Evento | Intenção | Implementação Node | Testes |
|---|------|------------|--------|----------|-------------------|--------|
| 1 | | | | | | |
