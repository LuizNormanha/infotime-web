import { cookies } from "next/headers";
import { NextResponse } from "next/server";

import { fetchComTimeout } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

/** Catálogo de formulários (telas + menu). */
export async function GET() {
  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value;

  const res = await fetchComTimeout(`${resolveBackendApiUrl()}/layout/catalogo/formularios`, {
    headers: {
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      "Content-Type": "application/json",
    },
    cache: "no-store",
  });

  const data = await res.json().catch(() => []);
  return NextResponse.json(data, {
    status: res.ok ? 200 : res.status,
    headers: { "Cache-Control": "no-store" },
  });
}
