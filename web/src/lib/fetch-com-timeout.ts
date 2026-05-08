/**
 * Wrapper de `fetch` com AbortController para evitar requisições penduradas indefinidamente
 * quando o Nest estiver lento ou inacessível.
 *
 * Timeout padrão: 8 s para chamadas de recurso, 5 s para validação de sessão no proxy.
 */

export const BFF_TIMEOUT_MS = 8_000;
export const PROXY_TIMEOUT_MS = 5_000;

export async function fetchComTimeout(
  url: string,
  options: RequestInit = {},
  timeoutMs: number = BFF_TIMEOUT_MS,
): Promise<Response> {
  const controller = new AbortController();
  const timer = setTimeout(() => controller.abort(), timeoutMs);
  try {
    return await fetch(url, { ...options, signal: controller.signal });
  } finally {
    clearTimeout(timer);
  }
}
