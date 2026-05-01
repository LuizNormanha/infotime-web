# Especificação — negociacao

## Objetivo

Migrar o módulo **negociacao** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/negociacao/database/`

| Arquivo TLL |
|-------------|
| `negociacao.tll` |
| `negociacao_motivo_perda.tll` |
| `negociacao_proposta_fase.tll` |
| `negociacao_tarefa.tll` |
| `situacao_fase.tll` |
| `situacao_tarefa.tll` |
| `tipo_negocio.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/negociacao/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `IndicadoresComercial_Dsb.php`
- `MenuIndicadoresComercial_Blk.php`
- `MenuResumoComercial_Blk.php`
- `MotivoPerda_Gra.php`
- `NegociacaoEvento_Gra.php`
- `NegociacaoGanhoEvento_Gra.php`
- `NegociacaoGestao_Mnu.php`
- `NegociacaoMotivoPerda_Gde.php`
- `NegociacaoMotivoPerda_Gde_apl.php`
- `NegociacaoObservacao_Lst.php`
- `NegociacaoOrigemPerdasGanhos_Gra.php`
- `NegociacaoPropostaFase_Frm.php`
- `NegociacaoPropostaFase_Frm_apl.php`
- `NegociacaoPropostaFase_Gde.php`
- `NegociacaoPropostaFase_Gde_apl.php`
- `NegociacaoPropostaFase_Lst.php`
- `NegociacaoTarefa_Detalhe_Lst.php`
- `NegociacaoTarefa_Frm.php`
- `NegociacaoTarefa_Frm_apl.php`
- `NegociacaoTarefa_Geral_Lst.php`
- `NegociacaoTarefa_Gestao_Lst.php`
- `NegociacaoTarefa_Lst.php`
- `Negociacao_Detalhe_Lst.php`
- `Negociacao_Frm.php`
- `Negociacao_Frm_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-negociacao-tarefa.md`
- `tela-negociacao.md`
- `tela-pipeline.md`
- `tela-tarefas.md`
- `tela-tipo-negocio.md`

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
