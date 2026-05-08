import { normalizarMenu, type LigaNoMenu } from "./liga-menu-arvore";
import type { LigaMenuEstruturaIds, LigaMenuId } from "./liga-menu-tipos";

/**
 * Item navegável na busca do menu (abas da home).
 * No futuro pode concatenar outras fontes (ex.: rótulos de campos de formulário)
 * antes do filtro — ver `listarItensMenuPesquisaveis`.
 */
export type LigaItemMenuPesquisavel = {
  menuId: LigaMenuId;
  label: string;
  /** Trilha: Cadastros › Clientes › … */
  caminho: string;
  /** Texto normalizado para filtro (minúsculas, sem acentos). */
  termoNorm: string;
};

export function normalizarTextoMenu(s: string): string {
  return s
    .toLowerCase()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "");
}

function achatarFolhasAcionaveis(
  nos: LigaNoMenu[],
  ancestralRotulos: string[],
  rotulo: (id: LigaMenuId) => string,
): LigaItemMenuPesquisavel[] {
  const out: LigaItemMenuPesquisavel[] = [];
  for (const no of nos) {
    const label = rotulo(no.id);
    if (no.filhos.length > 0) {
      out.push(
        ...achatarFolhasAcionaveis(no.filhos, [...ancestralRotulos, label], rotulo),
      );
    } else {
      const caminho = [...ancestralRotulos, label].join(" › ");
      const termoNorm = normalizarTextoMenu(`${caminho} ${label}`);
      out.push({ menuId: no.id, label, caminho, termoNorm });
    }
  }
  return out;
}

/** Folhas com aba em toda a árvore permitida ao utilizador (para busca / AutoComplete). */
export function listarItensMenuPesquisaveis(
  menuIds: LigaMenuEstruturaIds,
  rotulo: (id: LigaMenuId) => string,
): LigaItemMenuPesquisavel[] {
  return achatarFolhasAcionaveis(normalizarMenu(menuIds), [], rotulo);
}
