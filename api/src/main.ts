import 'tsconfig-paths/register';
import { NestFactory } from '@nestjs/core';
import { ConfigService } from '@nestjs/config';
import { Logger, ValidationPipe } from '@nestjs/common';
import type { ValidationError } from 'class-validator';

import { criarBadRequestValidacao } from './comum/validacao-exception-factory';
import { PrismaExceptionFilter } from './comum/prisma-exception.filter';
import cookieParser from 'cookie-parser';
import helmet from 'helmet';
import type { Application } from 'express';

import { AppModule } from './app.module';
import { PrismaService } from './prisma/prisma.service';
import { tenantRlsMiddleware } from './prisma/tenant-rls.middleware';

// Prisma usa BigInt em colunas numéricas; JSON.stringify falha sem isto (ex.: ids em respostas).
Object.defineProperty(BigInt.prototype, 'toJSON', {
  value(this: bigint) {
    return this.toString();
  },
  configurable: true,
});

async function bootstrap() {
  const app = await NestFactory.create(AppModule);

  // Confia no proxy reverso (Next.js BFF) para ler X-Forwarded-For corretamente
  (app.getHttpAdapter().getInstance() as Application).set('trust proxy', true);

  const config = app.get(ConfigService);
  const port = config.get<number>('API_PORT', 3003);
  /** `localhost` no Windows tende a resolver só para `::1`; `127.0.0.1` alinha com o BFF e evita surpresas de rota. */
  const hostExplicito = config.get<string | undefined>('API_HOST');
  const host =
    hostExplicito?.trim() ||
    (process.env.NODE_ENV === 'production' ? '0.0.0.0' : '127.0.0.1');
  const webUrl = config.get<string>('WEB_URL', 'http://localhost:3004');

  // Cabeçalhos de segurança HTTP (X-Frame-Options, X-Content-Type-Options, HSTS, etc.)
  // contentSecurityPolicy desabilitado: API serve apenas JSON, não HTML.
  app.use(helmet({ contentSecurityPolicy: false }));

  // Cookie HTTP-only para tokens JWT
  app.use(cookieParser());
  app.use(tenantRlsMiddleware);

  // Valida e transforma DTOs automaticamente.
  // `whitelist: true` descarta campos desconhecidos silenciosamente (segurança: o backend
  // nunca usa id_tenacidade nem campos de auditoria vindos do body — esses vêm do JWT).
  // `forbidNonWhitelisted` foi removido porque o front-end envia campos de auditoria no
  // payload (carregados do GET de edição) que o backend descarta pelo whitelist.
  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      transform: true,
      transformOptions: { enableImplicitConversion: true },
      exceptionFactory: (errors: ValidationError[]) =>
        criarBadRequestValidacao(errors),
    }),
  );
  app.useGlobalFilters(new PrismaExceptionFilter());

  // CORS — permite credenciais (cookies) do frontend
  // WEB_URL pode conter múltiplas origens separadas por vírgula
  const origins = webUrl.split(',').map((o) => o.trim());
  app.enableCors({
    origin: origins.length === 1 ? origins[0] : origins,
    credentials: true,
  });

  const prisma = app.get(PrismaService);
  prisma.enableShutdownHooks(app);

  const log = new Logger('Bootstrap');
  try {
    await app.listen(port, host);
    log.log(`API rodando em http://${host}:${port}`);
  } catch (err: unknown) {
    const e = err as NodeJS.ErrnoException;
    if (e?.code === 'EADDRINUSE') {
      log.error(
        `Porta ${String(port)} já está em uso (outra instância Nest ou processo pendurado). ` +
          `Pare o processo anterior ou libere a porta antes de subir de novo. ` +
          `Windows (PowerShell): Get-NetTCPConnection -LocalPort ${String(port)} | Select-Object OwningProcess`,
      );
    } else {
      log.error(e?.message ?? String(err));
    }
    throw err;
  }
}
void bootstrap();
