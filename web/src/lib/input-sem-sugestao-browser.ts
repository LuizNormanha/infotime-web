/**
 * Atributos padrão para **desativar sugestões / autofill do browser** em inputs
 * que recebem entrada do usuário no sistema (cadastros, formulários de
 * processo, lookups, grids editáveis etc.).
 *
 * Motivação (ver `mcp/padroes/ui/rules.md` §10.5):
 *
 * - Campos de texto que já possuem **autocomplete próprio** (ex.:
 *   `LigaLookupCombobox` mostrando paciente/unidade/exame enquanto o usuário
 *   digita) são cobertos pelo painel do browser com histórico digitado antes,
 *   produzindo **um segundo dropdown sobreposto** ao painel da aplicação —
 *   efeito visual ruim e que concorre com a sugestão correta do domínio.
 * - Em inputs simples de formulário (`InputText`, `InputNumber`, `Calendar`
 *   com input de data, etc.), o mesmo histórico do browser polui o foco e
 *   adiciona linhas de sugestão que **não** fazem parte do produto.
 *
 * `autoComplete="off"` **sozinho não basta**: Chrome/Edge e gestores de senha
 * (LastPass, 1Password, Bitwarden) continuam sugerindo texto digitado antes.
 * Por isso o padrão aplica também `data-lpignore`, `data-1p-ignore`,
 * `data-bwignore` e `data-form-type="other"` — mesma combinação validada em
 * §10 para e-mail e senha de cadastro.
 *
 * Uso:
 *
 * ```tsx
 * <InputText
 *   {...atributosSemSugestaoBrowser()}
 *   value={valor}
 *   onChange={(e) => setValor(e.target.value)}
 * />
 * ```
 *
 * Para `InputNumber` / `Calendar` / outros controles PrimeReact que expõem
 * `inputProps`, repassar o mesmo objeto em `inputProps`.
 */
export function atributosSemSugestaoBrowser(): {
  autoComplete: string;
  autoCorrect: string;
  autoCapitalize: string;
  spellCheck: false;
  "data-lpignore": "true";
  "data-1p-ignore": "true";
  "data-bwignore": "true";
  "data-form-type": "other";
} {
  return {
    autoComplete: "off",
    autoCorrect: "off",
    autoCapitalize: "off",
    spellCheck: false,
    "data-lpignore": "true",
    "data-1p-ignore": "true",
    "data-bwignore": "true",
    "data-form-type": "other",
  };
}
