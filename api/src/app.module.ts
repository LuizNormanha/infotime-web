import { join } from 'node:path';

import { Module } from '@nestjs/common';
import { ConfigModule, ConfigService } from '@nestjs/config';
import { APP_GUARD } from '@nestjs/core';
import { ThrottlerModule, ThrottlerGuard } from '@nestjs/throttler';
import { ThrottlerStorageRedisService } from '@nest-lab/throttler-storage-redis';
import Redis from 'ioredis';
import { AppController } from './app.controller';
import { GuardAutenticacaoJwtMultiTenant } from './autenticacao/autenticacao.guard';
import { PrismaModule } from './prisma/prisma.module';
import { ModuloAutenticacao } from './autenticacao/autenticacao.module';
import { CboModule } from './cbo/cbo.module';
import { CidModule } from './cid/cid.module';
import { ClienteModule } from './cliente/cliente.module';
import { ConselhoRegionalModule } from './conselho-regional/conselho-regional.module';
import { EspecialidadeMedicaModule } from './especialidade-medica/especialidade-medica.module';
import { EtniaModule } from './etnia/etnia.module';
import { FeriadoModule } from './feriado/feriado.module';
import { GrupoModule } from './grupo/grupo.module';
import { GrupoPerfilModule } from './grupo-perfil/grupo-perfil.module';
import { IndicacaoModule } from './indicacao/indicacao.module';
import { LayoutModule } from './layout/layout.module';
import { MedicoModule } from './medico/medico.module';
import { MotivoCancelamentoModule } from './motivo-cancelamento/motivo-cancelamento.module';
import { ProcedenciaModule } from './procedencia/procedencia.module';
import { MotivoDescontoModule } from './motivo-desconto/motivo-desconto.module';
import { MotivoRetificacaoModule } from './motivo-retificacao/motivo-retificacao.module';
import { RacaModule } from './raca/raca.module';
import { SetorModule } from './setor/setor.module';
import { TipoAplicacaoModule } from './tipo-aplicacao/tipo-aplicacao.module';
import { TipoEstadoCivilModule } from './tipo-estado-civil/tipo-estado-civil.module';
import { TipoEventoModule } from './tipo-evento/tipo-evento.module';
import { TipoIndicacaoModule } from './tipo-indicacao/tipo-indicacao.module';
import { TipoIntegracaoModule } from './tipo-integracao/tipo-integracao.module';
import { TipoInterfaceModule } from './tipo-interface/tipo-interface.module';
import { TipoPagamentoModule } from './tipo-pagamento/tipo-pagamento.module';
import { TipoRelatorioModule } from './tipo-relatorio/tipo-relatorio.module';
import { UnidadeAtendimentoModule } from './unidade-atendimento/unidade-atendimento.module';
import { UnidadeFederacaoModule } from './unidade-federacao/unidade-federacao.module';
import { DicionarioModule } from './dicionario/dicionario.module';
import { AplicacaoModule } from './aplicacao/aplicacao.module';
import { MedicamentoModule } from './medicamento/medicamento.module';
import { UsuarioModule } from './usuario/usuario.module';
import { UsuarioPermissoesModule } from './usuario-permissoes/usuario-permissoes.module';
import { VetEspecieModule } from './vet-especie/vet-especie.module';
import { VetRacaModule } from './vet-raca/vet-raca.module';
import { ImplantacaoTenacidadeModule } from './implantacao-tenacidade/implantacao-tenacidade.module';
import { TenacidadeModule } from './tenacidade/tenacidade.module';
import { TenacidadeConfiguracaoModule } from './tenacidade-configuracao/tenacidade-configuracao.module';
import { SerieNotaFiscalServicoModule } from './serie-nota-fiscal-servico/serie-nota-fiscal-servico.module';
import { AiModule } from './ai/ai.module';

@Module({
  imports: [
    ConfigModule.forRoot({
      // Repo root (nx / IDE) ou pasta api: sempre encontra `api/.env`.
      envFilePath: [
        join(process.cwd(), 'api', '.env'),
        join(process.cwd(), '.env'),
      ],
      isGlobal: true,
      validate(config: Record<string, unknown>) {
        const obrigatorias = ['DATABASE_URL', 'SUPORTE_SECRET_KEY'];
        const ausentes = obrigatorias.filter((k) => !config[k]);
        if (ausentes.length > 0) {
          throw new Error(
            `Variáveis de ambiente obrigatórias ausentes: ${ausentes.join(', ')}`,
          );
        }
        return config;
      },
    }),
    ThrottlerModule.forRootAsync({
      imports: [ConfigModule],
      inject: [ConfigService],
      useFactory: (config: ConfigService) => {
        const redisUrl = config.get<string>('THROTTLER_REDIS_URL');
        return {
          // Apenas o tier `global` aqui: no v6 do @nestjs/throttler, **todos** os throttlers
          // registrados entram na conta de **cada** rota. O tier `auth` (10/15min) fazia 429
          // ao abrir formulários (várias chamadas à API). Login usa @Throttle({ global: ... }).
          throttlers: [{ name: 'global', ttl: 60_000, limit: 100 }],
          // Em produção multi-instância, defina THROTTLER_REDIS_URL para
          // garantir rate limiting distribuído. Sem ela, usa memória local.
          ...(redisUrl
            ? { storage: new ThrottlerStorageRedisService(new Redis(redisUrl)) }
            : {}),
        };
      },
    }),
    PrismaModule,
    ModuloAutenticacao,
    AplicacaoModule,
    ClienteModule,
    CboModule,
    CidModule,
    ConselhoRegionalModule,
    EspecialidadeMedicaModule,
    EtniaModule,
    FeriadoModule,
    GrupoModule,
    GrupoPerfilModule,
    ImplantacaoTenacidadeModule,
    IndicacaoModule,
    MedicamentoModule,
    MedicoModule,
    MotivoCancelamentoModule,
    MotivoDescontoModule,
    MotivoRetificacaoModule,
    ProcedenciaModule,
    RacaModule,
    SetorModule,
    SerieNotaFiscalServicoModule,
    TenacidadeModule,
    TenacidadeConfiguracaoModule,
    TipoAplicacaoModule,
    TipoEstadoCivilModule,
    TipoEventoModule,
    TipoIndicacaoModule,
    TipoIntegracaoModule,
    TipoInterfaceModule,
    TipoPagamentoModule,
    TipoRelatorioModule,
    UnidadeAtendimentoModule,
    UnidadeFederacaoModule,
    UsuarioModule,
    UsuarioPermissoesModule,
    VetEspecieModule,
    VetRacaModule,
    LayoutModule,
    DicionarioModule,
    AiModule,
  ],
  controllers: [AppController],
  providers: [
    { provide: APP_GUARD, useClass: ThrottlerGuard },
    { provide: APP_GUARD, useClass: GuardAutenticacaoJwtMultiTenant },
  ],
})
export class AppModule {}
