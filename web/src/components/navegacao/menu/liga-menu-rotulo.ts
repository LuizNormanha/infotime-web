import { MENU_ROTULOS_DST } from "@/data/menu-estrutura-dst-gerado";
import { ROTULOS_MENU_INFOTIME_WEB } from "@/data/rotulos-menu-infotime-web";

/** Rótulo exibido no menu: overrides InfoTIME, texto do DST ou tradução `home.menuItens.*`. */
export function rotuloItemMenu(
  id: string,
  tMenuItem: (chave: string) => string,
): string {
  const infotime = ROTULOS_MENU_INFOTIME_WEB[id];
  if (infotime) return infotime;
  const dst = MENU_ROTULOS_DST[id];
  if (dst) return dst;
  return tMenuItem(`menuItens.${id}`);
}
