import { cookies } from "next/headers";
import { NextResponse } from "next/server";

import { fetchComTimeout } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

/** Servidor → Nest (`resolveBackendApiUrl()` = `API_URL` ou fallback). */

export async function GET() {
  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value;

  const res = await fetchComTimeout(`${resolveBackendApiUrl()}/layout/catalogo/personalizacoes`, {
    headers: {
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      "Content-Type": "application/json",
    },
    cache: "no-store",
  });
  const data = await res.json().catch(() => []);
  return NextResponse.json(data, {
    status: res.status,
    headers: { "Cache-Control": "no-store" },
  });
}
