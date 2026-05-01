# Especificação — almoxarifado-entrada

## Objetivo

Migrar o módulo **almoxarifado-entrada** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** ALM
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/almoxarifado-entrada/database/`

| Arquivo TLL |
|-------------|
| `almoxarifado_entrada.tll` |
| `almoxarifado_entrada_parcela.tll` |
| `almoxarifado_entrada_parcela_rateio.tll` |
| `almoxarifado_entrada_produto.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/almoxarifado-entrada/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AlmoxarifadoEntradaParcelaRateio_Gde.php`
- `AlmoxarifadoEntradaParcelaRateio_Gde_apl.php`
- `AlmoxarifadoEntradaParcelaRateio_MR_Gde.php`
- `AlmoxarifadoEntradaParcelaRateio_MR_Gde_apl.php`
- `AlmoxarifadoEntradaParcela_Gde.php`
- `AlmoxarifadoEntradaParcela_Gde_apl.php`
- `AlmoxarifadoEntradaParcela_Lst.php`
- `AlmoxarifadoEntradaParcela_Rateio_Lst.php`
- `AlmoxarifadoEntradaProduto_Frm.php`
- `AlmoxarifadoEntradaProduto_Frm_apl.php`
- `AlmoxarifadoEntradaProduto_Lista_Lst.php`
- `AlmoxarifadoEntradaProduto_Lst.php`
- `AlmoxarifadoEntradaProduto_Validacao_Frm.php`
- `AlmoxarifadoEntradaProduto_Validacao_Frm_apl.php`
- `AlmoxarifadoEntradaProduto_Validacao_Lst.php`
- `AlmoxarifadoEntrada_Frm.php`
- `AlmoxarifadoEntrada_Frm_apl.php`
- `AlmoxarifadoEntrada_Lst.php`
- `AlmoxarifadoEntrada_Manual_Frm.php`
- `AlmoxarifadoEntrada_Manual_Frm_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-almoxarifado-entrada.md`
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
