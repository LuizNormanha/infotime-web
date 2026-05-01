import { useAuth } from "../auth/AuthProvider.js";

/** Piloto: administrador tem todas as permissões; expandir com claims/RBAC. */
export function usePermission(_acao: string, _recurso?: string): boolean {
  const { accessToken } = useAuth();
  if (!accessToken) return false;
  // Decodificar JWT no cliente apenas para UI — autorização real é na API.
  try {
    const payload = JSON.parse(atob(accessToken.split(".")[1] ?? "")) as {
      administrador?: boolean;
    };
    return Boolean(payload.administrador);
  } catch {
    return true;
  }
}
