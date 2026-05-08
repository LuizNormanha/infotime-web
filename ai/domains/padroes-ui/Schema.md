# Schema — Padrões de UI

Este domínio **não** mapeia tabelas SQL. A “fonte de verdade” estrutural é o **código TypeScript** do template:

| Conceito | Onde ver |
|----------|-----------|
| Colunas, filtros refinados, paginação servidor | `web/src/components/formulario-pesquisa/liga-listagem.types.ts` |
| Parâmetros de query de listagem | `web/src/lib/listagem-servidor-query.ts` (`montarSearchParamsListagemPadrao`) |
| Ordem de colunas (chave técnica à direita) | `web/src/components/formulario-pesquisa/liga-listagem-ordenacao-colunas.ts` |

Novos projetos devem **alinhar** DTOs e query params da API a esses contratos quando usarem `LigaListagemBase` e hooks associados.
