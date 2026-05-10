/**
 * Abre abas na home a partir do cockpit (Gestão integrada) sem acoplar ao router.
 * A {@link LigaHomeNavegacao} escuta {@link EVENTO_ABRIR_ABA_MENU};
 * os painéis de contas escutam {@link EVENTO_SINCRONIZAR_PAINEL_FINANCEIRO} e o backup em `sessionStorage`.
 */

export const EVENTO_ABRIR_ABA_MENU = "liga:abrir-aba-menu";

export const EVENTO_SINCRONIZAR_PAINEL_FINANCEIRO = "liga:financeiro-sincronizar-painel";

export type AlvoPainelFinanceiro = "contas-receber" | "contas-pagar";

export type IntentPainelFinanceiro = {
  listagemExtra?: Record<string, string>;
  abrir?: "lista" | "novo" | "edicao";
  idEdicao?: string | null;
};

const MENU_ID_POR_ALVO: Record<AlvoPainelFinanceiro, string> = {
  "contas-receber": "infotime-fin-contas-receber",
  "contas-pagar": "infotime-fin-contas-pagar",
};

export function chaveStorageIntentPainel(alvo: AlvoPainelFinanceiro): string {
  return `liga.financeiro.intent.${alvo}`;
}

export type DetalheAbrirAbaMenu = { menuId: string };

export type DetalheSincronizarPainelFinanceiro = {
  alvo: AlvoPainelFinanceiro;
  intent: IntentPainelFinanceiro;
};

/**
 * Grava intent, pede abertura da aba correspondente e sincroniza o painel (aba nova ou já aberta).
 */
export function solicitarAbrirPainelFinanceiro(
  alvo: AlvoPainelFinanceiro,
  intent: IntentPainelFinanceiro,
): void {
  if (typeof window === "undefined") return;
  try {
    sessionStorage.setItem(chaveStorageIntentPainel(alvo), JSON.stringify(intent));
  } catch {
    /* quota / modo privado */
  }
  window.dispatchEvent(
    new CustomEvent<DetalheAbrirAbaMenu>(EVENTO_ABRIR_ABA_MENU, {
      detail: { menuId: MENU_ID_POR_ALVO[alvo] },
    }),
  );
  queueMicrotask(() => {
    window.dispatchEvent(
      new CustomEvent<DetalheSincronizarPainelFinanceiro>(EVENTO_SINCRONIZAR_PAINEL_FINANCEIRO, {
        detail: { alvo, intent },
      }),
    );
  });
}
