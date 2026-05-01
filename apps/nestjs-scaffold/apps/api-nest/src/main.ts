import 'reflect-metadata';
import { NestFactory } from '@nestjs/core';
import {
  FastifyAdapter,
  NestFastifyApplication,
} from '@nestjs/platform-fastify';
import { FastifyInstance } from 'fastify';
import { AppModule } from './app.module';
import { HttpExceptionFilter } from '@shared/filters/http-exception.filter';
import { ZodValidationPipe } from '@shared/pipes/zod-validation.pipe';
import { AuditInterceptor } from '@shared/interceptors/audit.interceptor';

async function bootstrap() {
  const adapter = new FastifyAdapter({
    logger: process.env.NODE_ENV !== 'production'
      ? { level: 'info' }
      : false,
    trustProxy: true,
  });

  const app = await NestFactory.create<NestFastifyApplication>(
    AppModule,
    adapter,
  );

  const fastify = app.getHttpAdapter().getInstance() as FastifyInstance;

  // ── Plugins Fastify ─────────────────────────────────────────────────────
  await fastify.register(require('@fastify/compress'));
  await fastify.register(require('@fastify/helmet'), {
    contentSecurityPolicy: false,
  });

  // ── CORS ────────────────────────────────────────────────────────────────
  app.enableCors({
    origin: process.env.CORS_ORIGINS?.split(',') ?? ['http://localhost:5173'],
    credentials: true,
  });

  // ── Global pipes, filters, interceptors ─────────────────────────────────
  app.useGlobalPipes(new ZodValidationPipe());
  app.useGlobalFilters(new HttpExceptionFilter());
  app.useGlobalInterceptors(new AuditInterceptor());

  // ── API prefix ───────────────────────────────────────────────────────────
  app.setGlobalPrefix('api/v1');

  // ── Graceful shutdown ────────────────────────────────────────────────────
  app.enableShutdownHooks();

  const port = Number(process.env.API_PORT ?? 3333);
  const host = process.env.API_HOST ?? '0.0.0.0';

  await app.listen(port, host);
  console.log(`[API] NestJS + Fastify rodando em http://${host}:${port}/api/v1`);
}

bootstrap().catch((err) => {
  console.error('[FATAL] Falha ao iniciar a API', err);
  process.exit(1);
});
