import type { Request } from 'express';

import type { TenantContexto } from '../interfaces/tenant-contexto.interface';

export function montarTenantContexto(
  idTenacidade: bigint,
  idUsuario: bigint,
  isSuporte = false,
): TenantContexto {
  return { idTenacidade, idUsuario, isSuporte };
}

export function obterIpRequisicao(req: Request): string {
  return req.ip ?? req.socket?.remoteAddress ?? '';
}
