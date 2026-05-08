/** Exibição de campos de cadastro de cliente (painel resumo) — alinhado ao atendimento. */

export function strClienteCadastroExibicao(v: unknown): string {
  if (v == null) return "";
  return String(v);
}

export function formatarSomenteDataCliente(
  iso: string | null | undefined,
): string {
  if (!iso) return "";
  const d = new Date(iso);
  if (Number.isNaN(d.getTime())) return "";
  return d.toLocaleDateString("pt-BR");
}

/** Idade em anos completos, para o painel resumo (diferente de idade D/M/A do orçamento). */
export function idadeAnosDeDataNascimento(
  iso: string | null | undefined,
): string {
  if (!iso) return "";
  const d = new Date(iso);
  if (Number.isNaN(d.getTime())) return "";
  const hoje = new Date();
  let anos = hoje.getFullYear() - d.getFullYear();
  const m = hoje.getMonth() - d.getMonth();
  if (m < 0 || (m === 0 && hoje.getDate() < d.getDate())) anos -= 1;
  return String(anos);
}

export function montarEnderecoCliente(
  c: Record<string, unknown>,
): string {
  const s = strClienteCadastroExibicao;
  const partes = [
    s(c.logradouro),
    s(c.numero),
    s(c.bairro),
    s(c.cidade),
    s(c.estado),
  ].filter((p) => p.trim() !== "");
  return partes.join(", ");
}
