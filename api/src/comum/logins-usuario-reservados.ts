/**
 * Logins reservados para usuários técnicos globais (id_tenacidade NULL).
 * Não podem ser usados em cadastro de usuário por tenant.
 */
export const LOGINS_USUARIO_GLOBAL_RESERVADOS = [
  'suporte',
  'implantacao',
] as const;

export type LoginUsuarioGlobalReservado =
  (typeof LOGINS_USUARIO_GLOBAL_RESERVADOS)[number];

/** Normaliza e verifica se o login colide com os globais (uso em CRUD por tenant). */
export function loginReservadoParaUsuarioPorTenant(
  login: string | null | undefined,
): boolean {
  if (login == null || login === '') return false;
  const n = login.trim().toLowerCase();
  return (LOGINS_USUARIO_GLOBAL_RESERVADOS as readonly string[]).includes(n);
}
