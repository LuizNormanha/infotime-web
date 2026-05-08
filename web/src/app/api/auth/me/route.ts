import { cookies } from 'next/headers';
import { NextResponse } from 'next/server';

import { fetchComTimeout } from '@/lib/fetch-com-timeout';
import { resolveBackendApiUrl } from '@/lib/resolve-backend-api-url';

import { decodificarPayload } from '../sessao/sessao-claims';

/**
 * Menu Implantação: mesma regra que `GuardImplantacaoJwt` na API
 * (JWT suporte + login local `implantacao` ou `suporte`).
 * RLS / `LIGA_BR_TENACIDADE_ID` restringe dados no Postgres, não a entrada do menu.
 */
function ehUsuarioImplantacao(payload: Record<string, unknown> | null): boolean {
  if (!payload || payload.suporte !== true) return false;
  const email = typeof payload.email === 'string' ? payload.email : '';
  const local = email.split('@')[0]?.trim().toLowerCase() ?? '';
  return local === 'implantacao' || local === 'suporte';
}

export async function GET() {
  const cookieStore = await cookies();
  const token = cookieStore.get('access_token')?.value ?? null;
  const payload = token ? decodificarPayload(token) : null;
  const email =
    payload && typeof payload.email === 'string' ? payload.email : null;

  if (token) {
    try {
      const resposta = await fetchComTimeout(
        `${resolveBackendApiUrl()}/auth/status`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
            Cookie: `access_token=${token}`,
          },
          cache: 'no-store',
        },
      );
      if (resposta.ok) {
        const dados = (await resposta.json()) as {
          email?: string | null;
          ehImplantacao?: boolean;
        };
        const emailApi =
          typeof dados.email === 'string' ? dados.email : email;
        const doApi = dados.ehImplantacao === true;
        const doJwt = ehUsuarioImplantacao(payload);
        return NextResponse.json(
          {
            email: emailApi,
            /* API (LIGA_BR na API) OU JWT local (LIGA_BR no web) — evita menu sumir por env só num dos lados */
            ehImplantacao: doApi || doJwt,
          },
          { headers: { 'Cache-Control': 'no-store' } },
        );
      }
    } catch {
      /* API indisponível — fallback abaixo */
    }
  }

  return NextResponse.json(
    { email, ehImplantacao: ehUsuarioImplantacao(payload) },
    { headers: { 'Cache-Control': 'no-store' } },
  );
}
