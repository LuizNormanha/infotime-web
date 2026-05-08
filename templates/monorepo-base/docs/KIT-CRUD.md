# Kit CRUD — template para novos módulos

Use sempre os **componentes base** e **hooks** já existentes para manter UX, permissões e i18n alinhados.

## Camadas web

| Peça | Caminhos / padrão |
|------|-------------------|
| Listagem | `web/src/components/formulario-pesquisa/LigaListagemBase.tsx` + `useListagemCrudServidor` |
| Formulário | `web/src/components/formulario-cadastro/LigaFormularioCadastroBase.tsx` + `useCadastroFormulario` |
| Layout metadado | Arquivo `*LayoutPadrao.ts` exportando `LayoutFormularioCadastro` |
| Colunas | Definição de colunas tipadas (ex.: `liga-listagem.types.ts`) |
| Rotas App Router | `web/src/app/<modulo>/listagem/page.tsx`, `formulario-cadastro/page.tsx` |

## Camadas API

| Peça | Padrão |
|------|--------|
| Controller | `api/src/<modulo>/<modulo>.controller.ts` — apenas HTTP + DTOs |
| Service | `api/src/<modulo>/<modulo>.service.ts` — Prisma + regras |
| DTOs | `api/src/<modulo>/dto/*.dto.ts` — `class-validator` |
| Module | Registrar em `app.module.ts` |

## BFF

- Rotas em `web/src/app/api/...` seguindo o padrão do projeto **ou** recurso genérico via catch-all com entrada em `recursos-permitidos-bff.ts`.

## Checklist de novo módulo

1. Criar módulo Nest (controller, service, dto, module) e testes se aplicável.
2. Criar páginas Next (listagem + cadastro) e componentes que encapsulam `LigaListagemBase` / `LigaFormularioCadastroBase`.
3. Adicionar chaves em `pt-BR.json` (namespace do módulo).
4. Registrar item no **menu** e no **mapa de abas**.
5. Garantir permissão de tela / formulário no backend (catálogo + perfil).
6. Incluir recurso no BFF allowlist se usar catch-all.

## Entidade demo opcional

Para um exemplo mínimo ponta a ponta, o time pode adicionar uma entidade `exemplo-item` com tabela Prisma **após aprovação** de migration — este template documenta apenas os pontos de integração; não impõe nova tabela sem validação humana.
