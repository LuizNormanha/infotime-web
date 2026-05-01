import { describe, it, expect } from 'vitest';
import { LoginSchema } from './auth.dto';

describe('LoginSchema', () => {
  it('normaliza idTenacidade string para tenantId', () => {
    const r = LoginSchema.parse({
      login: 'u',
      senha: 'x',
      idTenacidade: '42',
    });
    expect(r.tenantId).toBe(42);
  });

  it('aceita tenantId numérico', () => {
    const r = LoginSchema.parse({ login: 'u', senha: 'x', tenantId: 7 });
    expect(r.tenantId).toBe(7);
  });
});
