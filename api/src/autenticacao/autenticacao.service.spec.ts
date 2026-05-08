import { BadRequestException, UnauthorizedException } from '@nestjs/common';
import { JwtService } from '@nestjs/jwt';
import { ConfigService } from '@nestjs/config';
import * as bcrypt from 'bcrypt';

import { ServicoAutenticacao } from './autenticacao.service';
import { ServicoCaptchaLogin } from './captcha-login.service';
import { GeradorSenhaDoDia } from './gerador-senha-dia.service';
import { PrismaService } from '../prisma/prisma.service';
import { loginReservadoParaUsuarioPorTenant } from '../comum/logins-usuario-reservados';

// Silencia logs NestJS
jest.mock('@nestjs/common', () => {
  const actual =
    jest.requireActual<typeof import('@nestjs/common')>('@nestjs/common');
  return {
    ...actual,
    Logger: jest.fn().mockImplementation(() => ({
      warn: jest.fn(),
      log: jest.fn(),
      error: jest.fn(),
    })),
  };
});

jest.mock('../comum/logins-usuario-reservados');

const mockLoginReservado =
  loginReservadoParaUsuarioPorTenant as jest.MockedFunction<
    typeof loginReservadoParaUsuarioPorTenant
  >;

function makeService() {
  const prisma = {
    $transaction: jest.fn(),
    $queryRaw: jest.fn(),
    infotime_tenacidade: { findFirst: jest.fn() },
    infotime_usuario: { findFirst: jest.fn(), update: jest.fn() },
    infotime_sessao_usuario: {
      findFirst: jest.fn(),
      create: jest.fn(),
      updateMany: jest.fn(),
    },
    infotime_sessao_suporte: { create: jest.fn(), updateMany: jest.fn() },
  } as unknown as PrismaService;

  const jwt = {
    sign: jest.fn().mockReturnValue('token_ficticio'),
  } as unknown as JwtService;

  const geradorSenha = {
    validarSenhaDoDia: jest.fn().mockReturnValue(true),
  } as unknown as GeradorSenhaDoDia;

  const config = {
    get: jest.fn().mockReturnValue('secret_test'),
  } as unknown as ConfigService;

  const captchaLogin = {
    deveExigirCaptcha: jest.fn().mockReturnValue(false),
    validarDesafio: jest.fn().mockReturnValue(true),
    obterOuCriarDesafio: jest.fn().mockReturnValue({
      id: 'captcha-id',
      pergunta: '1 + 1',
    }),
    registrarSucesso: jest.fn(),
    registrarFalha: jest.fn(),
  } as unknown as ServicoCaptchaLogin;
  const service = new ServicoAutenticacao(prisma, jwt, geradorSenha, config, captchaLogin);
  return { service, prisma, jwt, geradorSenha, config };
}

// ─── hashPassword / comparePassword ────────────────────────────────────────

describe('ServicoAutenticacao — hashPassword', () => {
  it('retorna hash bcrypt diferente da senha original', async () => {
    const { service } = makeService();
    const hash = await service.hashPassword('minha-senha');
    expect(hash).not.toBe('minha-senha');
    expect(hash).toMatch(/^\$2[aby]\$/);
  });

  it('dois hashes da mesma senha são diferentes (salt aleatório)', async () => {
    const { service } = makeService();
    const h1 = await service.hashPassword('igual');
    const h2 = await service.hashPassword('igual');
    expect(h1).not.toBe(h2);
  });
});

describe('ServicoAutenticacao — comparePassword', () => {
  it('retorna true para senha correta', async () => {
    const { service } = makeService();
    const hash = await bcrypt.hash('correta', 10);
    expect(await service.comparePassword('correta', hash)).toBe(true);
  });

  it('retorna false para senha errada', async () => {
    const { service } = makeService();
    const hash = await bcrypt.hash('correta', 10);
    expect(await service.comparePassword('errada', hash)).toBe(false);
  });

  it('retorna false para hash vazio', async () => {
    const { service } = makeService();
    expect(await service.comparePassword('qualquer', '')).toBe(false);
  });
});

// ─── login — roteamento suporte vs normal ───────────────────────────────────

describe('ServicoAutenticacao — login (roteamento)', () => {
  const reqMock = {
    headers: {},
    ip: '127.0.0.1',
  } as never;

  it('lança BadRequestException quando domínio está ausente', async () => {
    const { service } = makeService();
    mockLoginReservado.mockReturnValue(false);

    await expect(
      service.login({ email: 'sem-arroba', senha: '123' }, reqMock),
    ).rejects.toBeInstanceOf(BadRequestException);
  });

  it('lança UnauthorizedException quando domínio não tem tenant ativo', async () => {
    const { service, prisma } = makeService();
    mockLoginReservado.mockReturnValue(false);

    (prisma.$queryRaw as jest.Mock).mockRejectedValue(
      new UnauthorizedException('Tenant não encontrado'),
    );

    await expect(
      service.login(
        { email: 'user@dominio-invalido.com', senha: '123' },
        reqMock,
      ),
    ).rejects.toBeInstanceOf(UnauthorizedException);
  });
});

// ─── logout ─────────────────────────────────────────────────────────────────

describe('ServicoAutenticacao — logout', () => {
  it('chama updateMany em sessao_usuario para usuário normal', async () => {
    const { service, prisma } = makeService();
    (prisma.infotime_sessao_usuario.updateMany as jest.Mock).mockResolvedValue({
      count: 1,
    });

    await service.logout('jti-123', false);

    expect(prisma.infotime_sessao_usuario.updateMany).toHaveBeenCalledWith(
      expect.objectContaining({ where: { token_id: 'jti-123' } }),
    );
    expect(prisma.infotime_sessao_suporte.updateMany).not.toHaveBeenCalled();
  });

  it('chama updateMany em sessao_suporte para usuário suporte', async () => {
    const { service, prisma } = makeService();
    (prisma.infotime_sessao_suporte.updateMany as jest.Mock).mockResolvedValue({
      count: 1,
    });

    await service.logout('jti-456', true);

    expect(prisma.infotime_sessao_suporte.updateMany).toHaveBeenCalledWith(
      expect.objectContaining({ where: { token_id: 'jti-456' } }),
    );
    expect(prisma.infotime_sessao_usuario.updateMany).not.toHaveBeenCalled();
  });
});

// ─── registrarAcessoSuporte ──────────────────────────────────────────────────

describe('ServicoAutenticacao — registrarAcessoSuporte', () => {
  it('chama updateMany com jti e dados corretos', async () => {
    const { service, prisma } = makeService();
    (prisma.infotime_sessao_suporte.updateMany as jest.Mock).mockResolvedValue({
      count: 1,
    });

    await service.registrarAcessoSuporte('jti-789', {
      numero_chamado: 'INC-001',
      motivo_acesso: 'Suporte técnico',
    });

    expect(prisma.infotime_sessao_suporte.updateMany).toHaveBeenCalledWith({
      where: { token_id: 'jti-789' },
      data: { numero_chamado: 'INC-001', motivo_acesso: 'Suporte técnico' },
    });
  });

  it('aceita numero_chamado e motivo_acesso nulos', async () => {
    const { service, prisma } = makeService();
    (prisma.infotime_sessao_suporte.updateMany as jest.Mock).mockResolvedValue({
      count: 1,
    });

    await service.registrarAcessoSuporte('jti-000', {});

    expect(prisma.infotime_sessao_suporte.updateMany).toHaveBeenCalledWith({
      where: { token_id: 'jti-000' },
      data: { numero_chamado: null, motivo_acesso: null },
    });
  });
});
