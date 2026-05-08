/**
 * Política de senha para usuários do sistema (persistida com hash bcrypt).
 * Espelho no frontend: `web/src/lib/senha-usuario-politica.ts` — manter regras alinhadas.
 */
export const SENHA_USUARIO_COMPRIMENTO_MINIMO = 8;
export const SENHA_USUARIO_COMPRIMENTO_MAXIMO = 100;

/** Validação equivalente a `senhaUsuarioAtendePoliticaForte` (lookahead). */
export const SENHA_USUARIO_REGEX_FORTE =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,100}$/;

export function senhaUsuarioAtendePoliticaForte(senha: string): boolean {
  const s = senha.trim();
  return SENHA_USUARIO_REGEX_FORTE.test(s);
}

/** Mensagem humana única (DTO / BadRequestException / i18n no web). */
export const MENSAGEM_SENHA_USUARIO_POLITICA_FORTE =
  'A senha deve ter entre 8 e 100 caracteres e incluir ao menos uma letra minúscula, uma maiúscula e um dígito numérico.';
