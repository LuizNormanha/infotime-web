# Especificação — cargo

## Objetivo

Migrar o módulo **cargo** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** RH
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/cargo/database/`

| Arquivo TLL |
|-------------|
| `cargo.tll` |
| `cargo_classificacao.tll` |
| `cargo_classificacao_nivel.tll` |
| `cargo_classificacao_nivel_salario.tll` |
| `colaborador_reajuste.tll` |
| `tipo_motivo_reajuste.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/cargo/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `CargoClassificacaoNivelSalario_Gde.php`
- `CargoClassificacaoNivelSalario_Gde_apl.php`
- `CargoClassificacaoNivelSalario_Lst.php`
- `CargoClassificacaoNivel_Gde.php`
- `CargoClassificacaoNivel_Gde_apl.php`
- `CargoClassificacao_Gde.php`
- `CargoClassificacao_Gde_apl.php`
- `Cargo_Gde.php`
- `Cargo_Gde_apl.php`
- `ColaboradorReajuste_Frm.php`
- `ColaboradorReajuste_Frm_apl.php`
- `ColaboradorReajuste_Lst.php`
- `MotivoReajuste_Gde.php`
- `MotivoReajuste_Gde_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-hierarquia-cargos.md`
- `tela-reajuste.md`

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
