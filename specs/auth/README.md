# Especificação — auth

## Objetivo

Migrar o módulo **auth** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** SYS
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/auth/database/`

| Arquivo TLL |
|-------------|
| `webcam.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/auth/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `AcessoNegado_Ctr.php`
- `AcessoNegado_Ctr_apl.php`
- `AtivacaoCadastro_Blk.php`
- `Ativacao_Ctr.php`
- `Ativacao_Ctr_apl.php`
- `Login_Ctr.php`
- `Login_Ctr_apl.php`
- `RedefinicaoSenha_Ctr.php`
- `RedefinicaoSenha_Ctr_apl.php`
- `Usuario_SenhaAlterar_Ctr.php`
- `Usuario_SenhaAlterar_Ctr_apl.php`
- `Usuario_SenhaRecuperar_Ctr.php`
- `Usuario_SenhaRecuperar_Ctr_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-alterar-senha.md`
- `tela-login.md`

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
