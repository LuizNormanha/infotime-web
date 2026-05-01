# Especificação — almoxarifado-requisicao

## Objetivo

Migrar o módulo **almoxarifado-requisicao** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** ALM
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/almoxarifado-requisicao/database/`

| Arquivo TLL |
|-------------|
| `almoxarifado_requisicao.tll` |
| `almoxarifado_requisicao_produto.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/almoxarifado-requisicao/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AlmoxarifadoRequisicaoProdutoAtender_Lst.php`
- `AlmoxarifadoRequisicaoProduto_Gde.php`
- `AlmoxarifadoRequisicaoProduto_Gde_apl.php`
- `AlmoxarifadoRequisicaoProduto_Lst.php`
- `AlmoxarifadoRequisicaoProduto_NaoAtender_Blk.php`
- `AlmoxarifadoRequisicao_Frm.php`
- `AlmoxarifadoRequisicao_Frm_apl.php`
- `AlmoxarifadoRequisicao_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-almoxarifado-requisicao.md`
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
