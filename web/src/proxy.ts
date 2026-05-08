import { NextRequest, NextResponse } from 'next/server';

import { fetchComTimeout, PROXY_TIMEOUT_MS } from '@/lib/fetch-com-timeout';
import { isAuthStrict, resolveBackendApiUrl } from '@/lib/resolve-backend-api-url';

/** Normaliza pathname (`/login/` → `/login`, `/` mantém). */
function normalizarPathname(pathname: string): string {
  const s = pathname.replace(/\/+$/, '');
  return s === '' ? '/' : s;
}

const ROTAS_PUBLICAS_PREFIXO_EXATO = ['/', '/login'] as const;

/** Arquivos estáticos em /public — não exigir sessão. */
function rotaArquivoEstatico(pathname: string) {
  return /\.(?:ico|png|jpg|jpeg|svg|webp|gif|woff2?)$/i.test(pathname);
}

function rotaExplicitamentePublica(pathnameNorm: string) {
  if (rotaArquivoEstatico(pathnameNorm)) return true;
  if (pathnameNorm.startsWith('/_next')) return true;
  if (pathnameNorm.startsWith('/api')) return true;
  return (ROTAS_PUBLICAS_PREFIXO_EXATO as readonly string[]).some(
    (rota) => pathnameNorm === rota,
  );
}

/**
 * proxy.ts — substitui middleware.ts (convenção Next.js 16).
 * Valida sessão em rotas protegidas via GET /auth/status no Nest.
 */
export default async function proxy(request: NextRequest) {
  const pathnameBruto = request.nextUrl.pathname;
  const pathname = normalizarPathname(pathnameBruto);

  const isPublica = rotaExplicitamentePublica(pathname);

  if (isPublica) return NextResponse.next();

  const token = request.cookies.get('access_token')?.value;

  if (!token) {
    return NextResponse.redirect(new URL('/login', request.url));
  }

  const apiUrl = resolveBackendApiUrl();
  try {
    let resposta: Response | null = null;
    for (let tentativa = 0; tentativa < 2; tentativa++) {
      if (tentativa > 0) {
        await new Promise((r) => setTimeout(r, 150));
      }
      resposta = await fetchComTimeout(
        `${apiUrl}/auth/status`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
            Cookie: `access_token=${token}`,
          },
          cache: 'no-store',
        },
        PROXY_TIMEOUT_MS,
      );
      if (resposta.ok) break;
      // Só repete em falha provavelmente transitória (rede / 5xx)
      const repetir = resposta.status >= 500 || resposta.status === 408;
      if (!repetir) break;
    }

    if (!resposta!.ok) {
      // 401 = JWT inválido ou sessão encerrada no backend
      if (resposta!.status === 401) {
        const response = NextResponse.redirect(new URL('/login', request.url));
        response.cookies.delete('access_token');
        return response;
      }
      // Outros (API indisponível, 5xx, etc.): não apagar cookie — evita "logout" em todo F5 quando a API oscila
      if (isAuthStrict()) {
        return NextResponse.redirect(
          new URL('/login?auth_check=unavailable', request.url),
        );
      }
      return NextResponse.next();
    }
  } catch {
    if (isAuthStrict()) {
      // Falha de rede/timeout: não apagar cookie; sessão pode continuar válida quando a API voltar
      return NextResponse.redirect(
        new URL('/login?auth_check=unavailable', request.url),
      );
    }
    return NextResponse.next();
  }

  return NextResponse.next();
}

export const config = {
  matcher: ['/((?!_next/static|_next/image|favicon.ico).*)'],
};
