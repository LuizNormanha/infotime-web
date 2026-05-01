# Especificação — auditoria

## Objetivo

Migrar o módulo **auditoria** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** SYS
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/auditoria/database/`

| Arquivo TLL |
|-------------|
| `auditoria.tll` |
| `auditoria_campo.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/auditoria/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AjusteRegistrosDuplicados_Ctr.php`
- `AjusteRegistrosDuplicados_Ctr_apl.php`
- `AuditoriaCampo_Lst.php`
- `AuditoriaRegistro_Lst.php`
- `Auditoria_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-detalhe-campos.md`
- `tela-lista.md`
- `tela-trigger-execucao.md`

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
