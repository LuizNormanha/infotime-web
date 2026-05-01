# Especificação — empresa

## Objetivo

Migrar o módulo **empresa** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** SYS
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/empresa/database/`

| Arquivo TLL |
|-------------|
| `empresa.tll` |
| `empresa_documento.tll` |
| `empresa_operadora.tll` |
| `empresa_senha.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/empresa/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `EmpresaDocumento_Frm.php`
- `EmpresaDocumento_Frm_apl.php`
- `EmpresaDocumento_Lst.php`
- `EmpresaGestao_Mnu.php`
- `EmpresaSenha_Frm.php`
- `EmpresaSenha_Frm_apl.php`
- `EmpresaSenha_Lst.php`
- `Empresa_Frm.php`
- `Empresa_Frm_apl.php`
- `Empresa_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-empresa.md`
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
