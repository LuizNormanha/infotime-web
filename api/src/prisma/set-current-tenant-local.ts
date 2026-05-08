import type { Prisma } from '@prisma/client';

/**
 * Define o tenant atual na transação Postgres (`app.current_tenant_id`).
 * Usa set_config(..., true) = escopo local à transação (seguro com pool do Prisma).
 *
 * Operacional: o usuário em DATABASE_URL deve estar sujeito à RLS nas tabelas que a usam
 * (não superuser; com FORCE ROW LEVEL SECURITY, o dono também é filtrado).
 */
export async function setCurrentTenantLocal(
  tx: Prisma.TransactionClient,
  idTenacidade: bigint,
): Promise<void> {
  const tenantStr = idTenacidade.toString();
  if (!/^\d+$/.test(tenantStr)) {
    throw new Error('id_tenacidade inválido para RLS.');
  }
  /* Valor só dígitos — seguro embutir; evita ambiguidade de binding em $executeRawUnsafe. */
  await tx.$executeRawUnsafe(
    `SELECT set_config('app.current_tenant_id', '${tenantStr}', true)`,
  );
}
