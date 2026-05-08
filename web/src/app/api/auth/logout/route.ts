import { cookies } from 'next/headers';
import { NextResponse } from 'next/server';

import { fetchComTimeout } from '@/lib/fetch-com-timeout';
import { resolveBackendApiUrl } from '@/lib/resolve-backend-api-url';

export async function POST() {
  const cookieStore = await cookies();
  const token = cookieStore.get('access_token')?.value ?? null;

  if (token) {
    try {
      await fetchComTimeout(`${resolveBackendApiUrl()}/auth/logout`, {
        method: 'POST',
        headers: {
          Authorization: `Bearer ${token}`,
          Cookie: `access_token=${token}`,
        },
        cache: 'no-store',
      });
    } catch {
      // falha silenciosa — limpa o cookie de qualquer forma
    }
  }

  const response = NextResponse.json({ ok: true });
  response.cookies.delete('access_token');
  return response;
}
