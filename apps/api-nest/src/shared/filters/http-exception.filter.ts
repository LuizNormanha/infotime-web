import { ArgumentsHost, Catch, ExceptionFilter, HttpException, HttpStatus, Logger } from '@nestjs/common';

function prismaKnownCode(e: unknown): string | null {
  if (typeof e !== 'object' || e === null || !('code' in e)) return null;
  const c = (e as { code: unknown }).code;
  return typeof c === 'string' && /^P[0-9]+$/.test(c) ? c : null;
}

function mapPrismaKnown(code: string): { status: number; message: string; error: string } {
  switch (code) {
    case 'P2002':
      return {
        status: HttpStatus.CONFLICT,
        message: 'Registo duplicado (restrição única na base de dados).',
        error: 'Conflict',
      };
    case 'P2025':
      return {
        status: HttpStatus.NOT_FOUND,
        message: 'Registo não encontrado.',
        error: 'Not Found',
      };
    case 'P2021':
      return {
        status: HttpStatus.INTERNAL_SERVER_ERROR,
        message:
          'Tabela ou vista em falta no PostgreSQL. Confirme DATABASE_URL: base `liga_infotime`, `?schema=public`. Depois: `pnpm db:push` na raiz.',
        error: 'Database Schema',
      };
    case 'P1001':
      return {
        status: HttpStatus.SERVICE_UNAVAILABLE,
        message: 'Não foi possível contactar o servidor PostgreSQL. Verifique se o serviço está a correr e a DATABASE_URL.',
        error: 'Service Unavailable',
      };
    default:
      return {
        status: HttpStatus.INTERNAL_SERVER_ERROR,
        message: `Erro na base de dados (${code}).`,
        error: 'Database Error',
      };
  }
}

@Catch()
export class HttpExceptionFilter implements ExceptionFilter {
  private readonly logger = new Logger(HttpExceptionFilter.name);

  catch(exception: unknown, host: ArgumentsHost) {
    const ctx = host.switchToHttp();
    const reply = ctx.getResponse();
    const request = ctx.getRequest();
    let statusCode = HttpStatus.INTERNAL_SERVER_ERROR;
    let message: string | string[] = 'Erro interno do servidor';
    let error = 'Internal Server Error';
    let details: unknown;

    if (exception instanceof HttpException) {
      statusCode = exception.getStatus();
      const res = exception.getResponse() as Record<string, unknown>;
      message = (res.message as string) ?? exception.message;
      error = (res.error as string) ?? exception.message;
      details = res.details;
    } else {
      const pCode = prismaKnownCode(exception);
      if (pCode) {
        const m = mapPrismaKnown(pCode);
        statusCode = m.status;
        message = m.message;
        error = m.error;
        const msg = exception instanceof Error ? exception.message : String(exception);
        this.logger.warn(`[Prisma ${pCode}] ${request.method} ${request.url} — ${msg}`);
      } else if (exception instanceof Error && exception.name === 'PrismaClientValidationError') {
        statusCode = HttpStatus.BAD_REQUEST;
        message = 'Pedido inválido para a base de dados.';
        error = 'Bad Request';
        this.logger.warn(`[Prisma validation] ${request.method} ${request.url} ${exception.message}`);
      } else {
        this.logger.error(`[${request.method}] ${request.url}`, (exception as Error)?.stack);
      }
    }

    reply.status(statusCode).send({
      statusCode,
      error,
      message,
      ...(details ? { details } : {}),
      timestamp: new Date().toISOString(),
      path: request.url,
    });
  }
}
