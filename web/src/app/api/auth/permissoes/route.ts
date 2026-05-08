import { NextResponse } from "next/server";
import { cookies } from "next/headers";

import { fetchComTimeout, PROXY_TIMEOUT_MS } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

export async function GET(request: Request) {
  const url = new URL(request.url);
  const tela = (url.searchParams.get("tela") ?? "").trim();
  if (!tela) {
    return NextResponse.json(
      { message: "Informe a tela para consultar permissões." },
      { status: 400 },
    );
  }

  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value;
  if (!token) {
    return NextResponse.json(
      { message: "Sessão não encontrada." },
      { status: 401 },
    );
  }

  const upstream = await fetchComTimeout(
    `${resolveBackendApiUrl()}/auth/permissoes?tela=${encodeURIComponent(tela)}`,
    {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cache: "no-store",
    },
    PROXY_TIMEOUT_MS,
  );

  if (!upstream.ok) {
    const erro = await upstream.json().catch(() => ({ message: `Erro ${upstream.status}` }));
    return NextResponse.json(erro, {
      status: upstream.status,
      headers: { "Cache-Control": "no-store, no-cache, must-revalidate" },
    });
  }

  const data = await upstream.json().catch(() => null);
  if (!data || typeof data !== "object") {
    return NextResponse.json(
      { possuiRegra: false, incluir: true, editar: true, excluir: true },
      { status: 200, headers: { "Cache-Control": "no-store, no-cache, must-revalidate" } },
    );
  }

  return NextResponse.json(data, {
    status: 200,
    headers: { "Cache-Control": "no-store, no-cache, must-revalidate" },
  });
}
