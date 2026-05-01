import { Link, Outlet, useNavigate } from "react-router-dom";
import { Button } from "primereact/button";
import { useAuth } from "../../auth/AuthProvider.js";
import { useEffect } from "react";

export function AppLayout() {
  const { accessToken, logout } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (!accessToken) navigate("/login");
  }, [accessToken, navigate]);

  if (!accessToken) return null;

  return (
    <div className="min-h-screen surface-ground">
      <header className="surface-card shadow-1 p-3 flex align-items-center justify-content-between">
        <nav className="flex gap-3 align-items-center">
          <Link to="/">Início</Link>
          <Link to="/usuarios">Usuários</Link>
          <Link to="/clientes">Clientes</Link>
        </nav>
        <Button label="Sair" icon="pi pi-sign-out" text onClick={() => { logout(); navigate("/login"); }} />
      </header>
      <main className="p-4">
        <Outlet />
      </main>
    </div>
  );
}
