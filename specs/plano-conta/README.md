# Especificação — plano-conta

## Objetivo

Migrar o módulo **plano-conta** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/plano-conta/database/`

| Arquivo TLL |
|-------------|
| `centro_custo.tll` |
| `centro_custo_vigencia.tll` |
| `fluxo_caixa.tll` |
| `plano_conta.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/plano-conta/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `CentroCustoVigencia_Gde.php`
- `CentroCustoVigencia_Gde_apl.php`
- `CentroCusto_Frm.php`
- `CentroCusto_Frm_apl.php`
- `CentroCusto_Lst.php`
- `DespesaMes_Ctr.php`
- `DespesaMes_Ctr_apl.php`
- `Dre_Lst.php`
- `FluxoCaixaAnoBase_Ctr.php`
- `FluxoCaixaAnoBase_Ctr_apl.php`
- `FluxoCaixaAnoBase_Novo_Ctr.php`
- `FluxoCaixaAnoBase_Novo_Ctr_apl.php`
- `FluxoCaixaResumido_Lst.php`
- `FluxoCaixa_AnoEmpresa_Ctr.php`
- `FluxoCaixa_AnoEmpresa_Ctr_apl.php`
- `IndicadorFinanceiro_Cor.php`
- `IndicadorFinanceiro_Tab.php`
- `PlanoConta2_Frm.php`
- `PlanoConta2_Frm_apl.php`
- `PlanoConta2_Lst.php`
- `PlanoConta_Frm.php`
- `PlanoConta_Frm_apl.php`
- `PlanoConta_Lst.php`
- `PrevistoRealizadoMes_Ctr.php`
- `PrevistoRealizadoMes_Ctr_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-centro-custo-formulario.md`
- `tela-centro-custo.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-plano-conta.md`

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
