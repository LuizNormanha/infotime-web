import { ValidationPipe } from '@nestjs/common';
import type { INestApplication } from '@nestjs/common';
import { Test, TestingModule } from '@nestjs/testing';
import type { ValidationError } from 'class-validator';
import { createHmac } from 'crypto';
import type { Application } from 'express';
import cookieParser from 'cookie-parser';
import request from 'supertest';
import { App } from 'supertest/types';

import { AppModule } from '../src/app.module';
import { criarBadRequestValidacao } from '../src/comum/validacao-exception-factory';
import { dataReferenciaSenhaDoDia } from '../src/autenticacao/gerador-senha-dia.service';
import { PrismaService } from '../src/prisma/prisma.service';
import { tenantRlsMiddleware } from '../src/prisma/tenant-rls.middleware';

/** Mesmo algoritmo que `GeradorSenhaDoDia` (data no fuso SENHA_DO_DIA_TIMEZONE + HMAC-SHA256). */
function gerarSenhaDoDiaEsperadaE2e(): string {
  const chave = process.env.SUPORTE_SECRET_KEY;
  if (!chave) {
    throw new Error('SUPORTE_SECRET_KEY ausente (carregue api/.env antes dos e2e).');
  }
  const tz = process.env.SENHA_DO_DIA_TIMEZONE ?? 'America/Sao_Paulo';
  const dataStr = dataReferenciaSenhaDoDia(new Date(), tz);
  return createHmac('sha256', chave).update(dataStr).digest('hex').slice(0, 8);
}

function normalizarSetCookie(
  raw: string | string[] | undefined,
): string[] | undefined {
  if (raw == null) return undefined;
  return Array.isArray(raw) ? raw : [raw];
}

function extrairAccessTokenDosCookies(setCookie: string[] | undefined): string {
  expect(setCookie).toBeDefined();
  const linha = setCookie!.find((c) => c.startsWith('access_token='));
  expect(linha).toBeDefined();
  const valor = linha!.split(';')[0]!.replace(/^access_token=/, '');
  expect(valor.length).toBeGreaterThan(10);
  return valor;
}

async function criarAppE2e(): Promise<INestApplication<App>> {
  Object.defineProperty(BigInt.prototype, 'toJSON', {
    value(this: bigint) {
      return this.toString();
    },
    configurable: true,
  });

  const moduleFixture: TestingModule = await Test.createTestingModule({
    imports: [AppModule],
  }).compile();

  const app = moduleFixture.createNestApplication();
  (app.getHttpAdapter().getInstance() as Application).set('trust proxy', true);

  app.use(cookieParser());
  app.use(tenantRlsMiddleware);
  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      transform: true,
      transformOptions: { enableImplicitConversion: true },
      exceptionFactory: (errors: ValidationError[]) =>
        criarBadRequestValidacao(errors),
    }),
  );

  const prisma = app.get(PrismaService);
  prisma.enableShutdownHooks(app);

  await app.init();
  return app;
}

const temBancoEChave =
  Boolean(process.env.DATABASE_URL) && Boolean(process.env.SUPORTE_SECRET_KEY);

const descrever = temBancoEChave ? describe : describe.skip;

descrever('Implantação: login implantacao + senha do dia e cadastro de tenacidade (e2e)', () => {
  let app: INestApplication<App>;

  beforeAll(async () => {
    app = await criarAppE2e();
  });

  afterAll(async () => {
    await app.close();
  });

  it('POST /auth/login (implantacao@liga.br) e POST /implantacao-tenacidades com dominio teste.br', async () => {
    const server = app.getHttpServer();
    const senha = gerarSenhaDoDiaEsperadaE2e();

    const login = await request(server)
      .post('/auth/login')
      .send({
        email: 'implantacao@liga.br',
        senha,
      })
      .expect(200);

    expect(login.body).toHaveProperty('redirect', '/suporte/acesso');
    const token = extrairAccessTokenDosCookies(
      normalizarSetCookie(login.headers['set-cookie']),
    );

    const corpo = {
      ativo: 'S',
      configuracao: {
        razao_social: 'Tenacidade E2E teste.br',
        nome_fantasia: 'Teste BR',
        dominio_tenacidade: 'teste.br',
        data_expiracao: '2030-12-31',
        quantidade_licenca: 5,
      },
    };

    const criar = await request(server)
      .post('/implantacao-tenacidades')
      .set('Authorization', `Bearer ${token}`)
      .send(corpo);

    if (criar.status === 409) {
      // Domínio já cadastrado — fluxo autenticado chegou ao serviço.
      expect(String(criar.text + JSON.stringify(criar.body))).toMatch(
        /cadastrado|unique|P2002|Conflict/i,
      );
      return;
    }

    expect(criar.status).toBe(201);
    expect(criar.body).toMatchObject({
      id: expect.stringMatching(/^\d+$/),
    });
  });
});
