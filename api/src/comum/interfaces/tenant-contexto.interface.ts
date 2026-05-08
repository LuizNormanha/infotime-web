// [SEGURANÇA] Contexto de tenant extraído do JWT pelo guard.
// Passado para todos os services que operam em tabelas com id_tenacidade.
export interface TenantContexto {
  idTenacidade: bigint;
  idUsuario: bigint;
  isSuporte: boolean;
}
