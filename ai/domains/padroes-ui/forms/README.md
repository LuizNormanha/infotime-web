# Regras por tipo de formulário / tela (`forms/`)

Cada subpasta descreve um **padrão de tela** reutilizável no frontend Infotime, alinhado ao código em `web/`.

| Pasta | Status |
|-------|--------|
| `listagem/` | **Ativo** — ver [`listagem/README.md`](listagem/README.md). |
| `formulario/` | **Ativo** — ver [`formulario/README.md`](formulario/README.md) (cadastro/edição CRUD); padrão **lookup + cartão em groupbox:** [`formulario/cartao-selecao.md`](formulario/cartao-selecao.md); padrão **endereço (CEP automático, lat/long, mapa OSM):** [`formulario/endereco-cep-geocode-mapa.md`](formulario/endereco-cep-geocode-mapa.md). |

Novos tipos de tela entram aqui como `README.md` ou conjunto de `.md`, e passam a constar do `Rules.manifest.json` quando forem adotados oficialmente.
