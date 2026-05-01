# Especificação — colaborador-viagem

## Objetivo

Migrar o módulo **colaborador-viagem** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** RH
- **Prioridade:** Baixa

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/colaborador-viagem/database/`

| Arquivo TLL |
|-------------|
| `colaborador_tarifa.tll` |
| `colaborador_viagem.tll` |
| `colaborador_viagem_adiantamento.tll` |
| `colaborador_viagem_despesa.tll` |
| `tipo_despesa_viagem.tll` |
| `tipo_finalidade_viagem.tll` |
| `tipo_meio_transporte.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/colaborador-viagem/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ColaboradorViagemAdiantamento_Frm.php`
- `ColaboradorViagemAdiantamento_Frm_apl.php`
- `ColaboradorViagemDespesa_Frm.php`
- `ColaboradorViagemDespesa_Frm_apl.php`
- `ColaboradorViagemDespesa_Lst.php`
- `ColaboradorViagem_Frm.php`
- `ColaboradorViagem_Frm_apl.php`
- `ColaboradorViagem_Lst.php`
- `MobileColaboradorViagemDespesa_Frm.php`
- `MobileColaboradorViagemDespesa_Frm_apl.php`
- `MobileColaboradorViagemDespesa_Lst.php`
- `MobileColaboradorViagem_Lst.php`
- `TipoDespesaViagem_Gde.php`
- `TipoDespesaViagem_Gde_apl.php`
- `TipoFinalidadeViagem_Gde.php`
- `TipoFinalidadeViagem_Gde_apl.php`
- `TipoMeioTransporte_Gde.php`
- `TipoMeioTransporte_Gde_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-despesas.md`
- `tela-viagem.md`

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
