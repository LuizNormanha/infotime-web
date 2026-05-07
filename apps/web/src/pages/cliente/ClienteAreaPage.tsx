import { useLocation } from "react-router-dom";
import { ClienteFormPage } from "./ClienteFormPage.js";
import { ClienteListPage } from "./ClienteListPage.js";

/**
 * Conteúdo da aba Clientes: lista em `/clientes`, inclusão em `/clientes/novo`, edição em `/clientes/:id`.
 */
export function ClienteAreaPage() {
  const { pathname } = useLocation();
  const p = pathname.replace(/\/+$/, "") || "/";

  if (p === "/clientes/novo") {
    return <ClienteFormPage mode="create" />;
  }

  const m = /^\/clientes\/([^/]+)$/.exec(p);
  if (m?.[1] && m[1] !== "novo") {
    return <ClienteFormPage mode="edit" clienteId={m[1]} />;
  }

  return <ClienteListPage />;
}
