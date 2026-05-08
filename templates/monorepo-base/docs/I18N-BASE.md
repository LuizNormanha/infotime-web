# Internacionalização (i18n) — baseline

O projeto usa **next-intl** com locale fixo **pt-BR** na configuração atual.

## Arquivos centrais

| Caminho | Função |
|---------|--------|
| `web/src/app/layout.tsx` | `NextIntlClientProvider` |
| `web/src/app/(comum)/i18n/request.ts` | Carregamento de mensagens |
| `web/src/app/(comum)/i18n/mensagens/pt-BR.json` | Todas as chaves de UI organizadas por árvore |

## Padrão de chaves

- `home.menu`, `home.topbar`, `home.abas`, `home.formulario`, `home.listagem`, etc.
- Validação de erros de API: `web/src/lib/validacao-api-i18n.ts` mapeia erros do Nest para chaves i18n.

## Novo produto

1. Evitar strings literais em componentes que já usam o padrão “home”; preferir chaves em `pt-BR.json`.
2. Para novos módulos, criar subárvore consistente (ex.: `home.listagem.meuModulo.*`).
3. Se no futuro houver segundo idioma, estender `mensagens/` e o carregamento em `request.ts`.
