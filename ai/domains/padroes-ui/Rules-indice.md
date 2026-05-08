# Índice — domínio `padroes-ui`

O endpoint `POST /ai/generate` com `dominio: "padroes-ui"` concatena os arquivos listados em **`Rules.manifest.json`** (nesta pasta), **na ordem do array**.

## Organização nova (`forms/`)

As regras por **tipo de tela** passam a viver em `forms/<tipo>/`. Pastas adotadas no manifest: **`forms/listagem/`** (listagem CRUD) e **`forms/formulario/`** (cadastro/edição CRUD). Não há mais arquivo raiz `Rules-listagem.md`.

| Caminho | Conteúdo |
|---------|----------|
| `forms/listagem/README.md` | **Listagem:** layout, i18n, interações, contrato HTTP, matriz exemplo Clientes — entra no manifest **logo após** este índice. |
| `forms/formulario/README.md` | **Formulário cadastro/edição:** layout, UX de campos (rótulos, **calendário visual único**, número, máscaras/dígitos no salvar, autocomplete), subtítulo/topo, validação, auditoria, ações, BFF — exemplo Unidade de atendimento; manifest após a listagem. |
| `forms/formulario/cartao-selecao.md` | **Lookup + cartão de resumo em groupbox:** seleção com `LigaLookupCombobox`, `fieldset`/`legend`, cartão somente leitura. |
| `Rules-shell-paginas.md` | Shell de páginas, cadastro ↔ listagem, menu e abas. *(planejado — adicionado conforme adoção)* |
| `Rules-formulario-sidebar.md` | Formulário com sidebar (padrão CRUD). *(planejado)* |
| `Rules-formulario-etapas.md` | Wizard horizontal — só se o produto pedir. *(planejado)* |
| `Rules-componentes-campos.md` | FK, lookups, mestre-detalhe, multiselect, máscaras; **calendário de cadastro** e **anti-autocomplete** — ver normas em `forms/formulario/README.md`. *(planejado)* |
| `Rules-mensagens-erros.md` | Erros, `LigaMensagemPopUp`, sem `window.confirm`. *(planejado)* |

> Os arquivos marcados como *(planejado)* já constam do `Rules.manifest.json`; o leitor de manifest do `api/src/ai` ignora silenciosamente os ausentes (vide `leitor-markdown-dominio.service.ts`). Crie os `.md` correspondentes conforme a estrutura evoluir.

## Referências rápidas

- **Listagem (servidor, filtros, chips, export):** `forms/listagem/README.md`.
- **Formulário cadastro/edição (`LigaFormularioCadastroBase`, hook, layout por seções):** `forms/formulario/README.md`.
- **Lookup + cartão de seleção em groupbox:** `forms/formulario/cartao-selecao.md`.

## Documentação humana fora do manifest

- `Context.md`, `Rules.md`, `Schema.md`, `Examples.md` nesta pasta — visão geral / histórica do domínio para humanos. Os arquivos do manifest acima são as **regras prescritivas** consumidas pelo `POST /ai/generate`.
- Outros documentos auxiliares (`docs/exemple/` na raiz do repositório) podem complementar este domínio.
