import 'reflect-metadata';
import compress from '@fastify/compress';
import helmet from '@fastify/helmet';
import { ConfigService } from '@nestjs/config';
import { NestFactory } from '@nestjs/core';
import { FastifyAdapter, NestFastifyApplication } from '@nestjs/platform-fastify';
import { AppModule } from './app.module';
import { HttpExceptionFilter } from './shared/filters/http-exception.filter';
import { ZodValidationPipe } from './shared/pipes/zod-validation.pipe';
import { AuditInterceptor } from './shared/interceptors/audit.interceptor';

async function bootstrap() {
  const adapter = new FastifyAdapter({ logger: true, trustProxy: true });
  const app = await NestFactory.create<NestFastifyApplication>(AppModule, adapter);

  const fastify = app.getHttpAdapter().getInstance();
  // Tipagem diverge entre cópias do Fastify no monorepo; runtime OK.
  await fastify.register(compress as unknown as Parameters<typeof fastify.register>[0]);
  await fastify.register(helmet as unknown as Parameters<typeof fastify.register>[0], {
    contentSecurityPolicy: false,
  });

  const corsOrigins = process.env.CORS_ORIGINS?.split(',')
    .map((o) => o.trim())
    .filter(Boolean);
  app.enableCors({
    origin: corsOrigins?.length ? corsOrigins : ['http://localhost:5173', 'http://localhost:5174'],
    credentials: true,
  });

  app.useGlobalPipes(new ZodValidationPipe());
  app.useGlobalFilters(new HttpExceptionFilter());
  app.useGlobalInterceptors(new AuditInterceptor());
  app.setGlobalPrefix('api/v1');
  app.enableShutdownHooks();

  const config = app.get(ConfigService);
  const port = config.get<number>('API_PORT', 3333);
  const host = config.get<string>('API_HOST', '0.0.0.0');
  await app.listen(port, host);
  console.log(`[API] NestJS + Fastify em http://localhost:${port}/api/v1 (listen ${host}:${port})`);
}
bootstrap().catch((err) => {
  console.error(err);
  process.exit(1);
});
