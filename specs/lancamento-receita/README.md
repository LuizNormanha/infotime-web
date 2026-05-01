# Especificação — lancamento-receita

## Objetivo

Migrar o módulo **lancamento-receita** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/lancamento-receita/database/`

| Arquivo TLL |
|-------------|
| `email_enviado.tll` |
| `fatura.tll` |
| `fatura_item.tll` |
| `lancamento_receita.tll` |
| `lancamento_receita_rateio.tll` |
| `situacao_documento.tll` |
| `tipo_agente.tll` |
| `venda_direta.tll` |
| `venda_direta_item.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/lancamento-receita/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `EnviarEmails_Ass_Ctr.php`
- `EnviarEmails_Ass_Ctr_apl.php`
- `EnviarEmails_Ctr.php`
- `EnviarEmails_Ctr_apl.php`
- `EnviarLembrete_Blk.php`
- `LancamentoReceitaRateio_Gde.php`
- `LancamentoReceitaRateio_Gde_apl.php`
- `LancamentoReceitaRelPeriodo_Blk.php`
- `LancamentoReceitaRelPeriodo_Ctr.php`
- `LancamentoReceitaRelPeriodo_Ctr_apl.php`
- `LancamentoReceita_Atraso_Lst.php`
- `LancamentoReceita_Baixa_Lst.php`
- `LancamentoReceita_Boleto_Lst.php`
- `LancamentoReceita_Boleto_Pix_Lst.php`
- `LancamentoReceita_Extender_Frm.php`
- `LancamentoReceita_Extender_Frm_apl.php`
- `LancamentoReceita_Frm.php`
- `LancamentoReceita_Frm_apl.php`
- `LancamentoReceita_Lst.php`
- `LancamentoReceita_Recibo_Blk.php`
- `LancamentoReceita_Recorrente_Ctr.php`
- `LancamentoReceita_Recorrente_Ctr_apl.php`
- `LancamentoReceita_Recorrente_Frm.php`
- `LancamentoReceita_Recorrente_Frm_apl.php`
- `LancamentoReceita_Recorrente_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-formulario.md`
- `tela-lancamento-receita.md`
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
