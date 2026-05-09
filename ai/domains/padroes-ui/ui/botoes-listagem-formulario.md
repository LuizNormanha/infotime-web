# Botões de contorno em listagens e formulários (altura e forma)

**Objetivo:** manter **mesma altura** (~40px no viewport de referência) e **forma em cápsula** em todos os botões de ação em **barras de listagem** e **topo/cabeçalho de formulários** (Novo, Exportar, Limpar, Ações em dropdown, ícones quadrados da busca, etc.), alinhados ao botão **Exportar** da listagem (`p-button-sm` + `outlined`).

**Fonte de verdade no código**

| Peça | Caminho |
|------|---------|
| Tokens globais | `web/src/components/ui/tema/liga-tema.css` — `--liga-botao-contorno-altura` (ex.: `2.5rem`), `--liga-botao-contorno-padding-inline` (ex.: `0.75rem 0.85rem`); comentário no arquivo explica a referência ao Exportar. |
| Forma cápsula (Prime) | Mesmo arquivo: regra `.p-button { border-radius: 980px; box-sizing: border-box; }` — **não** duplicar `border-radius` arbitrário em features; exceções só com justificativa de UX. |
| Listagem | `web/src/components/formulario-pesquisa/liga-listagem-base.css` — título (Novo/Exportar), moldura de busca, dropdown «Pesquisar por», ellipsis de filtros, Limpar, botões só ícone. |
| Formulário (casca) | `web/src/components/formulario-base/liga-formulario-base.css` — `.liga-formulario-acoes-topo .p-button`, `.liga-formulario-secao-cabecalho-acoes .p-button`, dropdown «Ações». |
| Exceção pontual em módulo | Ex.: `web/src/components/cliente/liga-cliente-infotime.css` — botão **Expandir mapa** no bloco de endereço, quando não estiver coberto pelos escopos acima. |

## Regras para novas telas

1. **Usar** `Button` do Prime com `size="small"` e `outlined` onde o padrão da listagem/form já usa (toolbar, ações secundárias).
2. **Não** fixar altura com valores mágicos (`40px`, `2.25rem` soltos) em CSS de feature: usar **`var(--liga-botao-contorno-altura)`** e **`var(--liga-botao-contorno-padding-inline)`** nos seletores do escopo da barra (`.liga-listagem-*`, `.liga-formulario-*`) ou estender o CSS base se o controle for **genérico** a todas as listagens/formulários.
3. **Controles só ícone** na mesma faixa: `width` / `height` / `min-width` iguais a `--liga-botao-contorno-altura` para alinhar à moldura de busca e aos botões com rótulo.
4. Se um botão novo na barra **não** herdar o tamanho (especificidade do Prime ou wrapper extra), **replicar o padrão** no mesmo ficheiro CSS já responsável pela área (base vs. módulo), em vez de inventar outro token.

Índice do domínio: [`../Rules-indice.md`](../Rules-indice.md). Listagem e formulário: [`../forms/listagem/README.md`](../forms/listagem/README.md), [`../forms/formulario/README.md`](../forms/formulario/README.md). **Normas transversais** (checklist, foco): [`../forms/formulario/normas-transversais-ui-cadastro.md`](../forms/formulario/normas-transversais-ui-cadastro.md).
