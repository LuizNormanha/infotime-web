import { ForbiddenException } from '@nestjs/common';
import { describe, it, expect } from 'vitest';
import { TenantGuard } from './tenant.guard';

function mockCtx(user: { tenantId: string; role: string } | null, params?: Record<string, string>) {
  return {
    switchToHttp: () => ({
      getRequest: () => ({
        user,
        params: params ?? {},
      }),
    }),
  };
}

describe('TenantGuard', () => {
  const guard = new TenantGuard();

  it('permite quando não há tenantId na rota', () => {
    expect(guard.canActivate(mockCtx({ tenantId: '1', role: 'colaborador' }) as never)).toBe(true);
  });

  it('permite admin mesmo com tenant da rota diferente', () => {
    expect(
      guard.canActivate(
        mockCtx({ tenantId: '1', role: 'admin' }, { tenantId: '2' }) as never,
      ),
    ).toBe(true);
  });

  it('permite colaborador quando tenant da rota coincide', () => {
    expect(
      guard.canActivate(
        mockCtx({ tenantId: '5', role: 'colaborador' }, { tenantId: '5' }) as never,
      ),
    ).toBe(true);
  });

  it('bloqueia colaborador quando tenant da rota diverge', () => {
    expect(() =>
      guard.canActivate(
        mockCtx({ tenantId: '1', role: 'colaborador' }, { tenantId: '9' }) as never,
      ),
    ).toThrow(ForbiddenException);
  });

  it('bloqueia quando não autenticado e rota exige tenant id', () => {
    expect(() => guard.canActivate(mockCtx(null, { tenantId: '1' }) as never)).toThrow(
      ForbiddenException,
    );
  });
});
