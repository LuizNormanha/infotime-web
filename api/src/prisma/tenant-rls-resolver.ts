import type { TenantRlsContext } from './tenant-rls.storage';

/** Extrai `tenantId` numérico do payload JWT para `app.current_tenant_id` nas queries RLS. */
export function resolverEscopoRlsTenant(
  decoded: Record<string, unknown> | null,
): TenantRlsContext | null {
  if (!decoded || typeof decoded !== 'object') return null;

  const raw = decoded.tenantId;
  if (raw === undefined || raw === null) return null;
  const tenantIdStr = String(raw).trim();
  if (tenantIdStr === '') return null;

  try {
    const tenantId = BigInt(tenantIdStr);
    return { tenantId };
  } catch {
    return null;
  }
}
