# Especificação — colaborador-rh

## Objetivo

Migrar o módulo **colaborador-rh** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** RH
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/colaborador-rh/database/`

| Arquivo TLL |
|-------------|
| `cid10.tll` |
| `colaborador_atestado.tll` |
| `colaborador_avaliacao.tll` |
| `colaborador_comp_rendimento.tll` |
| `colaborador_comunicacao.tll` |
| `colaborador_contra_cheque.tll` |
| `colaborador_documento.tll` |
| `colaborador_exame.tll` |
| `colaborador_ferias.tll` |
| `colaborador_ferias_gozadas.tll` |
| `colaborador_folha_ponto.tll` |
| `colaborador_medida_disciplinar.tll` |
| `colaborador_salario_adiantamento.tll` |
| `colaborador_tarefa_legacy.tll` |
| `colaborador_vale_alimentacao_transporte.tll` |
| `tipo_situacao_colaborador_ferias.tll` |
| `tipo_situacao_colaborador_ferias_gozadas.tll` |
| `vale_alimentacao_transporte.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/colaborador-rh/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ColaboradorAtestado_Frm.php`
- `ColaboradorAtestado_Frm_apl.php`
- `ColaboradorAtestado_Lst.php`
- `ColaboradorAvaliacao_Frm.php`
- `ColaboradorAvaliacao_Frm_apl.php`
- `ColaboradorAvaliacao_Lst.php`
- `ColaboradorComprovanteRendimento_Frm.php`
- `ColaboradorComprovanteRendimento_Frm_apl.php`
- `ColaboradorComprovanteRendimento_Lst.php`
- `ColaboradorComunicacao_Frm.php`
- `ColaboradorComunicacao_Frm_apl.php`
- `ColaboradorComunicacao_Lst.php`
- `ColaboradorContraCheque_Frm.php`
- `ColaboradorContraCheque_Frm_apl.php`
- `ColaboradorContraCheque_Lst.php`
- `ColaboradorDocumento_Frm.php`
- `ColaboradorDocumento_Frm_apl.php`
- `ColaboradorDocumento_Lst.php`
- `ColaboradorExame_Frm.php`
- `ColaboradorExame_Frm_apl.php`
- `ColaboradorExame_Lst.php`
- `ColaboradorFeriasDash_Lst.php`
- `ColaboradorFeriasGozadas_Frm.php`
- `ColaboradorFeriasGozadas_Frm_apl.php`
- `ColaboradorFeriasGozadas_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-atestado.md`
- `tela-ferias.md`
- `tela-vale-alimentacao.md`

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
