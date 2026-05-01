# Especificação — fornecedor

## Objetivo

Migrar o módulo **fornecedor** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/fornecedor/database/`

| Arquivo TLL |
|-------------|
| `fornecedor.tll` |
| `fornecedor_comunicacao.tll` |
| `fornecedor_contato.tll` |
| `fornecedor_documento.tll` |
| `fornecedor_plano_conta.tll` |
| `situacao_fornecedor.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/fornecedor/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `FornecedorComunicacao_Frm.php`
- `FornecedorComunicacao_Frm_apl.php`
- `FornecedorComunicacao_Lst.php`
- `FornecedorContato_Frm.php`
- `FornecedorContato_Frm_apl.php`
- `FornecedorContato_Lst.php`
- `FornecedorDocumento_Frm.php`
- `FornecedorDocumento_Frm_apl.php`
- `FornecedorDocumento_Lst.php`
- `FornecedorGestao_Mnu.php`
- `FornecedorPlanoConta_Almoxarifado_Gde.php`
- `FornecedorPlanoConta_Almoxarifado_Gde_apl.php`
- `FornecedorPlanoConta_Gde.php`
- `FornecedorPlanoConta_Gde_apl.php`
- `FornecedorPlanoConta_Lst.php`
- `Fornecedor_Frm.php`
- `Fornecedor_Frm_apl.php`
- `Fornecedor_Lst.php`
- `SituacaoFornecedor_Frm.php`
- `SituacaoFornecedor_Frm_apl.php`
- `SituacaoFornecedor_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-formulario.md`
- `tela-fornecedor.md`
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
