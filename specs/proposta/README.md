# Especificação — proposta

## Objetivo

Migrar o módulo **proposta** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/proposta/database/`

| Arquivo TLL |
|-------------|
| `indice_reajuste.tll` |
| `indice_reajuste_data.tll` |
| `proposta.tll` |
| `proposta_andamento.tll` |
| `proposta_dimensao.tll` |
| `proposta_fase.tll` |
| `proposta_item.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/proposta/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `IndiceReajusteData_Gde.php`
- `IndiceReajusteData_Gde_apl.php`
- `IndiceReajuste_Frm.php`
- `IndiceReajuste_Frm_apl.php`
- `IndiceReajuste_Lst.php`
- `PropostaAndamento_Frm.php`
- `PropostaAndamento_Frm_apl.php`
- `PropostaAndamento_Lst.php`
- `PropostaDimensao_Frm.php`
- `PropostaDimensao_Frm_apl.php`
- `PropostaDimensao_Lst.php`
- `PropostaFase_Frm.php`
- `PropostaFase_Frm_apl.php`
- `PropostaFase_Lst.php`
- `PropostaItem_Frm.php`
- `PropostaItem_Frm_apl.php`
- `PropostaItem_Gde.php`
- `PropostaItem_Gde_apl.php`
- `PropostaItem_Lst.php`
- `PropostaItem_Reajustar_Ctr.php`
- `PropostaItem_Reajustar_Ctr_apl.php`
- `Proposta_Frm.php`
- `Proposta_Frm_apl.php`
- `Proposta_Lst.php`
- `RelatorioPropostaNovo_Blk.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-proposta-dimensao.md`
- `tela-proposta-fase.md`
- `tela-proposta.md`

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
