# Índice — domínio `padroes-ui`

O endpoint `POST /ai/generate` com `dominio: "padroes-ui"` concatena os arquivos listados em **`Rules.manifest.json`** (nesta pasta), **na ordem do array**.

## Organização nova (`forms/`)

As regras por **tipo de tela** passam a viver em `forms/<tipo>/`. Pastas adotadas no manifest: **`forms/listagem/`** (listagem CRUD) e **`forms/formulario/`** (cadastro/edição CRUD). Não há mais arquivo raiz `Rules-listagem.md`.

| Caminho | Conteúdo |
|---------|----------|
| `forms/listagem/README.md` | **Listagem:** layout, i18n, interações, contrato HTTP, matriz exemplo Clientes — entra no manifest **logo após** este índice. |
| `forms/formulario/README.md` | **Formulário cadastro/edição:** layout, UX de campos (rótulos, **calendário visual único**, número, máscaras/dígitos no salvar, autocomplete), subtítulo/topo, validação, auditoria, ações, BFF — exemplo Unidade de atendimento; manifest após a listagem. |
| `forms/formulario/normas-transversais-ui-cadastro.md` | **Normas transversais** já adotadas no código: checklist listagem+formulário, **foco/halo** sem recorte, remissões a botões, grade e endereço. |
| `forms/formulario/cartao-selecao.md` | **Lookup + cartão de resumo em groupbox:** seleção com `LigaLookupCombobox`, `fieldset`/`legend`, cartão somente leitura. |
| `forms/formulario/endereco-cep-geocode-mapa.md` | **Endereço BR:** CEP com ViaCEP automático (sem botão), Nominatim via BFF `/api/geo/nominatim`, lat/long persistidas quando houver colunas, mapa OSM + modal. |
| `forms/formulario/alinhamento-espacamento-formulario.md` | **Grid em formulários Liga:** colunas alinhadas entre linhas; apenas `--liga-cli-form-gap-col` / `--liga-cli-form-gap-row` (ou equivalente); wrapper flex com `gap` = `row-gap`; inputs em flex com `flex:1` para evitar vão falso — referência formulário cliente. |
| `forms/formulario/dialogos-confirmacao-formulario.md` | **Modais de confirmação** (sem `window.confirm`): alterações não salvas ao voltar à lista, exclusão com `Dialog` + `liga-mensagem-pop-up`, botões cápsula, i18n; referência `LigaClienteInfotimeFormulario`. |
| `ui/botoes-listagem-formulario.md` | **Botões de contorno** nas barras de listagem e topo de formulário: altura/padding via `--liga-botao-contorno-*`, cápsula `.p-button`; onde aplicar no CSS base vs. módulo. |
| `Rules-shell-paginas.md` | Shell de páginas, cadastro ↔ listagem, menu e abas. *(planejado — adicionado conforme adoção)* |
| `Rules-formulario-sidebar.md` | Formulário com sidebar (padrão CRUD). *(planejado)* |
| `Rules-formulario-etapas.md` | Wizard horizontal — só se o produto pedir. *(planejado)* |
| `Rules-componentes-campos.md` | FK, lookups, mestre-detalhe, multiselect, máscaras; **calendário de cadastro** e **anti-autocomplete** — ver normas em `forms/formulario/README.md`. *(planejado)* |
| `Rules-mensagens-erros.md` | Erros, `LigaMensagemPopUp`, sem `window.confirm`. *(planejado)* |

> Os arquivos marcados como *(planejado)* já constam do `Rules.manifest.json`; o leitor de manifest do `api/src/ai` ignora silenciosamente os ausentes (vide `leitor-markdown-dominio.service.ts`). Crie os `.md` correspondentes conforme a estrutura evoluir.

## Referências rápidas

- **Listagem (servidor, filtros, chips, export):** `forms/listagem/README.md`.
- **Formulário cadastro/edição (`LigaFormularioCadastroBase`, hook, layout por seções):** `forms/formulario/README.md`.
- **Normas transversais UI (listagem + cadastro, foco, checklist):** `forms/formulario/normas-transversais-ui-cadastro.md`.
- **Lookup + cartão de seleção em groupbox:** `forms/formulario/cartao-selecao.md`.
- **Endereço com CEP, geocodificação e mapa:** `forms/formulario/endereco-cep-geocode-mapa.md`.
- **Alinhamento e espaçamento em formulários (padrão cliente):** `forms/formulario/alinhamento-espacamento-formulario.md`.
- **Diálogos de confirmação (voltar sem salvar, excluir):** `forms/formulario/dialogos-confirmacao-formulario.md`.
- **Botões de toolbar (altura cápsula, tokens):** `ui/botoes-listagem-formulario.md`.

## Documentação humana fora do manifest

- `Context.md`, `Rules.md`, `Schema.md`, `Examples.md` nesta pasta — visão geral / histórica do domínio para humanos. Os arquivos do manifest acima são as **regras prescritivas** consumidas pelo `POST /ai/generate`.
- Outros documentos auxiliares (`docs/exemple/` na raiz do repositório) podem complementar este domínio.
