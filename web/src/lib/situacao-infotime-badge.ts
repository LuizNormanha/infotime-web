/**
 * Variante visual do badge de situação (cores em `liga-cliente-infotime.css`),
 * alinhada à listagem de clientes (`cliente-infotime-listagem-colunas.ts`).
 */
export type SituacaoInfotimeBadgeVariante =
  | "ativo"
  | "inativo"
  | "lead"
  | "prospect"
  | "outro";

function semDiacriticos(s: string): string {
  return s.normalize("NFD").replace(/\p{M}/gu, "");
}

/**
 * Mapeia o rótulo exibido da situação (cadastro em pt-BR) para a variante de cor do badge.
 */
export function normalizarRotuloSituacaoInfotimeBadge(
  valor: string | null | undefined,
): SituacaoInfotimeBadgeVariante {
  const bruto = String(valor ?? "").trim();
  if (!bruto || bruto === "—") return "outro";
  const t = semDiacriticos(bruto.toLocaleLowerCase("pt-BR"));
  if (t === "ativo" || t === "activo") return "ativo";
  if (t === "inativo") return "inativo";
  if (t === "lead") return "lead";
  if (t === "prospect") return "prospect";
  if (
    t === "demitido" ||
    t === "desligado" ||
    t === "rescindido" ||
    t === "dispensado"
  ) {
    return "inativo";
  }
  if (t === "admitido" || t === "contratado" || t === "efetivado") return "ativo";
  return "outro";
}
