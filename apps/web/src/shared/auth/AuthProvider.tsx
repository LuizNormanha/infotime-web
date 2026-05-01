import { createContext, useCallback, useContext, useMemo, useState, type ReactNode } from "react";

type AuthState = {
  accessToken: string | null;
  idTenacidade: string | null;
  login: (token: string, tenantId: string) => void;
  logout: () => void;
};

const AuthContext = createContext<AuthState | null>(null);

export function AuthProvider({ children }: { children: ReactNode }) {
  const [accessToken, setAccessToken] = useState<string | null>(() =>
    localStorage.getItem("accessToken"),
  );
  const [idTenacidade, setIdTenacidade] = useState<string | null>(() =>
    localStorage.getItem("idTenacidade"),
  );

  const login = useCallback((token: string, tenant: string) => {
    localStorage.setItem("accessToken", token);
    localStorage.setItem("idTenacidade", tenant);
    setAccessToken(token);
    setIdTenacidade(tenant);
  }, []);

  const logout = useCallback(() => {
    localStorage.removeItem("accessToken");
    localStorage.removeItem("idTenacidade");
    setAccessToken(null);
    setIdTenacidade(null);
  }, []);

  const value = useMemo(
    () => ({ accessToken, idTenacidade, login, logout }),
    [accessToken, idTenacidade, login, logout],
  );

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth(): AuthState {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error("useAuth fora de AuthProvider");
  return ctx;
}
