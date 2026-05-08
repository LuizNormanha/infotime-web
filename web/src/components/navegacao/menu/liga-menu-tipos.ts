/** Id de item de menu (códigos estáveis alinhados ao catálogo de telas / template web). */
export type LigaMenuId = string;

/** Entrada do menu: folha ou grupo com filhos (recursivo). */
export type LigaMenuEntrada =
  | LigaMenuId
  | { id: LigaMenuId; filhos?: LigaMenuEntrada[] };

export type LigaMenuEstruturaIds = LigaMenuEntrada[];
