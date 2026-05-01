# Especificação — contrato

## Objetivo

Migrar o módulo **contrato** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/contrato/database/`

| Arquivo TLL |
|-------------|
| `contrato.tll` |
| `contrato_item.tll` |
| `tipo_contrato.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/contrato/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ClienteContrato_Lst.php`
- `ContratoAniversario_Lst.php`
- `ContratoItem_Gde.php`
- `ContratoItem_Gde_apl.php`
- `ContratoItem_Lst.php`
- `Contrato_Frm.php`
- `Contrato_Frm_apl.php`
- `Contrato_Lst.php`
- `TipoContrato_Frm.php`
- `TipoContrato_Frm_apl.php`
- `TipoContrato_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-formulario.md`
- `tela-indice-reajuste.md`
- `tela-lista-aniversarios.md`
- `tela-lista.md`
- `tela-tipo-contrato.md`

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
