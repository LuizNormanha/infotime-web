import { randomBytes } from 'crypto';

/**
 * Segredo por tenant (campo `chave_jwt` da configuração canônica do tenant).
 * 64 caracteres hexadecimais; cabe em `VarChar(255)`.
 */
export function gerarChaveJwtTenant(): string {
  return randomBytes(32).toString('hex');
}
