import type { JwtPayload } from "@infotime/shared-types";

export function parseTenantId(payload: JwtPayload): bigint {
  return BigInt(payload.idTenacidade);
}
