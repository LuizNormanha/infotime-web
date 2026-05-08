import { BadRequestException } from '@nestjs/common';

/**
 * Subconjunto comum de query string das listagens CRUD tipo Cliente
 * (paginação servidor + q/campoPesquisa + filtroRefinado JSON).
 */
export type QueryListagemCrudPadrao = {
  cargaInicial?: string;
  q?: string;
  campoPesquisa?: string;
  pagina?: string;
  tamanhoPagina?: string;
  filtroRefinado?: string;
};

/** `true` quando o cliente pediu o modo paginado / filtrado no servidor (não só lista legada). */
export function modoListagemCrudNovo(query?: QueryListagemCrudPadrao): boolean {
  if (query == null) return false;
  return (
    query.cargaInicial != null ||
    query.pagina != null ||
    query.tamanhoPagina != null ||
    query.campoPesquisa != null ||
    query.q !== undefined ||
    (query.filtroRefinado != null && query.filtroRefinado.trim() !== '')
  );
}

export function parsePaginaETamanhoPagina(query?: QueryListagemCrudPadrao): {
  pagina: number;
  tamanhoPagina: number;
} {
  const pagina = Math.max(parseInt(query?.pagina ?? '0', 10) || 0, 0);
  const tamanhoPagina = Math.min(
    Math.max(parseInt(query?.tamanhoPagina ?? '10', 10) || 10, 1),
    100,
  );
  return { pagina, tamanhoPagina };
}

/** Parse JSON de `filtroRefinado`; falha com 400 se inválido (igual Cliente). */
export function parseJsonFiltroRefinado(
  jsonBruto: string | undefined,
): Record<string, unknown> {
  if (jsonBruto == null || jsonBruto.trim() === '') {
    return {};
  }
  let root: unknown;
  try {
    root = JSON.parse(jsonBruto) as unknown;
  } catch {
    throw new BadRequestException('filtroRefinado não é JSON válido.');
  }
  if (root === null || typeof root !== 'object' || Array.isArray(root)) {
    return {};
  }
  return root as Record<string, unknown>;
}
