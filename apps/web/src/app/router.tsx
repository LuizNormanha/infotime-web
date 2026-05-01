import { createBrowserRouter } from "react-router-dom";
import { AppLayout } from "../shared/components/layout/AppLayout.js";
import { LoginPage } from "../pages/auth/LoginPage.js";
import { HomePage } from "../pages/HomePage.js";
import { UsuarioListPage } from "../pages/usuario/UsuarioListPage.js";
import { ClienteListPage } from "../pages/cliente/ClienteListPage.js";

export const router = createBrowserRouter([
  {
    path: "/login",
    element: <LoginPage />,
  },
  {
    path: "/",
    element: <AppLayout />,
    children: [
      { index: true, element: <HomePage /> },
      { path: "usuarios", element: <UsuarioListPage /> },
      { path: "clientes", element: <ClienteListPage /> },
    ],
  },
]);
