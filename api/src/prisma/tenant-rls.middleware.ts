import type { NextFunction, Request, Response } from 'express';
import * as jwt from 'jsonwebtoken';
import { Logger } from '@nestjs/common';

import { resolverEscopoRlsTenant } from './tenant-rls-resolver';
import { tenantRlsStorage } from './tenant-rls.storage';

const logger = new Logger('TenantRlsMiddleware');

/**
 * Define o tenant do JWT no AsyncLocalStorage para toda a requisição (Prisma RLS).
 * Deve rodar após cookie-parser. Login / login-confirm não aplicam escopo (troca de domínio).
 *
 * Usa `jwt.decode` (payload não verificado aqui). Não exponha rotas `@Public()` que consultem
 * Prisma com confiança no tenant derivado só do header/cookie — o guard valida depois.
 *
 * O interceptor Nest + Observable perde o contexto ALS na assinatura do Observable; o middleware
 * Express envolve `next()` dentro do `run`, preservando o store em guards e handlers.
 */
function isRotaLoginSemEscopoTenant(req: Request): boolean {
  const semQuery =
    (req.originalUrl ?? req.url ?? '').split('?')[0] || req.path || '';
  const rotas = ['/auth/login', '/auth/login-confirm'];
  return rotas.some((r) => semQuery === r || semQuery.endsWith(r));
}

export function tenantRlsMiddleware(
  req: Request,
  _res: Response,
  next: NextFunction,
): void {
  if (isRotaLoginSemEscopoTenant(req)) {
    next();
    return;
  }

  try {
    const authHeader = req.headers.authorization;
    let token: string | undefined;
    if (typeof authHeader === 'string' && authHeader.startsWith('Bearer ')) {
      token = authHeader.slice(7);
    } else {
      const cookies = req.cookies as Record<string, string> | undefined;
      token = cookies?.access_token;
    }
    if (!token) {
      next();
      return;
    }
    const decoded = jwt.decode(token) as Record<string, unknown> | null;
    const ctx = resolverEscopoRlsTenant(decoded);
    if (ctx == null) {
      next();
      return;
    }
    tenantRlsStorage.run(ctx, () => {
      next();
    });
  } catch (err) {
    // Registra o erro mas deixa a requisição prosseguir sem escopo de tenant.
    // O guard JWT vai rejeitar a requisição se o token for inválido.
    logger.warn(
      'Falha ao extrair tenantId do token para RLS — requisição continua sem escopo de tenant.',
      err instanceof Error ? err.message : String(err),
    );
    next();
  }
}
