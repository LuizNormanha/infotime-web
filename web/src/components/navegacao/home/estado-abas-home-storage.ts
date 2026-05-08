import type { LigaAbaHome } from "@/components/abas/LigaSistemaAbas";
import { STORAGE_ESTADO_ABAS_HOME } from "@/lib/navegacao/home-estado-abas";

/**
 * Incrementado em logout/login que limpa abas. A home pode comparar com um contador
 * para reset idempotente (Strict Mode / corrida com JSON antigo).
 */
export const STORAGE_SESSION_ABA_EPOCH_HOME = "liga.home.abaEpoch.v1";

/** Último epoch já aplicado no layout da home. */
export const STORAGE_SESSION_ABA_EPOCH_APLICADO_HOME =
  "liga.home.abaEpochAplicado.v1";

export function lerEpochAbasHomeSessionStorage(): number {
  if (typeof window === "undefined") return 0;
  const v = window.sessionStorage.getItem(STORAGE_SESSION_ABA_EPOCH_HOME);
  if (v == null || String(v).trim() === "") return 0;
  const n = Number(v);
  return Number.isFinite(n) ? n : 0;
}

export function lerEpochAbasHomeAplicadoSessionStorage(): number {
  if (typeof window === "undefined") return 0;
  const v = window.sessionStorage.getItem(STORAGE_SESSION_ABA_EPOCH_APLICADO_HOME);
  if (v == null || String(v).trim() === "") return 0;
  const n = Number(v);
  return Number.isFinite(n) ? n : 0;
}

export function marcarEpochAbasHomeAplicadoSessionStorage(epoch: number): void {
  if (typeof window === "undefined") return;
  window.sessionStorage.setItem(
    STORAGE_SESSION_ABA_EPOCH_APLICADO_HOME,
    String(epoch),
  );
}

/** Limpa persistência de abas e invalida snapshots antigos (padrão infotime-web). */
export function limparEstadoAbasHomeSessionStorage(): void {
  if (typeof window === "undefined") return;
  window.sessionStorage.removeItem(STORAGE_ESTADO_ABAS_HOME);
  window.sessionStorage.removeItem(STORAGE_SESSION_ABA_EPOCH_APLICADO_HOME);
  window.sessionStorage.setItem(STORAGE_SESSION_ABA_EPOCH_HOME, String(Date.now()));
}

/** Evita duplicar o mesmo `aba.id` (chaves React / painéis duplicados). */
export function dedupeAbasHomePreservandoOrdem(abas: LigaAbaHome[]): LigaAbaHome[] {
  const visto = new Set<string>();
  const out: LigaAbaHome[] = [];
  for (const aba of abas) {
    if (visto.has(aba.id)) continue;
    visto.add(aba.id);
    out.push(aba);
  }
  return out;
}
