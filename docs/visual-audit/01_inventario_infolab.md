# Inventário visual — infolab-web (referência)

Projeto de referência: `C:\prj\trunk\infolab-web` (app Next em `web/`).

## 1. Design tokens (variáveis CSS)

| Origem | Caminho | Conteúdo |
|--------|---------|----------|
| Núcleo marca + bridge Prime | `web/src/components/ui/tema/liga-tema.css` | `:root` com `--liga-verde`, `--liga-fundo-pagina`, `--liga-texto-*`, `--liga-moldura-*`, `--liga-borda-suave`, sombras, zebrado/listagem (`--liga-listagem-*`), `--primary-color`, `--surface-ground`, etc.; `html[data-theme="dark"]` / `html[data-theme="light"]`; override `.p-button { border-radius: 980px; }` |
| Layout / reset / fonte | `web/src/app/globals.css` | `@import` **Inter** (Google Fonts), reset, `.liga-corpo`, `.liga-pagina-home`, … |

Tokens **não** estão em Tailwind como fonte única; o núcleo é **CSS global em `:root`**.

## 2. Tema PrimeReact ativo

Em `web/src/app/layout.tsx`:

- `primereact/resources/primereact.min.css`
- `primereact/resources/themes/lara-light-green/theme.css`
- `primeicons/primeicons.css`
- `@/components/ui/tema/liga-tema.css`
- `./globals.css`

**Tema:** **Lara Light Green** — alinhado ao `infotime-web` (`primeReact.ts`).

## 3. Classes globais (body / shell)

- `<html lang="pt-BR" data-theme="light">` (tema alternável via `LigaProvedorApp`).
- `<body className="liga-corpo">` — flex column, `min-height: 100dvh`, `font-family: var(--liga-font-family)`.

## 4. Componentes Liga — listagem e formulário

| Área | TSX | CSS principal |
|------|-----|----------------|
| Listagem | `web/src/components/formulario-pesquisa/LigaListagemBase.tsx` | `liga-listagem-base.css` (toolbar, título + barra verde, DataTable, paginação, filtros) |
| Formulário base | `web/src/components/formulario-base/LigaFormularioBase.tsx` | `liga-formulario-base.css` |
| Formulário cadastro | `web/src/components/formulario-cadastro/LigaFormularioCadastroBase.tsx` | `liga-formulario-cadastro-base.css`, `liga-lookup-*.css` |
| Abas | `web/src/components/abas/` | `liga-aba.css`, `liga-sistema-abas.css` |

## 5. Overrides PrimeReact (distribuição)

Não existe um único arquivo monolítico; há **núcleo** em `liga-tema.css` e **regras por componente**:

- **DataTable / paginator:** principalmente `liga-listagem-base.css`.
- **Formulário / inputs:** `liga-formulario-base.css`, `liga-formulario-cadastro-base.css`, `liga-campo-texto.css`, `liga-campo-senha.css`.
- **Botões / diálogo:** `liga-botao.css`, `liga-mensagem-pop-up.css`, `liga-dialogo-sessao.css`.

Outros CSS pontuais (login, telas específicas) também usam seletores `.p-*`.

## 6. Referência visual de telas típicas

### Listagem

- Cabeçalho com **barra vertical verde** (`--liga-borda-acento-barra`) ao lado do título; ícone verde; subtítulo com indentação alinhada à barra.
- **Toolbar** em cartão: borda `--liga-borda-suave`, fundo moldura interna, sombra `--liga-sombra-bloco`.
- **DataTable:** cabeçalho e linhas com tokens de listagem (claro/escuro); hover/zebra via `--liga-listagem-*`.

### Formulário

- Topo: título forte (Inter 700), ícone verde, subtítulo secundário; alertas `Message`; áreas de ação; **TabView** quando aplicável com estilos de `liga-aba` / `liga-sistema-abas`.

## 7. Tipografia e marca

- **Fonte:** Inter via Google Fonts em `globals.css`.
- **Logo Infolab:** arquivos em `components/imagem/` e login — específicos do produto; porte para Infotime deve seguir decisão de produto (tokens primeiro).

## 8. Estado do infotime-web (pré-Fase 2)

- `apps/web/src/app/primeReact.ts`: tema **`lara-light-green`**.
- `apps/web/src/shared/styles/liga-app-theme.css`: espelho parcial de `liga-tema.css` + Inter; importado em `main.tsx`.
- Próximos passos (fora deste documento): consolidar em `tokens.css` + `primereact-overrides.css` conforme plano de alinhamento.
