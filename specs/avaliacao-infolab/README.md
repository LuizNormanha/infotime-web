# Especificação — avaliacao-infolab

## Objetivo

Migrar o módulo **avaliacao-infolab** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Baixa

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/avaliacao-infolab/database/`

| Arquivo TLL |
|-------------|
| `avaliacao.tll` |
| `info_lab_acesso.tll` |
| `info_lab_noticias.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/avaliacao-infolab/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AvaliacaoInfoLAB_Frm.php`
- `AvaliacaoInfoLAB_Frm_apl.php`
- `AvaliacaoInfoLAB_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-avaliacao-infolab.md`
- `tela-formulario.md`
- `tela-infolab-noticias.md`
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
