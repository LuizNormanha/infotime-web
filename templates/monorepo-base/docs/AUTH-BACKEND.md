# Núcleo de autenticação na API (NestJS)

Este template preserva o fluxo **Infotime**: login resolve tenant (por domínio do e-mail), valida credencial, abre **sessão no PostgreSQL**, emite **JWT** e grava cookie `access_token` via resposta; o **guard** valida assinatura, `jti` ativo e renova expiração (sliding).

## Arquivos centrais

| Caminho | Função |
|---------|--------|
| `api/src/autenticacao/autenticacao.module.ts` | Módulo de auth |
| `api/src/autenticacao/autenticacao.controller.ts` | Rotas `/auth/*` (login, login-confirm, logout, status, permissoes) |
| `api/src/autenticacao/autenticacao.service.ts` | Regras de login, sessão, JWT, captcha, suporte |
| `api/src/autenticacao/autenticacao.guard.ts` | Validação global (APP_GUARD) |
| `api/src/autenticacao/autenticacao.strategy.ts` | Extração JWT (Bearer / cookie) |
| `api/src/comum/decorators/public.decorator.ts` | Marca rotas públicas |
| `api/src/comum/decorators/tenant-atual.decorator.ts` / `usuario-atual.decorator.ts` | Injeção a partir do JWT |
| `api/src/main.ts` | `cookie-parser`, CORS com credenciais, middleware de tenant/RLS |
| `api/src/app.module.ts` | Registro do guard e módulos |
| `api/src/prisma/` | Cliente estendido + middleware RLS + storage de tenant |

## Contratos mínimos

### Variáveis de ambiente (`api/.env.example`)

- `DATABASE_URL` — PostgreSQL.
- `SUPORTE_SECRET_KEY` — fluxo técnico/suporte.
- `WEB_URL` — origem do Next para CORS e cookie-aware flows.

### Banco

- Tabelas de sessão e usuário conforme `api/prisma/schema.prisma` e migrations.
- Função SQL usada no login por domínio: `infotime_tenant_ativo_por_dominio` — **não remover** sem substituir estratégia de resolução de tenant.

### JWT / sessão

- Cookie HTTP-only `access_token` alinhado ao consumo do BFF.
- Guard exige `jti` com sessão ativa no banco; sem isso a API rejeita o token.

## Ao extrair para um produto novo

1. Manter **Prisma + migrations** coerentes com o guard.
2. Não aceitar `id_tenacidade` (ou equivalente) vindo do body em contratos “tenant vem da sessão”.
3. Revisar módulos de negócio em `api/src/` — podar apenas o que não for do novo produto, sem quebrar imports globais (`app.module.ts`).
