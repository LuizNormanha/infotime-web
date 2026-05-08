// [APRESENTAÇÃO] Contexto de tenant no frontend — apenas para tipagem de estado local.
export type TenantContextoFrontend = {
  idTenacidade: string; // string no frontend (BigInt serializado)
  idUsuario: string;
};
