import { Global, Module } from '@nestjs/common';
import { ConfigModule } from '@nestjs/config';
import { z } from 'zod';
import { resolveMonorepoEnvPaths } from './resolve-env-paths';

const EnvSchema = z.object({
  NODE_ENV: z.enum(['development', 'production', 'test']).default('development'),
  API_HOST: z.string().default('0.0.0.0'),
  API_PORT: z.coerce.number().default(3333),
  DATABASE_URL: z.string().min(1),
  JWT_SECRET: z.string().min(16),
  JWT_EXPIRES_IN: z.string().default('15m'),
  JWT_REFRESH_SECRET: z.string().min(16),
  JWT_REFRESH_EXPIRES_IN: z.string().default('7d'),
  CORS_ORIGINS: z.string().optional(),
  REDIS_URL: z.string().default('redis://localhost:6379'),
});

function validateEnv(config: Record<string, unknown>) {
  const result = EnvSchema.safeParse(config);
  if (!result.success) {
    console.error('[ENV] Variáveis inválidas:', result.error.issues);
    throw new Error('Configuração de ambiente inválida');
  }
  return result.data;
}

@Global()
@Module({
  imports: [
    ConfigModule.forRoot({
      isGlobal: true,
      validate: validateEnv,
      envFilePath: resolveMonorepoEnvPaths(),
      cache: true,
    }),
  ],
})
export class AppConfigModule {}
