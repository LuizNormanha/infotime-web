import { CallHandler, ExecutionContext, Injectable, Logger, NestInterceptor } from '@nestjs/common';
import { Observable, tap } from 'rxjs';

@Injectable()
export class AuditInterceptor implements NestInterceptor {
  private readonly logger = new Logger('Audit');

  intercept(context: ExecutionContext, next: CallHandler): Observable<unknown> {
    const req = context.switchToHttp().getRequest();
    if (!['POST', 'PUT', 'PATCH', 'DELETE'].includes(req.method)) return next.handle();

    const start = Date.now();
    const { method, url, ip } = req;

    return next.handle().pipe(
      tap({
        next: () => this.logger.log(`[${method}] ${url} ${Date.now() - start}ms ip=${ip}`),
        error: (e: { status?: number }) => this.logger.warn(`[${method}] ${url} ERRO ${e?.status ?? 500}`),
      }),
    );
  }
}
