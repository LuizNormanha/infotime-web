import { createParamDecorator, ExecutionContext } from '@nestjs/common';
import type { Request } from 'express';

// [SEGURANÇA] Extrai id_tenacidade do JWT — NUNCA do body da requisição.
// O valor é sempre um bigint derivado do JWT assinado pelo servidor no login.
export const TenantAtual = createParamDecorator(
  (data: unknown, ctx: ExecutionContext): bigint => {
    const req = ctx.switchToHttp().getRequest<Request>();
    const user = req['user'] as { tenantId: string };
    return BigInt(user.tenantId);
  },
);
