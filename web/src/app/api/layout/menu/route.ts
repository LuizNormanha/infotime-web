import { cookies } from "next/headers";
import { NextResponse } from "next/server";

import { fetchComTimeout } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

const CABECALHOS_SEM_CACHE = {
  "Cache-Control": "no-store, no-cache, must-revalidate",
  Pragma: "no-cache",
} as const;

/** Menu por perfil (grupo). Query opcional idGrupoUsuario para preferências. */
export async function GET(req: Request) {
  const url = new URL(req.url);
  const idGrupo = url.searchParams.get("idGrupoUsuario");
  const q = idGrupo
    ? `?idGrupoUsuario=${encodeURIComponent(idGrupo)}`
    : "";
  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value;

  try {
    const res = await fetchComTimeout(`${resolveBackendApiUrl()}/layout/menu${q}`, {
      headers: {
        ...(token ? { Authorization: `Bearer ${token}` } : {}),
        "Content-Type": "application/json",
      },
      cache: "no-store",
    });
    const data = await res.json().catch(() => null);
    return NextResponse.json(data, {
      status: res.ok ? 200 : res.status,
      headers: CABECALHOS_SEM_CACHE,
    });
  } catch {
    return NextResponse.json(null, { status: 200, headers: CABECALHOS_SEM_CACHE });
  }
}

export async function PUT(req: Request) {
  const url = new URL(req.url);
  const idGrupo = url.searchParams.get("idGrupoUsuario");
  const q = idGrupo
    ? `?idGrupoUsuario=${encodeURIComponent(idGrupo)}`
    : "";
  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value;
  const body = await req.json().catch(() => ({}));

  const res = await fetchComTimeout(`${resolveBackendApiUrl()}/layout/menu${q}`, {
    method: "PUT",
    headers: {
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      "Content-Type": "application/json",
    },
    body: JSON.stringify(body),
    cache: "no-store",
  });

  if (!res.ok) {
    const err = await res.json().catch(() => ({}));
    return NextResponse.json(err, { status: res.status, headers: CABECALHOS_SEM_CACHE });
  }
  return new NextResponse(null, { status: 204, headers: CABECALHOS_SEM_CACHE });
}
