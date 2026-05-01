# Especificação — patrimonio

## Objetivo

Migrar o módulo **patrimonio** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** OPS
- **Prioridade:** Média

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/patrimonio/database/`

| Arquivo TLL |
|-------------|
| `patrimonio_bem.tll` |
| `patrimonio_bem_atualizacao.tll` |
| `patrimonio_bem_evento.tll` |
| `patrimonio_bem_foto.tll` |
| `patrimonio_categoria.tll` |
| `patrimonio_estado.tll` |
| `patrimonio_localizacao.tll` |
| `tipo_patrimonio_bem.tll` |
| `tipo_patrimonio_bem_evento.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/patrimonio/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `PatrimonioBemAtualizacao_Frm.php`
- `PatrimonioBemAtualizacao_Frm_apl.php`
- `PatrimonioBemAtualizacao_Lst.php`
- `PatrimonioBemFoto_Frm.php`
- `PatrimonioBemFoto_Frm_apl.php`
- `PatrimonioBemFoto_Frm_novo.php`
- `PatrimonioBemFoto_Frm_novo_apl.php`
- `PatrimonioBemFoto_Lst.php`
- `PatrimonioBem_FotoSalvar_Blk.php`
- `PatrimonioBem_Frm.php`
- `PatrimonioBem_Frm_apl.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
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
