export interface PayloadJwtNormal {
  sub: string; // id_usuario serializado como string (BigInt → string)
  tenantId: string; // id_tenacidade serializado como string
  jti: string; // UUID v4
  email: string; // e-mail do usuário
  iat?: number;
  exp?: number;
}

export interface PayloadJwtSuporte extends PayloadJwtNormal {
  suporte: true;
}

export type PayloadJwt = PayloadJwtNormal | PayloadJwtSuporte;
