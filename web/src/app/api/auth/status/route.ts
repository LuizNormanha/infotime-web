import { cookies } from 'next/headers';
import { NextResponse } from 'next/server';

import { fetchComTimeout } from '@/lib/fetch-com-timeout';
import { isAuthStrict, resolveBackendApiUrl } from '@/lib/resolve-backend-api-url';

const NO_STORE = { 'Cache-Control': 'no-store' } as const;

/**
 * Resposta sempre em JSON com `valido`; HTTP 200 na linha feliz e para “sem sessão”,
 * para o DevTools não mostrar 401 falso quando o Nest devolve 429 (throttle) ou outro não-OK.
 * Quem decide logout é só o campo `valido`, não o status HTTP.
 */
export async function GET() {
  const cookieStore = await cookies();
  const token = cookieStore.get('access_token')?.value ?? null;

  if (!token) {
    return NextResponse.json({ valido: false }, { status: 200, headers: NO_STORE });
  }

  try {
    const resposta = await fetchComTimeout(`${resolveBackendApiUrl()}/auth/status`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Cookie: `access_token=${token}`,
      },
      cache: 'no-store',
    });

    if (resposta.status === 429) {
      // Throttle global no Nest: não tratar como sessão inválida (evita logout em cascata).
      return NextResponse.json({ valido: true }, { status: 200, headers: NO_STORE });
    }

    if (resposta.ok) {
      return NextResponse.json({ valido: true }, { status: 200, headers: NO_STORE });
    }

    return NextResponse.json({ valido: false }, { status: 200, headers: NO_STORE });
  } catch {
    if (isAuthStrict()) {
      return NextResponse.json(
        { valido: false, motivo: 'api_indisponivel' },
        { status: 503, headers: NO_STORE },
      );
    }
    // Modo padrão: API fora do ar — considera válido para não bloquear o sistema
    return NextResponse.json({ valido: true }, { headers: NO_STORE });
  }
}
