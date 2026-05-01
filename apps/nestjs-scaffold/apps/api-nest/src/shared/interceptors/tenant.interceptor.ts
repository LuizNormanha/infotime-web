import {
  CallHandler,
  ExecutionContext,
  Injectable,
  NestInterceptor,
  UnauthorizedException,
} from '@nestjs/common';
import { ClsService } from 'nestjs-cls';
import { Observable } from 'rxjs';
import { JwtPayload } from '@modules/auth/strategies/jwt.strategy';

/**
 * TenantInterceptor — extrai tenantId e userId do JWT já validado pelo JwtAuthGuard
 * e os armazena no ClsService (AsyncLocalStorage).
 *
 * A partir daqui, qualquer serviço pode chamar:
 *   this.cls.get<number>('tenantId')
 *   this.cls.get<number>('userId')
 *
 * sem precisar receber como parâmetro.
 */
@Injectable()
export class TenantInterceptor implements NestInterceptor {
  constructor(private readonly cls: ClsService) {}

  intercept(context: ExecutionContext, next: CallHandler): Observable<unknown> {
    const req = context.switchToHttp().getRequest();

    // req.user é preenchido pelo JwtAuthGuard (passport)
    const user = req.user as JwtPayload | undefined;

    if (user) {
      this.cls.set('userId', user.sub);
      this.cls.set('tenantId', user.tenantId);
      this.cls.set('role', user.role);
    }

    return next.handle();
  }
}
