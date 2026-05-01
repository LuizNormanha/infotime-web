import { Module } from '@nestjs/common';
import { ClsModule } from 'nestjs-cls';
import { PrismaModule } from '@shared/prisma/prisma.module';
import { AppConfigModule } from '@shared/config/config.module';
import { AuthModule } from '@modules/auth/auth.module';
import { UsersModule } from '@modules/users/users.module';

/**
 * AppModule — raiz do monolito modular infotime-web.
 *
 * Convenções:
 * - Módulos de infraestrutura (Prisma, Config, CLS) são @Global()
 * - Módulos de negócio importam apenas o que precisam
 * - Cada módulo de negócio está em src/modules/<nome>/
 */
@Module({
  imports: [
    // ── Infraestrutura global ───────────────────────────────────────────
    AppConfigModule,   // @Global — acesso ao ConfigService em qualquer módulo
    PrismaModule,      // @Global — PrismaService + middleware de tenant
    ClsModule.forRoot({
      global: true,
      middleware: { mount: true },  // monta o contexto em cada request
    }),

    // ── Módulos de negócio ──────────────────────────────────────────────
    AuthModule,
    UsersModule,

    // TODO: adicionar módulos na ordem de ORDEM_IMPLEMENTACAO_MODULOS.md
    // FinanceModule,
    // ExamsModule,
    // AuditModule,
    // QueuesModule,
    // IntegrationsModule,
    // NotificationsModule,
    // StorageModule,
    // HealthModule,
  ],
})
export class AppModule {}
