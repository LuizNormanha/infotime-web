# Especificação — cliente

## Objetivo

Migrar o módulo **cliente** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/cliente/database/`

| Arquivo TLL |
|-------------|
| `cliente.tll` |
| `cliente_canal.tll` |
| `cliente_comunicacao.tll` |
| `cliente_contato.tll` |
| `cliente_documento.tll` |
| `cliente_plano_conta.tll` |
| `cliente_plano_conta_legacy.tll` |
| `cliente_senha.tll` |
| `cliente_telefone.tll` |
| `coleta_domiciliar.tll` |
| `municipio.tll` |
| `pessoa.tll` |
| `regiao_estadual.tll` |
| `situacao_cliente.tll` |
| `tipo_cliente.tll` |
| `tipo_pessoa.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/cliente/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ClienteComunicacao_Frm.php`
- `ClienteComunicacao_Frm_apl.php`
- `ClienteComunicacao_Lst.php`
- `ClienteContato_Frm.php`
- `ClienteContato_Frm_apl.php`
- `ClienteContato_Lst.php`
- `ClienteDocumento_Frm.php`
- `ClienteDocumento_Frm_apl.php`
- `ClienteDocumento_Lst.php`
- `ClientePlanoConta_Gde.php`
- `ClientePlanoConta_Gde_apl.php`
- `ClientePlanoConta_Lst.php`
- `ClienteSenha_Frm.php`
- `ClienteSenha_Frm_apl.php`
- `ClienteSenha_Lst.php`
- `ClienteSms_Ctr.php`
- `ClienteSms_Ctr_apl.php`
- `ClienteUnidade_Frm.php`
- `ClienteUnidade_Frm_apl.php`
- `Cliente_EnviarEmail_Lst.php`
- `Cliente_Frm.php`
- `Cliente_Frm_apl.php`
- `Cliente_Lst.php`
- `TrocarCliente_Ctr.php`
- `TrocarCliente_Ctr_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `prisma-documentacao.md`
- `regras-negocio.md`
- `tela-cliente.md`
- `tela-formulario.md`
- `tela-lista.md`

## Regras críticas

Resumo inicial em [`regras-scriptcase.md`](regras-scriptcase.md). Refinar durante implementação.

## Dependências

Registrar bloqueios em [`duvidas-abertas.md`](duvidas-abertas.md).

## Riscos

Ver [`docs/fontes/04_RISCOS_DA_MIGRACAO.md`](../../docs/fontes/04_RISCOS_DA_MIGRACAO.md) e completar por entidade aqui quando aplicável.

## Status de prontidão para implementação

| Item | Status |
|------|--------|
| Evidências lidas | Em revisão |
| modelo-dados | Rascunho |
| API | Rascunho |
| Frontend | Rascunho |
| Permissões | Rascunho |
