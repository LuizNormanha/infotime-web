# Especificação — banco

## Objetivo

Migrar o módulo **banco** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/banco/database/`

| Arquivo TLL |
|-------------|
| `agencia.tll` |
| `banco.tll` |
| `bandeira_cartao.tll` |
| `configuracao_cobranca.tll` |
| `operadora.tll` |
| `taxa_cartao.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/banco/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `Agencia_Frm.php`
- `Agencia_Frm_apl.php`
- `Agencia_Lst.php`
- `Banco_Frm.php`
- `Banco_Frm_apl.php`
- `Banco_Lst.php`
- `BandeiraCartao_Gde.php`
- `BandeiraCartao_Gde_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-agencia.md`
- `tela-banco.md`
- `tela-cobranca-formulario.md`
- `tela-configuracao-cobranca.md`
- `tela-lista-bancos.md`

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
