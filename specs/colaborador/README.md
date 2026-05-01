# Especificação — colaborador

## Objetivo

Migrar o módulo **colaborador** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** RH
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/colaborador/database/`

| Arquivo TLL |
|-------------|
| `cbo.tll` |
| `colaborador.tll` |
| `colaborador_telefone.tll` |
| `situacao_colaborador.tll` |
| `tipo_colaborador.tll` |
| `tipo_estado_civil.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/colaborador/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ColaboradorGestao_Mnu.php`
- `ColaboradorPlanoConta_Gde.php`
- `ColaboradorPlanoConta_Gde_apl.php`
- `ColaboradorPlanoConta_Lst.php`
- `ColaboradorSituacaoDash_Lst.php`
- `Colaborador_EnviarEmail_Lst.php`
- `Colaborador_Frm.php`
- `Colaborador_Frm_apl.php`
- `Colaborador_Lst.php`
- `Dash_Colaborador.php`
- `SituacaoColaborador_Gde.php`
- `SituacaoColaborador_Gde_apl.php`
- `TipoColaborador_Frm.php`
- `TipoColaborador_Frm_apl.php`
- `TipoColaborador_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-colaborador.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-tipo-colaborador.md`
- `tela-tipos-formulario.md`

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
