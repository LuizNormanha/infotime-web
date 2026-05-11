import { resolverEscopoRlsTenant } from './tenant-rls-resolver';

describe('resolverEscopoRlsTenant', () => {
  it('retorna null sem tenantId', () => {
    expect(resolverEscopoRlsTenant({ sub: '1' })).toBeNull();
  });

  it('retorna tenantId quando presente', () => {
    expect(resolverEscopoRlsTenant({ tenantId: '7' })).toEqual({
      tenantId: BigInt(7),
    });
  });

  it('retorna null quando tenantId não é numérico', () => {
    expect(resolverEscopoRlsTenant({ tenantId: 'nao-e-numero' })).toBeNull();
  });
});
