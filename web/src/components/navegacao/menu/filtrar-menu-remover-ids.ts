import type { LigaMenuEstruturaIds } from "./liga-menu-tipos";

/** Itens que permanecem fora do menu lateral / home (ids canônicos DST). */
export const MENU_IDS_REMOVIDOS_LATERAL = new Set<string>([
  "opcoes",
  "ajuda",
  "implantacao",
  "mod-resultados-liberação-em-planilha",
  "mod-resultados-liberação-expressa",
  "cad-exames-exames-de-laboratórios-de-apoio-planilha",
  "cad-exames-itens-de-atendimento-planilha",
  "cadastros-clientes-tipo-de-logradouro",
  "cadastros-clientes-c-e-p",
  "cadastros-clientes-necessidades-especiais",
]);

export function filtrarMenuRemovendoIds(
  ids: LigaMenuEstruturaIds,
  remover: ReadonlySet<string>,
): LigaMenuEstruturaIds {
  const resultado: LigaMenuEstruturaIds = [];
  for (const item of ids) {
    if (typeof item === "string") {
      if (!remover.has(item)) resultado.push(item);
      continue;
    }
    if (remover.has(item.id)) continue;
    const filhos = item.filhos ?? [];
    resultado.push({
      id: item.id,
      filhos: filtrarMenuRemovendoIds(filhos, remover),
    });
  }
  return resultado;
}
