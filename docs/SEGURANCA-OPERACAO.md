# Seguranca e Operacao

Este documento resume o baseline minimo para manter o template seguro em ambiente final.

## Variaveis obrigatorias e sensiveis

- API: `DATABASE_URL`, `DATABASE_URL_MIGRATE`, `SUPORTE_SECRET_KEY`.
- Web: `API_URL`.
- Recomendado em ambiente final:
  - `THROTTLER_REDIS_URL` para rate limiting distribuido.
  - `THROTTLE_LOGIN_LIMIT` e `THROTTLE_LOGIN_TTL_MS` para hardening de login.
  - `AUTH_STRICT=true` no web para fail-closed em indisponibilidade da API.

## Checklist de deploy

1. Habilitar HTTPS no frontend e backend.
2. Validar `WEB_URL` da API com as origens reais do frontend.
3. Confirmar `NODE_ENV=production` para cookies `secure`.
4. Definir limite de login restritivo (ex.: 10 tentativas em 15 min).
5. Configurar Redis no throttler quando houver mais de uma instancia da API.
6. Verificar segredo `SUPORTE_SECRET_KEY` forte e rotacionado periodicamente.
7. Rodar `npm audit --audit-level=high` antes de publicar.

## Politica de erros e logs

- Nunca retornar mensagem de erro com detalhes internos de banco (roles, grants, SQL bruto, nomes de migrations).
- Responder com mensagem generica ao cliente e registrar detalhes apenas no log do servidor.
- Mapear erros comuns de persistencia (chave unica, violacao de referencia, nao encontrado) para status HTTP previsiveis.

## Controles de autenticacao

- Login protegido por throttle dedicado (`THROTTLE_LOGIN_*`).
- Cookie `access_token` deve permanecer `httpOnly`.
- Em ambiente final, manter `sameSite=lax` (ou `strict` conforme necessidade do fluxo) e `secure=true`.
- Revisar periodicamente rotas publicas para evitar leitura/escrita sensivel sem validacao de sessao.

## Operacao continua

- Monitorar taxa de 401, 403, 429 e 5xx.
- Definir alerta para picos de tentativas de login por IP.
- Revisar dependencias mensalmente e atualizar pacotes de seguranca.
