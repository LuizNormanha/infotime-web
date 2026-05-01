import {
  CallHandler,
  ExecutionContext,
  Injectable,
  Logger,
  NestInterceptor,
} from '@nestjs/common';
import { ClsService } from 'nestjs-cls';
import { Observable, tap } from 'rxjs';

/**
 * AuditInterceptor — registra automaticamente toda mutação (POST/PUT/PATCH/DELETE)
 * com usuário, tenant, IP, método e duração.
 *
 * Persiste via AuditService (injetado futuramente). Por ora, loga.
 * Para persistir: injete PrismaService e crie AuditLog no Prisma.
 */
@Injectable()
export class AuditInterceptor implements NestInterceptor {
  private readonly logger = new Logger('Audit');

  constructor(private readonly cls?: ClsService) {}

  intercept(context: ExecutionContext, next: CallHandler): Observable<unknown> {
    const req = context.switchToHttp().getRequest();
    const method: string = req.method ?? '';
    const isMutation = ['POST', 'PUT', 'PATCH', 'DELETE'].includes(method);

    if (!isMutation) return next.handle();

    const start = Date.now();
    const userId = this.cls?.get<number>('userId');
    const tenantId = this.cls?.get<number>('tenantId');
    const ip: string = req.ip ?? req.headers?.['x-forwarded-for'] ?? 'unknown';
    const url: string = req.url ?? '';

    return next.handle().pipe(
      tap({
        next: () => {
          const ms = Date.now() - start;
          this.logger.log(
            `[${method}] ${url} | user=${userId ?? 'anon'} tenant=${tenantId ?? '-'} ip=${ip} ${ms}ms`,
          );
          // TODO: persistir no banco quando AuditModule estiver implementado
          // await this.prisma.auditLog.create({ data: { userId, tenantId, method, url, ip, durationMs: ms } });
        },
        error: (err) => {
          const ms = Date.now() - start;
          this.logger.warn(
            `[${method}] ${url} ERRO ${err?.status ?? 500} | user=${userId ?? 'anon'} ${ms}ms`,
          );
        },
      }),
    );
  }
}
