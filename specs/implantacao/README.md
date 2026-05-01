# Especificação — implantacao

## Objetivo

Migrar o módulo **implantacao** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** OPS
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/implantacao/database/`

| Arquivo TLL |
|-------------|
| `categoria_produto_tarefa.tll` |
| `contrato_tarefa.tll` |
| `contrato_tarefa_atividade.tll` |
| `situacao_atividade.tll` |
| `situacao_tarefa_implantacao.tll` |
| `tipo_tarefa_implantacao.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/implantacao/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `CategoriaProdutoTarefa_Frm.php`
- `CategoriaProdutoTarefa_Frm_apl.php`
- `CategoriaProdutoTarefa_Lst.php`
- `Implantacao_Ctr.php`
- `Implantacao_Ctr_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-categoria-tarefa-implantacao.md`
- `tela-lista-template.md`
- `tela-wizard-implantacao.md`

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
