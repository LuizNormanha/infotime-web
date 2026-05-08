import type { LigaMenuEstruturaIds } from "@/components/navegacao/menu/liga-menu-tipos";
import { MENU_HOME_ESTRUTURA_DST } from "@/data/menu-estrutura-dst-gerado";

/**
 * Menu base DST completo: alimenta `tryMontarMenuHomeBarraInfotime` (barra Clientes,
 * Fornecedores, RH, Comercial, Financeiro, Estoque, Cadastros em cascata).
 * Usuário técnico e fallback sem `/api/layout/menu` usam esta estrutura.
 */
export const MENU_HOME_TEMPLATE_INFOTIME: LigaMenuEstruturaIds =
  MENU_HOME_ESTRUTURA_DST;
