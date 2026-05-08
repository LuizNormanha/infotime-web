/**
 * Política de senha para usuários do sistema (mesmas regras que `api/src/comum/senha-usuario-politica.ts`).
 * Ao alterar critérios, atualizar os dois arquivos.
 */
export const SENHA_USUARIO_COMPRIMENTO_MINIMO = 8;
export const SENHA_USUARIO_COMPRIMENTO_MAXIMO = 100;

export function senhaUsuarioAtendePoliticaForte(senha: string): boolean {
  const s = senha.trim();
  if (s.length < SENHA_USUARIO_COMPRIMENTO_MINIMO || s.length > SENHA_USUARIO_COMPRIMENTO_MAXIMO) {
    return false;
  }
  if (!/[a-z]/.test(s)) return false;
  if (!/[A-Z]/.test(s)) return false;
  if (!/\d/.test(s)) return false;
  return true;
}
