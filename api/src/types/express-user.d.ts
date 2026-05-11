export {};

/**
 * `req.user` após `GuardAutenticacaoJwtMultiTenant` (`autenticacao.guard.ts`).
 * Mescla com `Express.User` do Passport (interface vazia por padrão).
 */
declare global {
  namespace Express {
    interface User {
      id_usuario: string;
      tenantId: string;
      suporte: boolean;
      jti: string;
      email?: string;
    }
  }
}
