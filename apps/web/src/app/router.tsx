import { createBrowserRouter } from "react-router-dom";
import { AppLayout } from "../shared/components/layout/AppLayout.js";
import { LoginPage } from "../pages/auth/LoginPage.js";
import {
  AjudaPage,
  PrivacidadePage,
  RecuperarSenhaPage,
  TermosPage,
} from "../pages/public/PublicSitePages.js";
import { Fragment } from "react";

export const router = createBrowserRouter([
  {
    path: "/login",
    element: <LoginPage />,
  },
  { path: "/recuperar-senha", element: <RecuperarSenhaPage /> },
  { path: "/ajuda", element: <AjudaPage /> },
  { path: "/privacidade", element: <PrivacidadePage /> },
  { path: "/termos", element: <TermosPage /> },
  {
    path: "/",
    element: <AppLayout />,
    children: [
      { index: true, element: <Fragment /> },
      { path: "usuarios", element: <Fragment /> },
      { path: "clientes/novo", element: <Fragment /> },
      { path: "clientes/:id", element: <Fragment /> },
      { path: "clientes", element: <Fragment /> },
    ],
  },
]);
