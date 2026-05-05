import { createContext, useCallback, useContext, useMemo, useState, type ReactNode } from "react";

type AuthState = {
  accessToken: string | null;
  idTenacidade: string | null;
  userLogin: string | null;
  login: (token: string, tenantId: string, userLogin: string) => void;
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
  const [userLogin, setUserLogin] = useState<string | null>(() => localStorage.getItem("userLogin"));

  const login = useCallback((token: string, tenant: string, loginUsuario: string) => {
    localStorage.setItem("accessToken", token);
    localStorage.setItem("idTenacidade", tenant);
    localStorage.setItem("userLogin", loginUsuario);
    setAccessToken(token);
    setIdTenacidade(tenant);
    setUserLogin(loginUsuario);
  }, []);

  const logout = useCallback(() => {
    localStorage.removeItem("accessToken");
    localStorage.removeItem("idTenacidade");
    localStorage.removeItem("userLogin");
    setAccessToken(null);
    setIdTenacidade(null);
    setUserLogin(null);
  }, []);

  const value = useMemo(
    () => ({ accessToken, idTenacidade, userLogin, login, logout }),
    [accessToken, idTenacidade, userLogin, login, logout],
  );

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth(): AuthState {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error("useAuth fora de AuthProvider");
  return ctx;
}
