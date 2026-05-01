# Especificação — lancamento-despesa

## Objetivo

Migrar o módulo **lancamento-despesa** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/lancamento-despesa/database/`

| Arquivo TLL |
|-------------|
| `lancamento_despesa.tll` |
| `lancamento_despesa_rateio.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/lancamento-despesa/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `LancamentoDespesaRateio_Gde.php`
- `LancamentoDespesaRateio_Gde_apl.php`
- `LancamentoDespesaRecibo_Blk.php`
- `LancamentoDespesaRecorrente_Ctr.php`
- `LancamentoDespesaRecorrente_Ctr_apl.php`
- `LancamentoDespesaRelPeriodo_Blk.php`
- `LancamentoDespesaRelPeriodo_Ctr.php`
- `LancamentoDespesaRelPeriodo_Ctr_apl.php`
- `LancamentoDespesa_Almoxarifado_Frm.php`
- `LancamentoDespesa_Almoxarifado_Frm_apl.php`
- `LancamentoDespesa_Extender_Frm.php`
- `LancamentoDespesa_Extender_Frm_apl.php`
- `LancamentoDespesa_Frm.php`
- `LancamentoDespesa_Frm_apl.php`
- `LancamentoDespesa_GraEvoPag_Lst.php`
- `LancamentoDespesa_Lst.php`
- `LancamentoDespesa_Parcelamento_Ctr.php`
- `LancamentoDespesa_Parcelamento_Ctr_apl.php`
- `LancamentoDespesa_Parcelamento_Lst.php`
- `LancamentoDespesa_PlanejamentoReferencia_Ctr.php`
- `LancamentoDespesa_PlanejamentoReferencia_Ctr_apl.php`
- `LancamentoDespesa_PlanejamentoSelecao_Lst.php`
- `LancamentoDespesa_ReceberTransferencia_Lst.php`
- `LancamentoDespesa_Recorrente_Frm.php`
- `LancamentoDespesa_Recorrente_Frm_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-formulario.md`
- `tela-lancamento-despesa.md`
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
