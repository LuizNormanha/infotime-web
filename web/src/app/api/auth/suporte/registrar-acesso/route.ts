import { cookies } from "next/headers";
import { NextResponse } from "next/server";

import { fetchComTimeout } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

const CABECALHOS_SEM_CACHE = {
  "Cache-Control": "no-store, no-cache, must-revalidate",
  Pragma: "no-cache",
} as const;

/**
 * POST /api/auth/suporte/registrar-acesso
 * Proxy BFF para Nest após login técnico (suporte/implantação).
 * Repassa cookie + Bearer para o Nest registrar o acesso antes de liberar a sessão.
 */
export async function POST(request: Request) {
  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value ?? null;
  const body: unknown = await request.json().catch(() => ({}));

  const res = await fetchComTimeout(
    `${resolveBackendApiUrl()}/auth/suporte/registrar-acesso`,
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        ...(token ? { Authorization: `Bearer ${token}` } : {}),
        ...(token ? { Cookie: `access_token=${token}` } : {}),
      },
      body: JSON.stringify(body),
      cache: "no-store",
    },
  );

  if (res.status === 204) {
    return new NextResponse(null, { status: 204, headers: CABECALHOS_SEM_CACHE });
  }

  const data = await res.json().catch(() => ({}));
  return NextResponse.json(data, {
    status: res.status,
    headers: CABECALHOS_SEM_CACHE,
  });
}
