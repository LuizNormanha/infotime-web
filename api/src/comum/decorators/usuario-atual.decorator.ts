import { createParamDecorator, ExecutionContext } from '@nestjs/common';
import type { Request } from 'express';

// [SEGURANÇA] Extrai id_usuario do JWT — NUNCA do body da requisição.
export const UsuarioAtual = createParamDecorator(
  (data: unknown, ctx: ExecutionContext): bigint => {
    const req = ctx.switchToHttp().getRequest<Request>();
    const user = req['user'] as { id_usuario: string };
    return BigInt(user.id_usuario);
  },
);
