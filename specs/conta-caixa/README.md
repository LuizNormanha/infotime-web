# Especificação — conta-caixa

## Objetivo

Migrar o módulo **conta-caixa** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/conta-caixa/database/`

| Arquivo TLL |
|-------------|
| `cheque.tll` |
| `conta_caixa.tll` |
| `conta_caixa_documento.tll` |
| `conta_caixa_registro.tll` |
| `conta_caixa_registro_lancamento.tll` |
| `conta_caixa_senha.tll` |
| `conta_caixa_transferencia.tll` |
| `conta_caixa_usuario.tll` |
| `conta_telefone.tll` |
| `extrato_conta.tll` |
| `fechamento_financeiro.tll` |
| `talao_cheque.tll` |
| `tipo_especie.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/conta-caixa/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `Cheque_Frm.php`
- `Cheque_Frm_apl.php`
- `Cheque_Lst.php`
- `ContaCaixaDocumento_Frm.php`
- `ContaCaixaDocumento_Frm_apl.php`
- `ContaCaixaDocumento_Lst.php`
- `ContaCaixaGestao_Mnu.php`
- `ContaCaixaRegistroExtratoMensal_Lst.php`
- `ContaCaixaRegistroLancamento_Frm.php`
- `ContaCaixaRegistroLancamento_Frm_apl.php`
- `ContaCaixaRegistroLancamento_Lst.php`
- `ContaCaixaRegistro_Frm.php`
- `ContaCaixaRegistro_Frm_apl.php`
- `ContaCaixaRegistro_LancamentoControle_Gde.php`
- `ContaCaixaRegistro_LancamentoControle_Gde_apl.php`
- `ContaCaixaRegistro_Lst.php`
- `ContaCaixaSenha_Frm.php`
- `ContaCaixaSenha_Frm_apl.php`
- `ContaCaixaSenha_Lst.php`
- `ContaCaixaTransferencia_Frm.php`
- `ContaCaixaTransferencia_Frm_apl.php`
- `ContaCaixaTransferencia_Lst.php`
- `ContaCaixaUsuario_Gde.php`
- `ContaCaixaUsuario_Gde_apl.php`
- `ContaCaixa_Frm.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-conta-caixa.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-registro-caixa.md`
- `tela-transferencia.md`
- `tela-transferencias.md`

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
