import { CanActivate, ExecutionContext, ForbiddenException, Injectable } from '@nestjs/common';

@Injectable()
export class TenantGuard implements CanActivate {
  canActivate(context: ExecutionContext): boolean {
    const req = context.switchToHttp().getRequest();
    const user = req.user;
    if (!user) throw new ForbiddenException('Não autenticado');
    const routeTenantId = Number(req.params?.tenantId);
    if (!routeTenantId || Number.isNaN(routeTenantId)) return true;
    if (user.role === 'admin') return true;
    if (Number(user.tenantId) !== routeTenantId) {
      throw new ForbiddenException('Acesso negado: tenant inválido');
    }
    return true;
  }
}
