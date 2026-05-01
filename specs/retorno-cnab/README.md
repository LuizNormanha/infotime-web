# Especificação — retorno-cnab

## Objetivo

Migrar o módulo **retorno-cnab** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/retorno-cnab/database/`

| Arquivo TLL |
|-------------|
| `retorno.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/retorno-cnab/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `CompetenciaRetornoCsv_Ctr.php`
- `CompetenciaRetornoCsv_Ctr_apl.php`
- `EscolherRetorno_Blk.php`
- `ReceberRetorno_Ctr.php`
- `ReceberRetorno_Ctr_apl.php`
- `Retorno_CNAB_Ctr.php`
- `Retorno_CNAB_Ctr_apl.php`
- `Retorno_Detalhe_Lst.php`
- `Retorno_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-importacao.md`
- `tela-lista.md`
- `tela-retorno-cnab.md`

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
