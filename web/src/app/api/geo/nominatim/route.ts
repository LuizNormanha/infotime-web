import { cookies } from "next/headers";
import { NextRequest, NextResponse } from "next/server";

const CABECALHOS_SEM_CACHE = {
  "Cache-Control": "no-store, no-cache, must-revalidate",
  Pragma: "no-cache",
} as const;

async function obterTokenOu401(): Promise<string | NextResponse> {
  const store = await cookies();
  const token = store.get("access_token")?.value;
  if (!token?.trim()) {
    return NextResponse.json(
      { message: "Não autenticado." },
      { status: 401, headers: CABECALHOS_SEM_CACHE },
    );
  }
  return token;
}

/** Proxy Nominatim (evita CORS; User-Agent exigido pela política de uso). */
export async function GET(req: NextRequest) {
  const auth = await obterTokenOu401();
  if (auth instanceof NextResponse) return auth;

  const q = req.nextUrl.searchParams.get("q")?.trim() ?? "";
  if (q.length < 8) {
    return NextResponse.json(
      { message: "Consulta muito curta." },
      { status: 400, headers: CABECALHOS_SEM_CACHE },
    );
  }

  const url = new URL("https://nominatim.openstreetmap.org/search");
  url.searchParams.set("format", "json");
  url.searchParams.set("limit", "1");
  url.searchParams.set("q", q);
  url.searchParams.set("countrycodes", "br");

  try {
    const res = await fetch(url.toString(), {
      headers: {
        "User-Agent": "Infotime-Web/1.0 (geocodificacao-cadastro-cliente)",
        Accept: "application/json",
      },
      cache: "no-store",
    });
    if (!res.ok) {
      return NextResponse.json(
        { message: "Falha ao consultar Nominatim." },
        { status: 502, headers: CABECALHOS_SEM_CACHE },
      );
    }
    const data = (await res.json()) as { lat?: string; lon?: string }[];
    const first = Array.isArray(data) ? data[0] : undefined;
    if (!first?.lat || !first?.lon) {
      return NextResponse.json({ lat: null, lon: null }, { headers: CABECALHOS_SEM_CACHE });
    }
    const lat = Number.parseFloat(first.lat);
    const lon = Number.parseFloat(first.lon);
    if (!Number.isFinite(lat) || !Number.isFinite(lon)) {
      return NextResponse.json({ lat: null, lon: null }, { headers: CABECALHOS_SEM_CACHE });
    }
    return NextResponse.json({ lat, lon }, { headers: CABECALHOS_SEM_CACHE });
  } catch {
    return NextResponse.json(
      { message: "Erro de rede na geocodificação." },
      { status: 502, headers: CABECALHOS_SEM_CACHE },
    );
  }
}
