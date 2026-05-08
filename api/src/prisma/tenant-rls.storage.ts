import { AsyncLocalStorage } from 'node:async_hooks';

/** Contexto por requisição para `set_config('app.current_tenant_id', ...)` (RLS nas demais tabelas). */
export type TenantRlsContext = {
  tenantId: bigint;
};

/**
 * Definido pelo `tenantRlsMiddleware` a partir do JWT quando houver `tenantId`.
 * `undefined` evita SET do GUC na extensão Prisma (ex.: login sem cookie de tenant no ALS).
 */
export const tenantRlsStorage = new AsyncLocalStorage<
  TenantRlsContext | undefined
>();

/**
 * Dentro de `prisma.$transaction`, após `setCurrentTenantLocal`, o client `tx` ainda passa pela
 * extensão `$allOperations` (Prisma 6+). Sem este flag, cada `tx.*` abriria outra transação só
 * para o SET — aninhamento e custo desnecessários. Ver `createExtendedPrismaClient` em prisma.service.ts.
 */
const tenantRlsJaNaTransacaoInterativa = new AsyncLocalStorage<boolean>();

/**
 * Marca o async scope atual como “GUC já aplicado na transação interativa em curso”.
 * Usar imediatamente após `setCurrentTenantLocal` dentro de `$transaction` em rotas **com** JWT
 * (ALS com tenant); não é necessário no login (`tenantRlsStorage` vazio).
 */
export function executarComRlsJaAplicadoNaTransacao<T>(
  fn: () => Promise<T>,
): Promise<T> {
  return tenantRlsJaNaTransacaoInterativa.run(true, fn);
}

export function rlsJaAplicadoNaTransacaoInterativa(): boolean {
  return tenantRlsJaNaTransacaoInterativa.getStore() === true;
}
