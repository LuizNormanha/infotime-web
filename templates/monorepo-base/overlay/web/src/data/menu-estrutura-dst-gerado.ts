/**
 * Stub enxuto para o ZIP do template (substitui o menu DST completo do InfoTIME Web).
 * O repositório infotime-web mantém o arquivo gerado completo; o export do template usa só o núcleo.
 */
import type { LigaMenuEstruturaIds } from "@/components/navegacao/menu/liga-menu-tipos";

export const MENU_ROTULOS_DST: Record<string, string> = {
  dashboard: "Painel",
  "infotime-template-app": "Cadastros",
  "cad-acesso-usuário": "Usuário",
  "cad-acesso-perfil": "Grupo (perfil)",
  "cad-acesso-usuario-perfil": "Permissões",
  "impl-tenacidade": "Tenacidade",
  "impl-tenacidade-configuracao": "Configuração da tenacidade",
  "ajuda-documentacao": "Documentação",
  "aj-suporte-online": "Suporte",
};

export const MENU_ICONES_DST: Record<string, string> = {
  dashboard: "pi-home",
  "infotime-template-app": "pi-cog",
  "cad-acesso-usuário": "pi-user",
  "cad-acesso-perfil": "pi-users",
  "cad-acesso-usuario-perfil": "pi-lock",
  "impl-tenacidade": "pi-building",
  "impl-tenacidade-configuracao": "pi-sliders-h",
  "ajuda-documentacao": "pi-book",
  "aj-suporte-online": "pi-comments",
};

export const MENU_ID_ABA_CANONICO: Record<string, string> = {};

export const MENU_HOME_ESTRUTURA_DST: LigaMenuEstruturaIds = [
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
