# Normas transversais de UI — listagem e formulário de cadastro

**Objetivo:** consolidar em um único lugar as decisões já adotadas no código para **novas listagens**, **novos formulários CRUD** e evoluções das telas existentes. Este ficheiro **não** substitui os guias temáticos; remete a eles e fixa a **ordem de prioridade** na implementação.

## Ordem de leitura na implementação

1. **Listagem** — [`../listagem/README.md`](../listagem/README.md).
2. **Formulário (casca, seções, hook)** — [`README.md`](README.md).
3. **Botões de toolbar** (altura ~40px, cápsula, tokens) — [`../../ui/botoes-listagem-formulario.md`](../../ui/botoes-listagem-formulario.md).
4. **Alinhamento e espaçamento em grade** — [`alinhamento-espacamento-formulario.md`](alinhamento-espacamento-formulario.md).
5. **Sessão Endereço (BR)** — [`endereco-cep-geocode-mapa.md`](endereco-cep-geocode-mapa.md) — **obrigatório** para qualquer formulário que tenha bloco de endereço brasileiro com o mesmo nível de exigência (CEP, mapa, etc.).
6. **Diálogos de confirmação** (voltar sem salvar, excluir, sem `window.confirm`) — [`dialogos-confirmacao-formulario.md`](dialogos-confirmacao-formulario.md) quando o fluxo usar `LigaFormularioBase` / modais próprios.

---

## 1. Listagem + formulário na mesma linha de produto

- Fluxo com **listagem + cadastro/edição:** reutilizar `LigaListagemBase`, `LigaFormularioCadastroBase`, `LigaFormularioBase`, hook `useCadastroFormulario` e padrões BFF já usados na feature de referência (ex.: cliente).
- **Toolbar:** seguir [`../../ui/botoes-listagem-formulario.md`](../../ui/botoes-listagem-formulario.md); não introduzir alturas ou `border-radius` próprios sem alinhar ao token `--liga-botao-contorno-*` e à cápsula global `.p-button`.

---

## 2. Foco em campos e recorte (halo / borda)

**Problema evitado:** halo de foco **externo** (`box-shadow` sem `inset`) recortado por `overflow` em `main`, cartão, secção ou blocos com `overflow-x: hidden`.

**Regras**

- Em **inputs declarativos** do cadastro (`liga-formulario-input`, `liga-formulario-input-native`) e em **Prime** nos campos da grade (`.liga-formulario-campo`: `p-dropdown`, `p-calendar`, `p-inputnumber`, input interno), o foco visível deve usar **halo interno**: `box-shadow: inset 0 0 0 2px …` e `outline: none` onde aplicável — ver `web/src/components/formulario-cadastro/liga-formulario-cadastro-base.css`.
- **Shell:** `liga-formulario-main` com pequeno `padding-inline` e cartão com padding horizontal ligeiramente reforçado; **secção** com `overflow: visible` quando a rolagem fica no `main` — ver `web/src/components/formulario-base/liga-formulario-base.css` e o alinhamento do cartão em `liga-formulario-cadastro-base.css` com o shell.
- **Raiz do cadastro:** padding horizontal mínimo na `<section class="liga-formulario-cadastro-base">` (inline ou CSS) para não colar o conteúdo à borda do painel.
- **Novos blocos em grade** (especialmente largura total): **não** usar `overflow-x: hidden` no contentor dos inputs sem folga equivalente (`padding-inline` ou halo `inset`); preferir o padrão já aplicado no bloco de endereço do cliente (ver secção «Contentor do bloco» em [`endereco-cep-geocode-mapa.md`](endereco-cep-geocode-mapa.md)).

---

## 3. Checklist rápido para uma nova feature

| Verificação | Onde olhar |
|-------------|------------|
| Botões Novo / Exportar / barra alinhados ao token | `liga-tema.css`, `liga-listagem-base.css` |
| Botões do topo do formulário + etapas + rodapés de diálogo | `liga-tema.css`, `liga-formulario-base.css`, `liga-formulario-cadastro-base.css` |
| Foco sem recorte nas colunas extremas | `liga-formulario-cadastro-base.css`, `liga-formulario-base.css`, `LigaFormularioCadastroBase.tsx` (padding da secção) |
| Endereço BR com mesma disposição de linhas e tokens | [`endereco-cep-geocode-mapa.md`](endereco-cep-geocode-mapa.md) + `liga-cliente-infotime.css` / seções do formulário cliente |
| Confirmações com modal (sem `window.confirm`) | [`dialogos-confirmacao-formulario.md`](dialogos-confirmacao-formulario.md) + `LigaClienteInfotimeFormulario.tsx` |

---

## 4. Índice

- [`../../Rules-indice.md`](../../Rules-indice.md)
