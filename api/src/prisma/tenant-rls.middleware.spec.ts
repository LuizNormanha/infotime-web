import type { NextFunction, Request, Response } from 'express';
import * as jwt from 'jsonwebtoken';

import { tenantRlsMiddleware } from './tenant-rls.middleware';
import { tenantRlsStorage } from './tenant-rls.storage';

// Silencia o Logger do NestJS nos testes
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

function mockReq(overrides: Partial<Request> = {}): Request {
  return {
    headers: {},
    cookies: {},
    originalUrl: '/qualquer',
    url: '/qualquer',
    path: '/qualquer',
    ...overrides,
  } as unknown as Request;
}

const mockRes = {} as Response;
const next: NextFunction = jest.fn();

beforeEach(() => {
  jest.clearAllMocks();
});

describe('tenantRlsMiddleware — rotas de login bypassam RLS', () => {
  const rotasLogin = ['/auth/login', '/auth/login-confirm'];

  for (const rota of rotasLogin) {
    it(`chama next() sem escopo para ${rota}`, () => {
      const req = mockReq({ originalUrl: rota });
      tenantRlsMiddleware(req, mockRes, next);
      expect(next).toHaveBeenCalledTimes(1);
      expect(tenantRlsStorage.getStore()).toBeUndefined();
    });
  }

  it('chama next() sem escopo para /api/auth/login-confirm (com prefixo)', () => {
    const req = mockReq({ originalUrl: '/api/auth/login-confirm' });
    tenantRlsMiddleware(req, mockRes, next);
    expect(next).toHaveBeenCalledTimes(1);
  });
});

describe('tenantRlsMiddleware — sem token', () => {
  it('chama next() sem escopo quando não há header nem cookie', () => {
    const req = mockReq({ headers: {}, cookies: {} });
    tenantRlsMiddleware(req, mockRes, next);
    expect(next).toHaveBeenCalledTimes(1);
    expect(tenantRlsStorage.getStore()).toBeUndefined();
  });
});

describe('tenantRlsMiddleware — token com tenantId válido', () => {
  it('executa next() dentro do ALS com tenantId correto via Bearer', (done) => {
    const token = jwt.sign({ tenantId: '42' }, 'qualquer-chave');
    const req = mockReq({
      headers: { authorization: `Bearer ${token}` },
    });

    const verificador: NextFunction = () => {
      expect(tenantRlsStorage.getStore()).toEqual({
        tenantId: BigInt(42),
      });
      done();
    };

    tenantRlsMiddleware(req, mockRes, verificador);
  });

  it('executa next() dentro do ALS com tenantId via cookie', (done) => {
    const token = jwt.sign({ tenantId: '99' }, 'chave');
    const req = mockReq({
      cookies: { access_token: token },
    });

    const verificador: NextFunction = () => {
      expect(tenantRlsStorage.getStore()).toEqual({
        tenantId: BigInt(99),
      });
      done();
    };

    tenantRlsMiddleware(req, mockRes, verificador);
  });
});

describe('tenantRlsMiddleware — token sem tenantId', () => {
  it('chama next() sem escopo quando payload não tem tenantId', () => {
    const token = jwt.sign({ sub: 'usuario-sem-tenant' }, 'chave');
    const req = mockReq({ headers: { authorization: `Bearer ${token}` } });
    tenantRlsMiddleware(req, mockRes, next);
    expect(next).toHaveBeenCalledTimes(1);
    expect(tenantRlsStorage.getStore()).toBeUndefined();
  });

  it('chama next() sem escopo quando tenantId é string vazia', () => {
    const token = jwt.sign({ tenantId: '' }, 'chave');
    const req = mockReq({ headers: { authorization: `Bearer ${token}` } });
    tenantRlsMiddleware(req, mockRes, next);
    expect(next).toHaveBeenCalledTimes(1);
  });
});

describe('tenantRlsMiddleware — token malformado', () => {
  it('chama next() sem lançar exceção para token inválido', () => {
    const req = mockReq({
      headers: { authorization: 'Bearer token.malformado.qualquer' },
    });
    expect(() => tenantRlsMiddleware(req, mockRes, next)).not.toThrow();
    expect(next).toHaveBeenCalledTimes(1);
  });

  it('chama next() sem lançar exceção para tenantId não numérico', () => {
    const token = jwt.sign({ tenantId: 'nao-e-numero' }, 'chave');
    const req = mockReq({ headers: { authorization: `Bearer ${token}` } });
    expect(() => tenantRlsMiddleware(req, mockRes, next)).not.toThrow();
    expect(next).toHaveBeenCalledTimes(1);
  });
});
