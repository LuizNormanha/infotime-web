import { NextResponse } from "next/server";

import { fetchComTimeout, PROXY_TIMEOUT_MS } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

/** Mesma base que `api/src/main.ts` e `web/.env.example` (`API_URL`). */
function apiUrl() {
  return resolveBackendApiUrl();
}

function causaRede(err: unknown): string {
  if (!err || typeof err !== "object") return "";
  const c = "cause" in err ? (err as { cause?: unknown }).cause : null;
  if (!c || typeof c !== "object") return "";
  if ("code" in c && typeof (c as { code: unknown }).code === "string") {
    return (c as { code: string }).code;
  }
  return "";
}

/**
 * Encaminha o POST ao Nest e copia o cookie `access_token` para a resposta do Next.
 * Sem isso, o login direto ao Nest grava o cookie só no host da API (ex.: outro host:porta)
 * e o middleware em localhost:3002 nunca vê o token.
 */
export type OpcoesProxyAuthLogin = {
  /** Nome do cookie HTTP-only na resposta do Next (padrão `access_token`). */
  nomeCookieResposta?: string;
};

export async function proxyAuthLogin(
  path: "login" | "login-confirm",
  body: unknown,
  opcoes?: OpcoesProxyAuthLogin,
): Promise<NextResponse> {
  try {
    return await _proxyAuthLoginInterno(path, body, opcoes);
  } catch (err) {
    console.error("[auth] Erro inesperado no proxy de login (/auth/%s):", path, err);
    return NextResponse.json(
      { message: "Erro interno no serviço de autenticação. Tente novamente." },
      { status: 500 },
    );
  }
}

async function _proxyAuthLoginInterno(
  path: "login" | "login-confirm",
  body: unknown,
  opcoes?: OpcoesProxyAuthLogin,
): Promise<NextResponse> {
  const nomeCookie = opcoes?.nomeCookieResposta ?? "access_token";
  let upstream: Response;
  try {
    upstream = await fetchComTimeout(
      `${apiUrl()}/auth/${path}`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(body),
        cache: "no-store",
      },
      PROXY_TIMEOUT_MS,
    );
  } catch (err) {
    const codigo = causaRede(err);
    console.error(
      "[auth] Falha de rede ao contatar API Nest em %s (/auth/%s):",
      apiUrl(),
      path,
      err,
    );
    const msgDev = `Não foi possível conectar à API de autenticação em ${apiUrl()}. Confirme que o serviço Nest está em execução e que API_URL em web/.env aponta para ele (em LAN, use o host/porta que o Next alcança).`;
    const msgProd =
      "Serviço de autenticação indisponível. Tente novamente mais tarde ou contacte o suporte.";
    return NextResponse.json(
      {
        message: process.env.NODE_ENV === "development" ? msgDev : msgProd,
        codigo: codigo || "NETWORK_ERROR",
      },
      { status: 503 },
    );
  }

  let data: unknown;
  const ct = upstream.headers.get("content-type");
  if (ct?.includes("application/json")) {
    try {
      data = await upstream.json();
    } catch {
      data = { message: "Resposta inválida da API" };
    }
  } else {
    const texto = await upstream.text().catch(() => "");
    data = { message: texto || "Resposta vazia da API" };
  }

  const res = NextResponse.json(data, { status: upstream.status });

  if (!upstream.ok) {
    return res;
  }

  const lines =
    typeof upstream.headers.getSetCookie === "function"
      ? upstream.headers.getSetCookie()
      : upstream.headers.get("set-cookie")
        ? [upstream.headers.get("set-cookie") as string]
        : [];

  let applied = false;
  for (const line of lines) {
    if (!line?.startsWith("access_token=")) continue;
    const semi = line.indexOf(";");
    const valuePart = (semi >= 0 ? line.slice(0, semi) : line).slice(
      "access_token=".length,
    );
    let value: string;
    try {
      value = decodeURIComponent(valuePart);
    } catch {
      value = valuePart;
    }
    let maxAge: number | undefined;
    const maxAgeM = /Max-Age=(\d+)/i.exec(line);
    if (maxAgeM) maxAge = parseInt(maxAgeM[1], 10);
    res.cookies.set(nomeCookie, value, {
      httpOnly: true,
      sameSite: "lax",
      secure: process.env.NODE_ENV === "production",
      path: "/",
      ...(maxAge != null && !Number.isNaN(maxAge) ? { maxAge } : {}),
    });
    applied = true;
    break;
  }

  if (!applied) {
    console.warn(
      "[auth] Nest retornou OK em /auth/%s mas sem Set-Cookie access_token",
      path,
    );
  }

  return res;
}
