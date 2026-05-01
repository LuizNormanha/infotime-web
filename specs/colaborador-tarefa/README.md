# Especificação — colaborador-tarefa

## Objetivo

Migrar o módulo **colaborador-tarefa** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** OPS
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/colaborador-tarefa/database/`

| Arquivo TLL |
|-------------|
| `colaborador_plano_conta.tll` |
| `colaborador_tarefa.tll` |
| `colaborador_tarefa_historico.tll` |
| `colaborador_tarefa_motivo_prorrogacao.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/colaborador-tarefa/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ColaboradorTarefaMnu_Lst.php`
- `ColaboradorTarefa_Frm.php`
- `ColaboradorTarefa_Frm_apl.php`
- `ColaboradorTarefa_Lst.php`
- `EnviarLembreteTarefa_Blk.php`
- `TarefasAtrasadas_Lst.php`
- `TarefasHoje_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-colaborador-tarefa.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-tarefas-hoje.md`

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
