/**
 * Recursos expostos pelo BFF catch-all. Qualquer path fora desta lista recebe 403.
 * Mantido fora de `route.ts` para satisfazer o typecheck do Next.js (só exports de rota no handler).
 */
export const RECURSOS_PERMITIDOS = new Set([
  "auth",
  "clientes",
  "grupos-perfil",
  "usuario-permissoes",
  "usuarios",
]);
