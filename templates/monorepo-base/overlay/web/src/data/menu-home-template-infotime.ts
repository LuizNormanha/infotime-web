import type { LigaMenuEstruturaIds } from "@/components/navegacao/menu/liga-menu-tipos";

/**
 * Menu mínimo do template Liga (acesso + tenant + configuração).
 */
export const MENU_HOME_TEMPLATE_INFOTIME: LigaMenuEstruturaIds = [
  "dashboard",
  {
    id: "infotime-template-app",
    filhos: [
      "cad-acesso-usuário",
      "cad-acesso-perfil",
      "impl-tenacidade",
      "impl-tenacidade-configuracao",
    ],
  },
];
