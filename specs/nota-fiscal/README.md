# Especificação — nota-fiscal

## Objetivo

Migrar o módulo **nota-fiscal** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** FIN
- **Prioridade:** Crítica

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/nota-fiscal/database/`

| Arquivo TLL |
|-------------|
| `boleto_nota_fiscal.tll` |
| `empresa_nota_fiscal.tll` |
| `nota_fiscal.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/nota-fiscal/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `EmpresaNotaFiscal_Frm.php`
- `EmpresaNotaFiscal_Frm_apl.php`
- `EmpresaNotaFiscal_Lst.php`
- `NotaFisca_lGeracao_Blk.php`
- `NotaFiscal_Frm.php`
- `NotaFiscal_Frm_apl.php`
- `NotaFiscal_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-configuracao-empresa.md`
- `tela-formulario.md`
- `tela-lista.md`
- `tela-nota-fiscal.md`

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
