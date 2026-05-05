import { JwtService } from '@nestjs/jwt';
import { ConfigService } from '@nestjs/config';
import { UnauthorizedException } from '@nestjs/common';
import { createHash } from 'node:crypto';
import { describe, it, expect, vi, beforeEach } from 'vitest';
import { AuthService } from './auth.service';
import type { PrismaService } from '../../shared/prisma/prisma.service';

describe('AuthService', () => {
  let service: AuthService;

  const prisma = {
    $queryRaw: vi.fn(),
    usuario: {
      update: vi.fn(),
    },
  };

  const jwt = {
    signAsync: vi.fn().mockResolvedValue('signed-token'),
  };

  const config = {
    get: vi.fn((key: string) => {
      const map: Record<string, string> = {
        JWT_SECRET: 'test-secret-test-secret-test-secret',
        JWT_REFRESH_SECRET: 'test-refresh-test-refresh-test',
        JWT_EXPIRES_IN: '15m',
        JWT_REFRESH_EXPIRES_IN: '7d',
      };
      return map[key];
    }),
  };

  beforeEach(() => {
    vi.clearAllMocks();
    service = new AuthService(
      prisma as unknown as PrismaService,
      jwt as unknown as JwtService,
      config as unknown as ConfigService,
    );
  });

  it('login rejeita quando usuário não existe', async () => {
    prisma.$queryRaw.mockResolvedValue([]);
    await expect(service.login({ login: 'nada', senha: 'x', tenantId: 1 })).rejects.toBeInstanceOf(
      UnauthorizedException,
    );
  });

  it('login rejeita senha MD5 incorreta', async () => {
    prisma.$queryRaw.mockResolvedValue([
      {
        id_usuario: 1n,
        nome: 'A',
        email: 'a@a.com',
        senha: createHash('md5').update('certa').digest('hex'),
        administrador: 'nao',
        id_tenacidade: 1n,
        ativo: 'sim',
      },
    ]);
    await expect(service.login({ login: 'u', senha: 'errada', tenantId: 1 })).rejects.toBeInstanceOf(
      UnauthorizedException,
    );
  });

  it('login aceita senha MD5 legada e devolve tokens', async () => {
    prisma.$queryRaw.mockResolvedValue([
      {
        id_usuario: 10n,
        nome: 'Admin',
        email: 'a@a.com',
        senha: createHash('md5').update('segredo').digest('hex'),
        administrador: 'sim',
        id_tenacidade: 2n,
        ativo: 'sim',
      },
    ]);
    prisma.usuario.update.mockResolvedValue({});

    const res = await service.login({ login: 'adm', senha: 'segredo', tenantId: 2 });

    expect(res.accessToken).toBe('signed-token');
    expect(res.refreshToken).toBe('signed-token');
    expect(jwt.signAsync).toHaveBeenCalled();
    expect(prisma.usuario.update).toHaveBeenCalled();
  });

  it('login conclui com tokens se o update do hash falhar com P2000 (coluna curta)', async () => {
    prisma.$queryRaw.mockResolvedValue([
      {
        id_usuario: 10n,
        nome: 'Admin',
        email: 'a@a.com',
        senha: createHash('md5').update('segredo').digest('hex'),
        administrador: 'sim',
        id_tenacidade: 2n,
        ativo: 'sim',
      },
    ]);
    prisma.usuario.update.mockRejectedValue(Object.assign(new Error('too long'), { code: 'P2000' }));

    const res = await service.login({ login: 'adm', senha: 'segredo', tenantId: 2 });

    expect(res.accessToken).toBe('signed-token');
    expect(res.refreshToken).toBe('signed-token');
    expect(jwt.signAsync).toHaveBeenCalled();
  });

});
