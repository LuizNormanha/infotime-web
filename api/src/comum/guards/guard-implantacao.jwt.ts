import {
  CanActivate,
  ExecutionContext,
  ForbiddenException,
  Injectable,
} from '@nestjs/common';
import type { Request } from 'express';

/**
 * Após o JWT global: permite só sessão suporte com login local `implantacao` ou `suporte`
 * (parte antes de @ do e-mail no token).
 */
@Injectable()
export class GuardImplantacaoJwt implements CanActivate {
  canActivate(context: ExecutionContext): boolean {
    const req = context.switchToHttp().getRequest<Request>();
    const user = req['user'] as
      | { suporte?: boolean; email?: string }
      | undefined;

    if (!user?.suporte) {
      throw new ForbiddenException('Acesso restrito à implantação.');
    }

    const email = user.email?.trim().toLowerCase() ?? '';
    const local = email.split('@')[0]?.trim() ?? '';
    if (local !== 'implantacao' && local !== 'suporte') {
      throw new ForbiddenException(
        'Acesso restrito aos usuários implantacao e suporte.',
      );
    }

    return true;
  }
}
