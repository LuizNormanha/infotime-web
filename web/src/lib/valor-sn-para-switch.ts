/**
 * Valor S/N ou legado boolean — estado `checked` do `InputSwitch`
 * (cadastro genérico, flags CHAR(1), etc.).
 */
export function valorSnParaSwitch(v: unknown): boolean {
  return v === true || v === "S" || v === "s";
}
