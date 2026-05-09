# Regras por tipo de formulário / tela (`forms/`)

Cada subpasta descreve um **padrão de tela** reutilizável no frontend Infotime, alinhado ao código em `web/`.

| Pasta | Status |
|-------|--------|
| `listagem/` | **Ativo** — ver [`listagem/README.md`](listagem/README.md). |
| `formulario/` | **Ativo** — ver [`formulario/README.md`](formulario/README.md) (cadastro/edição CRUD); **normas transversais UI** (listagem+form, foco, checklist): [`formulario/normas-transversais-ui-cadastro.md`](formulario/normas-transversais-ui-cadastro.md); **alinhamento de colunas + espaçamento regulamentado (referência cliente Liga):** [`formulario/alinhamento-espacamento-formulario.md`](formulario/alinhamento-espacamento-formulario.md); **diálogos de confirmação** (voltar sem salvar, excluir, sem `window.confirm`): [`formulario/dialogos-confirmacao-formulario.md`](formulario/dialogos-confirmacao-formulario.md); padrão **lookup + cartão em groupbox:** [`formulario/cartao-selecao.md`](formulario/cartao-selecao.md); padrão **endereço (CEP automático, lat/long, mapa OSM):** [`formulario/endereco-cep-geocode-mapa.md`](formulario/endereco-cep-geocode-mapa.md). |

Novos tipos de tela entram aqui como `README.md` ou conjunto de `.md`, e passam a constar do `Rules.manifest.json` quando forem adotados oficialmente.
