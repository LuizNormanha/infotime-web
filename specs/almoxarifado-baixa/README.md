# Especificação — almoxarifado-baixa

## Objetivo

Migrar o módulo **almoxarifado-baixa** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** ALM
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/almoxarifado-baixa/database/`

| Arquivo TLL |
|-------------|
| `almoxarifado_baixa.tll` |
| `almoxarifado_baixa_produto.tll` |
| `almoxarifado_motivo_baixa.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/almoxarifado-baixa/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AlmoxarifadoBaixaProduto_Gde.php`
- `AlmoxarifadoBaixaProduto_Gde_apl.php`
- `AlmoxarifadoBaixaProduto_Lst.php`
- `AlmoxarifadoBaixa_Frm.php`
- `AlmoxarifadoBaixa_Frm_apl.php`
- `AlmoxarifadoBaixa_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-almoxarifado-baixa.md`
- `tela-formulario.md`
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
