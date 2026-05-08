import type { LigaMenuEstruturaIds } from "@/components/navegacao/menu/liga-menu-tipos";

/**
 * Menu padrão do template InfoTIME Web: sem módulos legados (ex.: atendimentos DST).
 * Usuário técnico e fallback sem personalização em `layout/menu` usam esta estrutura.
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
