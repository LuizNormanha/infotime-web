# Especificação — configuracao

## Objetivo

Migrar o módulo **configuracao** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** SYS
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/configuracao/database/`

| Arquivo TLL |
|-------------|
| `comunicacao.tll` |
| `configuracao.tll` |
| `consumo.tll` |
| `consumo_item.tll` |
| `email_modelo.tll` |
| `feriado.tll` |
| `mensagem_padrao.tll` |
| `processamento.tll` |
| `tipo_mensagem.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/configuracao/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ConfiguracaoCobranca_Frm.php`
- `ConfiguracaoCobranca_Frm_apl.php`
- `ConfiguracaoCobranca_Lst.php`
- `Configuracao_Frm.php`
- `Configuracao_Frm_apl.php`
- `Configuracao_Lst.php`
- `EmailModelo_Frm.php`
- `EmailModelo_Frm_apl.php`
- `EmailModelo_Lst.php`
- `MensagemPadrao_Gde.php`
- `MensagemPadrao_Gde_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-configuracao.md`
- `tela-formulario.md`

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
