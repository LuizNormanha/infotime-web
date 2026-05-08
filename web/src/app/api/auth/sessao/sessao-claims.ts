/** Alinhado a `LOGINS_USUARIO_GLOBAL_RESERVADOS` / JWT `suporte` na API. */
export const LOGINS_COM_ABA_AUDITORIA = new Set(["suporte", "implantacao"]);

export function decodificarPayload(token: string): Record<string, unknown> | null {
  try {
    const partes = token.split(".");
    if (partes.length !== 3) return null;
    const payload = Buffer.from(partes[1], "base64url").toString("utf-8");
    return JSON.parse(payload) as Record<string, unknown>;
  } catch {
    return null;
  }
}

export function podeVerAuditoria(payload: Record<string, unknown>): boolean {
  if (payload.suporte !== true) return false;
  const email = typeof payload.email === "string" ? payload.email : "";
  const local = email.split("@")[0]?.trim().toLowerCase() ?? "";
  return LOGINS_COM_ABA_AUDITORIA.has(local);
}
