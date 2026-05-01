import {
  CanActivate,
  ExecutionContext,
  ForbiddenException,
  Injectable,
} from '@nestjs/common';
import { JwtPayload } from '../strategies/jwt.strategy';

/**
 * TenantGuard — garante que o tenantId do JWT coincide com o tenantId
 * do recurso sendo acessado (quando presente na URL como :tenantId).
 *
 * Uso: aplique após JwtAuthGuard em rotas multi-tenant sensíveis.
 */
@Injectable()
export class TenantGuard implements CanActivate {
  canActivate(context: ExecutionContext): boolean {
    const request = context.switchToHttp().getRequest();
    const user = request.user as JwtPayload | undefined;

    if (!user) throw new ForbiddenException('Não autenticado');

    const routeTenantId = Number(request.params?.tenantId);

    // Se a rota não tem :tenantId, libera (o PrismaMiddleware já aplica o filtro)
    if (!routeTenantId || isNaN(routeTenantId)) return true;

    // Admin pode acessar qualquer tenant
    if (user.role === 'admin') return true;

    if (user.tenantId !== routeTenantId) {
      throw new ForbiddenException(
        'Acesso negado: você não pertence a este tenant',
      );
    }

    return true;
  }
}
