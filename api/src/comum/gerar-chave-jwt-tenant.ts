import { randomBytes } from 'crypto';

/**
 * Segredo por tenant (`infolab_tenacidade_configuracao.chave_jwt`, linha canônica do laboratório).
 * 64 caracteres hexadecimais; cabe em `VarChar(255)`.
 */
export function gerarChaveJwtTenant(): string {
  return randomBytes(32).toString('hex');
}
