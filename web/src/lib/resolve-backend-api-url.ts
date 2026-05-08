/**
 * URL base do Nest chamada pelo servidor Next (Route Handlers, Server Components).
 * Configure `API_URL` em `web/.env` (não use variável `NEXT_PUBLIC_*` para isso).
 *
 * Fallback: `http://localhost:3003` quando `API_URL` estiver ausente (dev local).
 */
export function resolveBackendApiUrl(): string {
  return process.env.API_URL ?? "http://localhost:3003";
}

/** `true` se `AUTH_STRICT=1` ou `true` — validação de sessão falha fechada (sem acesso) se a API estiver inacessível. */
export function isAuthStrict(): boolean {
  const v = process.env.AUTH_STRICT?.toLowerCase();
  return v === "1" || v === "true" || v === "yes";
}
