# Login, sessão e BFF no Next.js

O frontend **não** chama a API diretamente com token exposto no browser para todas as rotas: parte do fluxo passa por **Route Handlers** em `web/src/app/api/` (BFF), espelhando cookies e proxy para o Nest.

## Fluxo resumido

1. **Login**: página em `web/src/app/login/` → `POST /api/auth/login` → proxy para `POST {API_URL}/auth/login` → repassa `Set-Cookie` (`access_token`) para o domínio do Next.
2. **Navegação**: `web/src/proxy.ts` valida presença do cookie e consulta `GET /auth/status` na API.
3. **Sessão para o cliente**: `GET /api/auth/sessao` decodifica claims necessários para a UI (sem vazar o JWT completo).
4. **Logout**: `POST /api/auth/logout` → API invalida sessão + limpa cookie no BFF.

## Arquivos centrais

| Caminho | Função |
|---------|--------|
| `web/src/proxy.ts` | Gate de rotas; redirect login; status |
| `web/src/app/api/auth/proxy-login-nest.ts` | Proxy de login e cópia de cookie |
| `web/src/app/api/auth/login/route.ts` | Entrada de login |
| `web/src/app/api/auth/login-confirm/route.ts` | Confirmação quando há sessão ativa (409) |
| `web/src/app/api/auth/logout/route.ts` | Logout |
| `web/src/app/api/auth/status/route.ts` | Status tolerante a falhas (429, etc.) |
| `web/src/app/api/auth/sessao/route.ts` | Claims para UI |
| `web/src/app/api/auth/me/route.ts` | Dados auxiliares (ex.: implantação) |
| `web/src/app/api/auth/permissoes/route.ts` | Proxy para permissões por tela |
| `web/src/app/api/[...path]/route.ts` | Catch-all autenticado + allowlist |
| `web/src/app/api/[...path]/recursos-permitidos-bff.ts` | Recursos permitidos ao BFF |
| `web/src/hooks/useSessaoAtual.ts` | Estado de sessão no cliente |
| `web/src/lib/autenticacao/withSessionGuard.ts` | Precheck de sessão |
| `web/src/lib/autenticacao/reautenticacao.ts` | Fluxo de re-login |
| `web/src/lib/resolve-backend-api-url.ts` | `API_URL`, `AUTH_STRICT` |

## Variáveis (`web/.env.example`)

- `API_URL` — base da API Nest (ex.: `http://localhost:3003`).
- Opcional `AUTH_STRICT` — comportamento quando a API está indisponível (ver implementação).

## Novo produto

- Ajustar `WEB_URL` / `API_URL` / CORS na API para os hosts reais.
- Manter allowlist do BFF alinhada aos recursos expostos (`recursos-permitidos-bff.ts`).
- Qualquer nova rota `/api/...` que proxie dados sensíveis deve seguir o mesmo padrão de cookies/credenciais.
