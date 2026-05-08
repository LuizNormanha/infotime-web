/** Lista agregada no banco (ids ou códigos separados por vírgula). */
export function parseListaAgregada(raw: unknown): string[] {
  if (raw == null || raw === "") return [];
  return String(raw)
    .split(",")
    .map((s) => s.trim())
    .filter(Boolean);
}

export function serializarListaAgregada(ids: string[]): string | null {
  if (ids.length === 0) return null;
  return ids.join(",");
}

export function aplicarLimiteStringAgregada(
  valor: string | null,
  maxLen: number,
): string | null {
  if (valor == null) return null;
  return valor.length > maxLen ? valor.slice(0, maxLen) : valor;
}
