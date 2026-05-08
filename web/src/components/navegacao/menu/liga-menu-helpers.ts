import type { LigaMenuEntrada, LigaMenuEstruturaIds } from "./liga-menu-tipos";
import type { LigaNoMenu } from "./liga-menu-arvore";

export function buscarNoPorId(nos: LigaNoMenu[], id: string): LigaNoMenu | null {
  for (const no of nos) {
    if (no.id === id) return no;
    const descendente = buscarNoPorId(no.filhos, id);
    if (descendente) return descendente;
  }
  return null;
}

export function buscarFilhoDireto(pai: LigaNoMenu, id: string): LigaNoMenu | null {
  return pai.filhos.find((filho) => filho.id === id) ?? null;
}

export function clonarNoMenu(no: LigaNoMenu): LigaMenuEntrada {
  if (no.filhos.length === 0) return no.id;
  return { id: no.id, filhos: no.filhos.map(clonarNoMenu) };
}

export function coletarIdsEstrutura(estrutura: LigaMenuEstruturaIds): Set<string> {
  const ids = new Set<string>();
  const walk = (entrada: LigaMenuEntrada) => {
    if (typeof entrada === "string") {
      ids.add(entrada);
      return;
    }
    ids.add(entrada.id);
    for (const filho of entrada.filhos ?? []) walk(filho);
  };
  for (const entrada of estrutura) walk(entrada);
  return ids;
}

function filtrarEntradaPorPermitidos(
  entrada: LigaMenuEntrada,
  permitidos: Set<string>,
): LigaMenuEntrada | null {
  if (typeof entrada === "string") {
    if (entrada.startsWith("infotime-")) return entrada;
    return permitidos.has(entrada) ? entrada : null;
  }

  const filhos = (entrada.filhos ?? [])
    .map((filho) => filtrarEntradaPorPermitidos(filho, permitidos))
    .filter((filho): filho is LigaMenuEntrada => filho !== null);

  if (filhos.length === 0) return null;
  return { id: entrada.id, filhos };
}

export function filtrarEstruturaPorPermitidos(
  estrutura: LigaMenuEstruturaIds,
  permitidos: Set<string>,
): LigaMenuEstruturaIds {
  const filtrado: LigaMenuEstruturaIds = [];
  for (const entrada of estrutura) {
    const item = filtrarEntradaPorPermitidos(entrada, permitidos);
    if (item !== null) filtrado.push(item);
  }
  return filtrado;
}
