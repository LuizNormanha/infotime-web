# Exemplos — Padrões de UI

## Listagem CRUD com dados no servidor

1. Tela usa `LigaListagemBase` + hook de listagem servidor (ex.: `useListagemCrudServidor`).
2. Após `if (servidor == null) return …`, espalhar **`{...servidor}`** nas props do componente de listagem (modo listagem normal; em `modoSelecao` o contrato pode omitir servidor por desenho).
3. Colunas com busca no banco: `pesquisaServidor: true`, `campoConsulta` alinhado à **whitelist** do endpoint Nest.
4. Resposta da API: `{ dados: [...], total: number }`; query com `cargaInicial`, `pagina`, `tamanhoPagina`, `q`, `campoPesquisa`, `filtroRefinado` quando aplicável (ver `Rules.md` §11.5– §11.6).

## Formulário de cadastro

1. Base: `LigaFormularioCadastroBase` + `useCadastroFormulario` (ou padrão equivalente do template).
2. Validação exibida no cliente deve respeitar foco/rolagem até o primeiro erro (ver `Rules.md` §8).
3. Textos via **next-intl** (chaves por tela/módulo).

## Novo projeto a partir do template

1. Clonar/copiar o monorepo template.
2. Apontar `DATABASE_URL` / Prisma para o banco da nova aplicação.
3. Criar `ai/domains/<entidade>/` com Context, Rules, Schema, Examples **do produto**.
4. Implementar rotas `listagem` e `formulario-cadastro` (ou equivalente) seguindo **`padroes-ui/Rules.md`**.
