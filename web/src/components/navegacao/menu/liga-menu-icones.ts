import { MENU_ICONES_DST } from "@/data/menu-estrutura-dst-gerado";

/** Overrides de icones para alinhamento visual do produto. */
const ICONE_MENU_OVERRIDES: Record<string, string> = {
  "infotime-template-app": "pi-cog",
  dashboard: "pi-chart-bar",
  "cadastros-clientes": "pi-user",
  "cad-estoque-fornecedores-fabricantes": "pi-user-plus",
  "infotime-rh": "pi-users",
  "infotime-comercial": "pi-briefcase",
  "infotime-financeiro": "pi-dollar",
  "infotime-estoque": "pi-th-large",
  "infotime-modulos-operacionais": "pi-box",
  cadastros: "pi-cog",
  "infotime-cad-integracao": "pi-check",
  "infotime-cad-int-codigo-externo": "pi-list",
  "infotime-cad-int-config-cobranca": "pi-handshake",
  "infotime-cad-int-tipos-especie": "pi-list",
  "infotime-cad-int-demais-lab": "pi-sitemap",
  "infotime-cad-pessoal": "pi-users",
  "infotime-cad-pess-situacoes-colaborador": "pi-list",
  "infotime-cad-pess-tipos-colaborador": "pi-list",
  "infotime-cad-pess-tipos-despesa-viagem": "pi-list",
  "infotime-cad-pess-tipos-finalidade-viagem": "pi-list",
  "infotime-cad-pess-tipos-meio-transporte": "pi-list",
  "infotime-cad-pessoal-demais-dst": "pi-list",
  "infotime-cad-site-noticias-infotime": "pi-list",
  "infotime-cad-site-treinamentos": "pi-desktop",
  "infotime-cad-sup-aplicacoes": "pi-th-large",
  "infotime-cad-sup-triggers-auditoria": "pi-cog",
  "infotime-cad-sup-sincronizar-grupos-apps": "pi-users",
  "solucoes-saude-humana": "pi-heart",
  "solucoes-saude-humana-novo-atendimento": "pi-heart",
};

/** Ícones dos cadastros já existentes na web (PrimeIcons). */
const ICONE_MENU_LEGADO: Record<string, string> = {
  dashboard: "pi-home",
  relatorios: "pi-chart-bar",
  "relatorios-tipos": "pi-file-pdf",
  ajuda: "pi-question-circle",
  "ajuda-documentacao": "pi-book",
  "ajuda-suporte": "pi-comments",
  cadastros: "pi-folder",
  "cadastros-clientes": "pi-users",
  "cadastros-medicos": "pi-user-plus",
  "cadastros-grupo-clientes": "pi-users",
  "cadastros-grupo-medicos": "pi-user-plus",
  "cadastros-grupo-pagamentos": "pi-credit-card",
  "cadastros-grupo-laboratorio": "pi-box",
  "cadastros-grupo-agenda": "pi-calendar",
  "cadastros-grupo-sistema": "pi-cog",
  "cadastros-grupo-convenios-exames": "pi-briefcase",
  "cadastros-grupo-estoque": "pi-box",
  "cadastros-grupo-relatorios": "pi-file-pdf",
  "cadastros-cbo": "pi-briefcase",
  "cadastros-cid": "pi-book",
  "cadastros-conselho-regional": "pi-shield",
  "cadastros-especialidade-medica": "pi-star",
  "cadastros-etnia": "pi-globe",
  "cadastros-feriado": "pi-calendar",
  "cadastros-motivo-cancelamento": "pi-times-circle",
  "cadastros-motivo-desconto": "pi-percentage",
  "cadastros-motivo-exame-retificacao": "pi-pencil",
  "cadastros-motivo-orcamento-rejeicao": "pi-ban",
  "cadastros-motivo-quarentena": "pi-lock",
  "cadastros-motivo-recoleta": "pi-refresh",
  "cadastros-motivo-retificacao": "pi-file-edit",
  "cadastros-raca": "pi-flag",
  "cadastros-situacao-coleta": "pi-map-marker",
  "cadastros-tipo-aplicacao": "pi-box",
  "cadastros-tipo-destino-resultado": "pi-send",
  "cadastros-tipo-estado-civil": "pi-heart",
  "cadastros-tipo-evento": "pi-bolt",
  "cadastros-tipo-indicacao": "pi-share-alt",
  "cadastros-tipo-integracao": "pi-link",
  "cadastros-tipo-interface": "pi-desktop",
  "cadastros-tipo-pagamento": "pi-credit-card",
  "cadastros-preco-tabela": "pi-table",
  "cadastros-preco-fator": "pi-calculator",
  "cadastros-tipo-relatorio": "pi-file-pdf",
  "cadastros-unidade-federacao": "pi-map",
  "cadastros-analisadores": "pi-desktop",
  "cadastros-aplicacoes": "pi-th-large",
  "cadastros-computadores": "pi-desktop",
  "cadastros-convenios": "pi-id-card",
  "cadastros-exames": "pi-file",
  "cadastros-exames-material-lab-apoio": "pi-link",
  "cadastros-grupos": "pi-sitemap",
  "cadastros-indicacoes": "pi-share-alt",
  "cadastros-integracoes": "pi-link",
  "cadastros-labs-apoio": "pi-building",
  "cadastros-labs-apoio-unidade": "pi-sitemap",
  "cadastros-labs-apoio-ws": "pi-wifi",
  "cadastros-locais-armazenamento": "pi-folder-open",
  "cadastros-materiais": "pi-box",
  "cadastros-medicamentos": "pi-heart",
  "cadastros-modelos-resultado": "pi-file-edit",
  "cadastros-procedencias": "pi-map-marker",
  "cadastros-questionarios": "pi-list-check",
  "cadastros-recipientes": "pi-inbox",
  "cadastros-setores": "pi-th-large",
  "cadastros-usuarios": "pi-user",
  preferencias: "pi-sliders-h",
  "preferencias-formularios": "pi-table",
  "preferencias-layout-formulario": "pi-objects-column",
  solucoes: "pi-th-large",
  "solucoes-saude-humana": "pi-heart",
};

/** Ícone PrimeIcons por id de menu (DST + legado). */
export function iconeMenuItem(id: string): string {
  return (
    ICONE_MENU_OVERRIDES[id] ?? MENU_ICONES_DST[id] ?? ICONE_MENU_LEGADO[id] ?? "pi-circle"
  );
}

/**
 * @deprecated Use `iconeMenuItem(id)` para ids novos do DST.
 * Objeto parcial para código legado que espera indexação direta.
 */
export const ICONE_MENU_ITEM: Record<string, string> = new Proxy(
  {} as Record<string, string>,
  {
    get(_, prop: string) {
      return iconeMenuItem(prop);
    },
  },
);
