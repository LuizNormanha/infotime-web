/** Rótulo e severidade do Prime Tag para status de orçamento (listagem, formulário, painel). */

export type SeveridadeStatusOrcamento =
  | "success"
  | "info"
  | "warning"
  | "danger"
  | "secondary";

/**
 * @param t Função de tradução em `home.listagem.orcamento` (chaves `statusPendente`, etc.).
 */
export function rotuloESeveridadeStatusOrcamento(
  raw: string,
  t: (key: string) => string,
): { value: string; severity: SeveridadeStatusOrcamento } {
  const n = raw.trim().toLowerCase();
  switch (n) {
    case "pendente":
      return { value: t("statusPendente"), severity: "danger" };
    case "convertido":
      return { value: t("statusConvertido"), severity: "success" };
    case "rejeitado":
      return { value: t("statusRejeitado"), severity: "warning" };
    case "vencido":
      return { value: t("statusVencido"), severity: "warning" };
    case "cancelado":
      return { value: t("statusCancelado"), severity: "secondary" };
    default:
      return { value: raw.trim() || "—", severity: "info" };
  }
}
