import type { CamposContasPagar } from "./liga-contas-pagar-infotime-formulario-secoes";

function pickStr(...vals: unknown[]): string {
  for (const v of vals) {
    const s = v == null ? "" : String(v).trim();
    if (s !== "") return s;
  }
  return "";
}

export function montarRotuloExibicaoCliente(d: Record<string, unknown>): string {
  const id = pickStr(d.id_cliente, d.idCliente);
  const nome = pickStr(d.nome_fantasia, d.nomeFantasia, d.razao_social, d.razaoSocial);
  const doc = pickStr(d.cnpj);
  const prefix = id ? `#${id} — ` : "";
  const corpo = doc ? `${nome || "—"} (${doc})` : nome || "—";
  return `${prefix}${corpo}`;
}

export function montarRotuloExibicaoFornecedor(d: Record<string, unknown>): string {
  const id = pickStr(d.id_fornecedor, d.idFornecedor);
  const nome = pickStr(d.nome_fantasia, d.nomeFantasia, d.razao_social, d.razaoSocial);
  const doc = pickStr(d.cnpj);
  const prefix = id ? `#${id} — ` : "";
  const corpo = doc ? `${nome || "—"} (${doc})` : nome || "—";
  return `${prefix}${corpo}`;
}

export function montarRotuloExibicaoColaborador(d: Record<string, unknown>): string {
  const id = pickStr(d.id_colaborador, d.idColaborador);
  const nome = pickStr(d.nome);
  const doc = pickStr(d.cpf);
  const prefix = id ? `#${id} — ` : "";
  const corpo = doc ? `${nome || "—"} (${doc})` : nome || "—";
  return `${prefix}${corpo}`;
}

export async function resolverRotuloAgenteExibicao(
  c: CamposContasPagar,
  signal: AbortSignal,
): Promise<string> {
  const ta = c.idTipoAgente.trim();
  if (ta === "1" && c.idCliente.trim()) {
    const res = await fetch(
      `/api/clientes/${encodeURIComponent(c.idCliente.trim())}`,
      { signal, cache: "no-store" },
    );
    if (!res.ok) return "";
    const j = (await res.json()) as { dados?: Record<string, unknown> };
    return montarRotuloExibicaoCliente(j.dados ?? {});
  }
  if (ta === "2" && c.idFornecedor.trim()) {
    const res = await fetch(
      `/api/fornecedores/${encodeURIComponent(c.idFornecedor.trim())}`,
      { signal, cache: "no-store" },
    );
    if (!res.ok) return "";
    const j = (await res.json()) as { dados?: Record<string, unknown> };
    return montarRotuloExibicaoFornecedor(j.dados ?? {});
  }
  if (ta === "3" && c.idColaborador.trim()) {
    const res = await fetch(
      `/api/contas-pagar/colaboradores/${encodeURIComponent(c.idColaborador.trim())}`,
      { signal, cache: "no-store" },
    );
    if (!res.ok) return "";
    const j = (await res.json()) as { dados?: Record<string, unknown> };
    return montarRotuloExibicaoColaborador(j.dados ?? {});
  }
  return "";
}
