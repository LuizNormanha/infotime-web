import { montarJobIdDeterministico } from './job-idempotencia';

describe('montarJobIdDeterministico', () => {
  it('concatena segmentos com dois pontos e sanitiza dois pontos nos segmentos', () => {
    expect(montarJobIdDeterministico(['regua', 'tenant', 10])).toBe(
      'regua:tenant:10',
    );
    expect(montarJobIdDeterministico(['a:b', 1])).toBe('a_b:1');
  });
});
