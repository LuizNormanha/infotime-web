import { cookies } from "next/headers";
import { NextResponse } from "next/server";

import { fetchComTimeout } from "@/lib/fetch-com-timeout";
import { resolveBackendApiUrl } from "@/lib/resolve-backend-api-url";

import { decodificarPayload, podeVerAuditoria } from "./sessao-claims";

/**
 * GET /api/auth/sessao — claims para o client sem expor o JWT bruto.
 * Permissões por formulário vêm só em GET /api/auth/permissoes?tela= (listagem / formulário).
 */
export async function GET() {
  const cookieStore = await cookies();
  const token = cookieStore.get("access_token")?.value ?? null;
  const vazio = {
    idUsuario: null as string | null,
    idTenacidade: null as string | null,
    email: null as string | null,
    podeVerSecaoAuditoriaFormulario: false,
    ehSuporte: false,
    dominioTenacidadeSessao: null as string | null,
    mutacaoTenacidadeImplantacaoPermitida: true,
  };

  if (!token) {
    return NextResponse.json(vazio, {
      headers: { "Cache-Control": "no-store" },
    });
  }

  const payload = decodificarPayload(token);
  if (!payload) {
    return NextResponse.json(vazio, {
      headers: { "Cache-Control": "no-store" },
    });
  }

  const emailJwt =
    typeof payload.email === "string" ? payload.email.trim().toLowerCase() : null;

  let dominioTenacidadeSessao: string | null = null;
  let mutacaoTenacidadeImplantacaoPermitida = true;
  try {
    const resposta = await fetchComTimeout(`${resolveBackendApiUrl()}/auth/status`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Cookie: `access_token=${token}`,
      },
      cache: "no-store",
    });
    if (resposta.ok) {
      const j = (await resposta.json()) as {
        dominioTenacidadeSessao?: string | null;
        mutacaoTenacidadeImplantacaoPermitida?: boolean;
      };
      if (typeof j.dominioTenacidadeSessao === "string") {
        dominioTenacidadeSessao = j.dominioTenacidadeSessao;
      } else if (j.dominioTenacidadeSessao === null) {
        dominioTenacidadeSessao = null;
      }
      if (typeof j.mutacaoTenacidadeImplantacaoPermitida === "boolean") {
        mutacaoTenacidadeImplantacaoPermitida = j.mutacaoTenacidadeImplantacaoPermitida;
      }
    }
  } catch {
    /* API indisponível — não bloqueia o restante da sessão */
  }

  return NextResponse.json(
    {
      idUsuario: typeof payload.sub === "string" ? payload.sub : null,
      idTenacidade:
        typeof payload.tenantId === "string" ? payload.tenantId : null,
      email: emailJwt,
      podeVerSecaoAuditoriaFormulario: podeVerAuditoria(payload),
      ehSuporte: payload.suporte === true,
      dominioTenacidadeSessao,
      mutacaoTenacidadeImplantacaoPermitida,
    },
    { headers: { "Cache-Control": "no-store" } },
  );
}
