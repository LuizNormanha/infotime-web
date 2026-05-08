import { NextResponse } from "next/server";
import { cookies } from "next/headers";

import { fetchComTimeout } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

import { RECURSOS_PERMITIDOS } from "./recursos-permitidos-bff";

const CABECALHOS_SEM_CACHE = {
  "Cache-Control": "no-store, no-cache, must-revalidate",
  Pragma: "no-cache",
} as const;

async function getToken(): Promise<string | undefined> {
  const store = await cookies();
  return store.get("access_token")?.value;
}

function authHeaders(token?: string): Record<string, string> {
  return token ? { Authorization: `Bearer ${token}` } : {};
}

function proibido() {
  return NextResponse.json(
    { erro: "Recurso não disponível via BFF." },
    { status: 403, headers: CABECALHOS_SEM_CACHE },
  );
}

type RouteParams = { params: Promise<{ path: string[] }> };

/**
 * Lê JSON do corpo de POST/PUT de forma segura.
 * `fetch` sem `body` (ex.: `POST …/clonar`) chega com corpo vazio — `request.json()` falha no App Router.
 */
async function corpoJsonSeguro(request: Request): Promise<Record<string, unknown>> {
  const raw = await request.text();
  if (!raw.trim()) return {};
  try {
    const v = JSON.parse(raw) as unknown;
    return typeof v === "object" && v !== null && !Array.isArray(v)
      ? (v as Record<string, unknown>)
      : {};
  } catch {
    return {};
  }
}

export async function GET(request: Request, { params }: RouteParams) {
  const { path } = await params;
  if (path.length < 1) return proibido();
  const [recurso, ...rest] = path;
  if (!recurso || !RECURSOS_PERMITIDOS.has(recurso)) return proibido();

  const token = await getToken();
  const base = resolveBackendApiUrl();
  const url = new URL(request.url);

  const upstream =
    rest.length === 0
      ? `${base}/${recurso}${url.search}`
      : `${base}/${recurso}/${rest.map((s) => encodeURIComponent(s)).join("/")}${url.search}`;

  const res = await fetchComTimeout(upstream, {
    headers: { ...authHeaders(token) },
    cache: "no-store",
  });

  if (!res.ok) {
    const body = await res.json().catch(() => ({}));
    return NextResponse.json(
      rest.length > 0 ? body : { dados: [], ...body },
      { status: res.status, headers: CABECALHOS_SEM_CACHE },
    );
  }

  const contentType = res.headers.get("content-type") ?? "";
  if (contentType.includes("text/event-stream") && res.body) {
    const headersOut = new Headers(CABECALHOS_SEM_CACHE);
    headersOut.set("Content-Type", contentType);
    headersOut.set("Cache-Control", "no-cache, no-transform");
    headersOut.set("Connection", "keep-alive");
    const xr = res.headers.get("X-Accel-Buffering");
    if (xr) headersOut.set("X-Accel-Buffering", xr);
    return new NextResponse(res.body, { status: res.status, headers: headersOut });
  }

  const data = await res.json();
  return NextResponse.json(data, { status: res.status, headers: CABECALHOS_SEM_CACHE });
}

export async function POST(request: Request, { params }: RouteParams) {
  const { path } = await params;
  if (path.length < 1) return proibido();
  const [recurso] = path;
  if (!recurso || !RECURSOS_PERMITIDOS.has(recurso)) return proibido();

  const token = await getToken();
  const body = await corpoJsonSeguro(request);
  const clientIp =
    request.headers.get("x-forwarded-for") ??
    request.headers.get("x-real-ip") ??
    "";
  const base = resolveBackendApiUrl();
  const upstream = `${base}/${path.map((s) => encodeURIComponent(s)).join("/")}`;

  const res = await fetchComTimeout(upstream, {
    method: "POST",
    headers: {
      ...authHeaders(token),
      "Content-Type": "application/json",
      ...(clientIp ? { "X-Forwarded-For": clientIp } : {}),
    },
    body: JSON.stringify(body),
    cache: "no-store",
  });

  const data = await res.json().catch(() => ({}));
  return NextResponse.json(data, { status: res.status, headers: CABECALHOS_SEM_CACHE });
}

export async function PUT(request: Request, { params }: RouteParams) {
  const { path } = await params;
  if (path.length < 2) return proibido();
  const [recurso] = path;
  if (!recurso || !RECURSOS_PERMITIDOS.has(recurso)) return proibido();

  const token = await getToken();
  const body = await corpoJsonSeguro(request);
  const clientIp =
    request.headers.get("x-forwarded-for") ??
    request.headers.get("x-real-ip") ??
    "";
  const base = resolveBackendApiUrl();
  const upstream = `${base}/${path.map((s) => encodeURIComponent(s)).join("/")}`;

  const res = await fetchComTimeout(upstream, {
    method: "PUT",
    headers: {
      ...authHeaders(token),
      "Content-Type": "application/json",
      ...(clientIp ? { "X-Forwarded-For": clientIp } : {}),
    },
    body: JSON.stringify(body),
    cache: "no-store",
  });

  const data = await res.json().catch(() => ({}));
  return NextResponse.json(data, { status: res.status, headers: CABECALHOS_SEM_CACHE });
}

export async function PATCH(request: Request, { params }: RouteParams) {
  const { path } = await params;
  if (path.length < 2) return proibido();
  const [recurso] = path;
  if (!recurso || !RECURSOS_PERMITIDOS.has(recurso)) return proibido();

  const token = await getToken();
  const body = await corpoJsonSeguro(request);
  const clientIp =
    request.headers.get("x-forwarded-for") ??
    request.headers.get("x-real-ip") ??
    "";
  const base = resolveBackendApiUrl();
  const upstream = `${base}/${path.map((s) => encodeURIComponent(s)).join("/")}`;

  const res = await fetchComTimeout(upstream, {
    method: "PATCH",
    headers: {
      ...authHeaders(token),
      "Content-Type": "application/json",
      ...(clientIp ? { "X-Forwarded-For": clientIp } : {}),
    },
    body: JSON.stringify(body),
    cache: "no-store",
  });

  const data = await res.json().catch(() => ({}));
  return NextResponse.json(data, { status: res.status, headers: CABECALHOS_SEM_CACHE });
}

export async function DELETE(request: Request, { params }: RouteParams) {
  const { path } = await params;
  if (path.length < 2) return proibido();
  const [recurso] = path;
  if (!recurso || !RECURSOS_PERMITIDOS.has(recurso)) return proibido();

  const token = await getToken();
  const base = resolveBackendApiUrl();
  const upstream = `${base}/${path.map((s) => encodeURIComponent(s)).join("/")}`;

  const res = await fetchComTimeout(upstream, {
    method: "DELETE",
    headers: authHeaders(token),
    cache: "no-store",
  });

  const data = await res.json().catch(() => ({}));
  return NextResponse.json(data, { status: res.status, headers: CABECALHOS_SEM_CACHE });
}
