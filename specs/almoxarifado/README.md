# Especificação — almoxarifado

## Objetivo

Migrar o módulo **almoxarifado** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** ALM
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/almoxarifado/database/`

| Arquivo TLL |
|-------------|
| `almoxarifado.tll` |
| `almoxarifado_importacao_xml.tll` |
| `almoxarifado_produto.tll` |
| `almoxarifado_produto_classificacao.tll` |
| `almoxarifado_produto_estoque.tll` |
| `almoxarifado_produto_grupo.tll` |
| `almoxarifado_produto_local_armazenamento.tll` |
| `almoxarifado_produto_volume.tll` |
| `almoxarifado_usuario_atender.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/almoxarifado/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AlmoxarifadoClassificacaoProduto_Gde.php`
- `AlmoxarifadoClassificacaoProduto_Gde_apl.php`
- `AlmoxarifadoGrupoProduto_Frm.php`
- `AlmoxarifadoGrupoProduto_Frm_apl.php`
- `AlmoxarifadoGrupoProduto_Lst.php`
- `AlmoxarifadoImportacaoXml_Ctr.php`
- `AlmoxarifadoImportacaoXml_Ctr_apl.php`
- `AlmoxarifadoProdutoEstoque_Atender_Gde.php`
- `AlmoxarifadoProdutoEstoque_Atender_Gde_apl.php`
- `AlmoxarifadoProdutoEstoque_Lst.php`
- `AlmoxarifadoProdutoLocalArmazenamento_Frm.php`
- `AlmoxarifadoProdutoLocalArmazenamento_Frm_apl.php`
- `AlmoxarifadoProdutoLocalArmazenamento_Lst.php`
- `AlmoxarifadoProduto_Detalhe_Lst.php`
- `AlmoxarifadoProduto_Frm.php`
- `AlmoxarifadoProduto_Frm_apl.php`
- `AlmoxarifadoProduto_Lst.php`
- `AlmoxarifadoTipoMovimento_Gde.php`
- `AlmoxarifadoTipoMovimento_Gde_apl.php`
- `AlmoxarifadoVolume_Gde.php`
- `AlmoxarifadoVolume_Gde_apl.php`
- `Almoxarifado_Frm.php`
- `Almoxarifado_Frm_apl.php`
- `Almoxarifado_Lst.php`
- `IndicadorAlmoxarifadoProdutoDetalhe_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-almoxarifado-produto.md`
- `tela-almoxarifado.md`
- `tela-estoque.md`
- `tela-formulario-produto.md`
- `tela-formulario.md`
- `tela-lista-produtos.md`

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
