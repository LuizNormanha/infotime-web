import { SetMetadata } from '@nestjs/common';

export const ROLES_KEY = 'roles';

/**
 * @Roles(...roles) — define os papéis que podem acessar o endpoint.
 *
 * Uso:
 *   @Roles('admin', 'gestor')
 *   @UseGuards(JwtAuthGuard, RolesGuard)
 *   @Delete(':id')
 *   remove(@Param('id') id: string) { ... }
 */
export const Roles = (...roles: string[]) => SetMetadata(ROLES_KEY, roles);
