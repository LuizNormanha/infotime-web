# Especificação — portal-cliente

## Objetivo

Migrar o módulo **portal-cliente** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/portal-cliente/database/`

| Arquivo TLL |
|-------------|
| `site_acesso.tll` |
| `site_contato.tll` |
| `site_setor_laboratorio.tll` |
| `site_tipo_assunto.tll` |
| `site_trabalhe_conosco.tll` |
| `tenacidade.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/portal-cliente/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `ClienteGestao_Mnu.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-area-cliente.md`
- `tela-login-cliente.md`

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
