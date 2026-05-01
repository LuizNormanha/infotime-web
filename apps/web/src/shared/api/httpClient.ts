import type { ApiErrorResponse } from "@infotime/shared-types";

/** Base sem barra final; vazio = mesma origem (proxy Vite em dev). */
const API_BASE = (import.meta.env.VITE_API_URL ?? "").replace(/\/+$/, "");

function getToken(): string | null {
  return localStorage.getItem("accessToken");
}

export async function httpJson<T>(
  path: string,
  options: RequestInit = {},
): Promise<T> {
  const headers = new Headers(options.headers);
  headers.set("Content-Type", "application/json");
  const token = getToken();
  if (token) headers.set("Authorization", `Bearer ${token}`);

  const res = await fetch(`${API_BASE}${path}`, { ...options, headers });
  const text = await res.text();
  let body: unknown = null;
  if (text) {
    try {
      body = JSON.parse(text) as unknown;
    } catch {
      const hint =
        res.status === 502 || res.status === 504
          ? "API indisponível (proxy ou servidor parado)."
          : "Resposta não é JSON (verifique se a API Nest está em http://127.0.0.1:3333).";
      throw Object.assign(new Error(hint), { status: res.status, body: null });
    }
  }

  if (!res.ok) {
    const err = body as Record<string, unknown> | null;
    const msg =
      (typeof err?.message === "string" && err.message) ||
      (typeof err?.error === "string" && err.error) ||
      res.statusText;
    throw Object.assign(new Error(msg), {
      status: res.status,
      body: err,
    });
  }

  return body as T;
}
