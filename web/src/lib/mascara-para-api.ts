/**
 * Normalização de valores **mascarados na UI** para o JSON enviado à API.
 * O backend (class-validator `MaxLength`, colunas numéricas de dígitos etc.) espera
 * em geral **só dígitos** para CPF, CNPJ, CEP e telefones — não enviar pontuação.
 */

/** Remove qualquer caractere que não seja dígito (0–9). */
export function somenteDigitos(valor: unknown): string {
  return String(valor ?? "").replace(/\D/g, "");
}

/** Dígitos apenas; se não houver nenhum dígito, retorna `null` (campo opcional na API). */
export function digitosOuNulo(valor: unknown): string | null {
  const d = somenteDigitos(valor);
  return d === "" ? null : d;
}
