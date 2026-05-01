# Especificação — grupo-usuario

## Objetivo

Migrar o módulo **grupo-usuario** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** SYS
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/grupo-usuario/database/`

| Arquivo TLL |
|-------------|
| `grupo_usuario.tll` |
| `grupo_usuario_aplicacao.tll` |
| `grupo_usuario_aplicacao_bloco.tll` |
| `grupo_usuario_aplicacao_campo.tll` |
| `usuario_grupo_usuario.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/grupo-usuario/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `GrupoUsuarioAplicacaoBloco_Gde.php`
- `GrupoUsuarioAplicacaoBloco_Gde_apl.php`
- `GrupoUsuarioAplicacaoCampo_Gde.php`
- `GrupoUsuarioAplicacaoCampo_Gde_apl.php`
- `GrupoUsuarioAplicacao_Frm.php`
- `GrupoUsuarioAplicacao_Frm_apl.php`
- `GrupoUsuarioAplicacao_Gde.php`
- `GrupoUsuarioAplicacao_Gde_apl.php`
- `GrupoUsuario_AutorizacaoAcesso_Frm.php`
- `GrupoUsuario_AutorizacaoAcesso_Frm_apl.php`
- `GrupoUsuario_Autorizacao_Aba.php`
- `GrupoUsuario_Frm.php`
- `GrupoUsuario_Frm_apl.php`
- `GrupoUsuario_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-autorizacao.md`
- `tela-formulario.md`
- `tela-grupo-usuario.md`
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
