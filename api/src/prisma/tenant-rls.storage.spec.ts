import {
  executarComRlsJaAplicadoNaTransacao,
  rlsJaAplicadoNaTransacaoInterativa,
} from './tenant-rls.storage';

describe('tenantRlsManualInteractiveTx', () => {
  it('rlsJaAplicadoNaTransacaoInterativa é false fora do escopo', () => {
    expect(rlsJaAplicadoNaTransacaoInterativa()).toBe(false);
  });

  it('executarComRlsJaAplicadoNaTransacao ativa o flag durante a Promise', async () => {
    await executarComRlsJaAplicadoNaTransacao(async () => {
      expect(rlsJaAplicadoNaTransacaoInterativa()).toBe(true);
      return 1;
    });
    expect(rlsJaAplicadoNaTransacaoInterativa()).toBe(false);
  });
});
