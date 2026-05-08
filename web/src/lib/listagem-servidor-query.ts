import type { LigaFiltroRefinadoValor } from "@/components/formulario-pesquisa/liga-listagem.types";

/** Serializa filtros refinados para query `filtroRefinado` (JSON). */
export function serializarFiltrosRefinadoParaQuery(
  f: Record<string, LigaFiltroRefinadoValor | undefined>,
): string | undefined {
  const o: Record<string, LigaFiltroRefinadoValor> = {};
  for (const [k, v] of Object.entries(f)) {
    if (v != null) o[k] = v;
  }
  if (Object.keys(o).length === 0) return undefined;
  return JSON.stringify(o);
}

export type ParametrosListagemServidorPadrao = {
  /** Normalmente `primeiraPagina` (listagem CRUD). */
  cargaInicial?: string;
  pagina: number;
  tamanhoPagina: number;
  /** Termo da busca rápida (vazio = omitir q/campoPesquisa). */
  termoBusca?: string;
  /** Campo whitelist na API (nome do campo de pesquisa). */
  campoPesquisa?: string;
  /** JSON string já serializado ou undefined. */
  filtroRefinadoJson?: string | undefined;
};

/**
 * Monta os mesmos parâmetros de query usados pela listagem de referência (Cliente)
 * e pelo contrato documentado em `ai/domains/padroes-ui` §11.5–11.6.
 */
export function montarSearchParamsListagemPadrao(
  p: ParametrosListagemServidorPadrao,
): URLSearchParams {
  const params = new URLSearchParams();
  params.set("cargaInicial", p.cargaInicial ?? "primeiraPagina");
  params.set("pagina", String(p.pagina));
  params.set("tamanhoPagina", String(p.tamanhoPagina));
  const termo = (p.termoBusca ?? "").trim();
  if (termo !== "" && (p.campoPesquisa ?? "").trim() !== "") {
    params.set("q", termo);
    params.set("campoPesquisa", p.campoPesquisa!.trim());
  }
  if (p.filtroRefinadoJson != null && p.filtroRefinadoJson !== "") {
    params.set("filtroRefinado", p.filtroRefinadoJson);
  }
  return params;
}
