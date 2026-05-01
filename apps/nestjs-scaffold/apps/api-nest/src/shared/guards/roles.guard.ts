import {
  CanActivate,
  ExecutionContext,
  ForbiddenException,
  Injectable,
} from '@nestjs/common';
import { Reflector } from '@nestjs/core';
import { ROLES_KEY } from '@shared/decorators/roles.decorator';
import { JwtPayload } from '@modules/auth/strategies/jwt.strategy';

/**
 * RolesGuard — verifica se o usuário autenticado possui o papel (role) necessário.
 *
 * Uso:
 *   @UseGuards(JwtAuthGuard, RolesGuard)
 *   @Roles('admin', 'gestor')
 *   @Get()
 *   findAll() { ... }
 *
 * Roles disponíveis: 'admin' | 'gestor' | 'colaborador' | 'cliente' | 'readonly'
 */
@Injectable()
export class RolesGuard implements CanActivate {
  constructor(private readonly reflector: Reflector) {}

  canActivate(context: ExecutionContext): boolean {
    const requiredRoles = this.reflector.getAllAndOverride<string[]>(
      ROLES_KEY,
      [context.getHandler(), context.getClass()],
    );

    // Se não há @Roles() na rota, libera (apenas autenticação é suficiente)
    if (!requiredRoles || requiredRoles.length === 0) return true;

    const request = context.switchToHttp().getRequest();
    const user = request.user as JwtPayload | undefined;

    if (!user) {
      throw new ForbiddenException('Usuário não autenticado');
    }

    const hasRole = requiredRoles.includes(user.role);
    if (!hasRole) {
      throw new ForbiddenException(
        `Acesso negado. Requer: ${requiredRoles.join(', ')}. Seu papel: ${user.role}`,
      );
    }

    return true;
  }
}
