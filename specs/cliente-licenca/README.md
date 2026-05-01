# Especificação — cliente-licenca

## Objetivo

Migrar o módulo **cliente-licenca** do legado Scriptcase/PHP para o Infotime Web, preservando regras de negócio e aderência aos dados reais (TLL).

## Módulo funcional

- **Área:** CRM
- **Prioridade:** Alta

## Tabelas envolvidas (evidência TLL)

Corpus: `migration-source/infotime-migration/cliente-licenca/database/`

| Arquivo TLL |
|-------------|
| `cliente_aluno.tll` |
| `cliente_equipamento.tll` |
| `cliente_equipamento_acessorio.tll` |
| `cliente_equipamento_chamado.tll` |
| `cliente_equipamento_peca_troca.tll` |
| `cliente_equipamento_servico.tll` |
| `tipo_equipamento.tll` |
| `tipo_equipamento_acessorio.tll` |
| `tipo_equipamento_calibracao.tll` |
| `tipo_equipamento_peca.tll` |

## Telas envolvidas

Ver [`telas.md`](telas.md) e screenshots em `migration-source/infotime-migration/cliente-licenca/screenshots/`.

## Arquivos Scriptcase analisados (amostra)

Total PHP no corpus: amostra abaixo; lista completa sob `scriptcase/`.

- `Cliente_Download_Licenca_Ctr.php`
- `Cliente_Download_Licenca_Ctr_apl.php`
- `Cliente_Licenca_Frm.php`
- `Cliente_Licenca_Frm_apl.php`
- `Cliente_Licenca_Lst.php`
- `Cliente_Licenca_Mobile_Lst.php`

## Specs originais do corpus

- `mapa-campos.md`
- `regras-negocio.md`
- `tela-cliente-licenca.md`
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
