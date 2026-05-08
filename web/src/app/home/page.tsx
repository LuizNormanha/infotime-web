import { Suspense } from "react";

import {
  LigaHomeNavegacao,
  type LigaHomeNavegacaoProps,
} from "@/components/navegacao/home/LigaHomeNavegacao";
import { MENU_HOME_TEMPLATE_INFOTIME } from "@/data/menu-home-template-infotime";

const MENU_HOME_IDS: LigaHomeNavegacaoProps["menuIds"] =
  MENU_HOME_TEMPLATE_INFOTIME;

export default function PaginaHome() {
  return (
    <Suspense fallback={null}>
      <LigaHomeNavegacao menuIds={MENU_HOME_IDS} />
    </Suspense>
  );
}
