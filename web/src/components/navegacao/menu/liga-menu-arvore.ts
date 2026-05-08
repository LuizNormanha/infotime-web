import type { LigaMenuEntrada, LigaMenuEstruturaIds, LigaMenuId } from "./liga-menu-tipos";

export type LigaNoMenu = {
  id: LigaMenuId;
  filhos: LigaNoMenu[];
};

function normalizarEntrada(entrada: LigaMenuEntrada): LigaNoMenu {
  if (typeof entrada === "string") {
    return { id: entrada, filhos: [] };
  }
  return {
    id: entrada.id,
    filhos: (entrada.filhos ?? []).map(normalizarEntrada),
  };
}

export function normalizarMenu(menuIds: LigaMenuEstruturaIds): LigaNoMenu[] {
  return menuIds.map(normalizarEntrada);
}

export function coletarTodosIdsGrupos(nos: LigaNoMenu[]): LigaMenuId[] {
  const r: LigaMenuId[] = [];
  function walk(nodes: LigaNoMenu[]) {
    for (const n of nodes) {
      if (n.filhos.length > 0) {
        r.push(n.id);
        walk(n.filhos);
      }
    }
  }
  walk(nos);
  return r;
}

export function descendenteAtivo(no: LigaNoMenu, itemAtivoId: string): boolean {
  if (no.id === itemAtivoId) return true;
  return no.filhos.some((f) => descendenteAtivo(f, itemAtivoId));
}

export function grupoTemSubitemNaBuscaRec(
  no: LigaNoMenu,
  buscaNormalizada: string,
  rotulo: (id: LigaMenuId) => string,
): boolean {
  return no.filhos.some((filho) => {
    if (filho.filhos.length > 0) {
      return grupoTemSubitemNaBuscaRec(filho, buscaNormalizada, rotulo);
    }
    const rotuloFilho = rotulo(filho.id).toLocaleLowerCase();
    return rotuloFilho.includes(buscaNormalizada);
  });
}

function filtrarNo(
  no: LigaNoMenu,
  buscaNormalizada: string,
  rotulo: (id: LigaMenuId) => string,
): LigaNoMenu | null {
  const rotuloNo = rotulo(no.id).toLocaleLowerCase();
  const noBate = rotuloNo.includes(buscaNormalizada);

  if (no.filhos.length === 0) {
    return noBate ? no : null;
  }

  const filhosMap = no.filhos
    .map((f) => filtrarNo(f, buscaNormalizada, rotulo))
    .filter((f): f is LigaNoMenu => f !== null);

  if (noBate) {
    return { ...no, filhos: no.filhos };
  }
  if (filhosMap.length > 0) {
    return { ...no, filhos: filhosMap };
  }
  return null;
}

export function filtrarMenu(
  menu: LigaNoMenu[],
  busca: string,
  rotulo: (id: LigaMenuId) => string,
): LigaNoMenu[] {
  const buscaNormalizada = busca.trim().toLocaleLowerCase();
  if (!buscaNormalizada) {
    return menu;
  }
  return menu
    .map((no) => filtrarNo(no, buscaNormalizada, rotulo))
    .filter((no): no is LigaNoMenu => no !== null);
}
