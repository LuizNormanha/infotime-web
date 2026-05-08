# Menu, home e sistema de abas

O **menu** combina dados estáticos/gerados, componentes de navegação (topbar/drawer), **sistema de abas** com carregamento dinâmico de telas e **permissões por tela** (hook + BFF + API).

## Fontes de verdade

| Caminho | Conteúdo |
|---------|----------|
| `web/src/data/menu-estrutura-dst-gerado.ts` | Árvore do menu (DST), rótulos, ícones, ids de aba |
| `web/src/app/home/page.tsx` | Entrada da home após login |
| `web/src/components/navegacao/home/LigaHomeNavegacao.tsx` | Orquestra menu + abas + drawer/topbar |
| `web/src/components/abas/LigaSistemaAbas.tsx` | Motor de abas e imports dinâmicos |
| `web/src/lib/navegacao/home-estado-abas.ts` | Persistência de estado das abas |
| `web/src/hooks/usePermissaoPerfilTelaAtiva.ts` | Permissões da tela ativa |
| `api/src/layout/layout.controller.ts` | `GET/PUT /layout/menu` — menu persistido por tenant |
| `api/src/layout/layout.service.ts` | Resolução e validação do JSON de menu |

## Permissões

- Frontend consulta permissões conforme a **tela ativa** (contexto publicado pelo sistema de abas).
- Backend: catálogo de formulários / permissões conforme schema e `autenticacao.service`.

## Adaptar ao novo projeto

1. **Editar ou regenerar** `menu-estrutura-dst-gerado.ts` para refletir módulos do novo produto (remover entradas de domínios podados).
2. Registrar novas telas no **mapa de abas** usado por `LigaSistemaAbas` (imports dinâmicos por rota/componente).
3. Garantir **slug de tela** consistente entre menu, permissões e catálogo no banco.
4. Se usar menu persistido por tenant, validar JSON com as regras em `layout-menu-validacao.ts`.
