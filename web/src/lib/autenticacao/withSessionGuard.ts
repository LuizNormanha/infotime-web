"use client";

export type AcaoComSessao = () => void | Promise<void>;

export async function validarSessaoJwtAtual(): Promise<boolean> {
  try {
    const status = await fetch("/api/auth/status", { cache: "no-store" });
    if (!status.ok) return false;
    const payload = (await status.json().catch(() => ({}))) as {
      valido?: boolean;
    };
    return payload.valido === true;
  } catch {
    return false;
  }
}

export async function deveReautenticarPorResposta(
  res: Response,
): Promise<boolean> {
  if (res.status !== 401) return false;
  return !(await validarSessaoJwtAtual());
}

export async function executarComPrecheckSessao(
  acao: AcaoComSessao,
  onSessaoExpirada: (acaoPendente: AcaoComSessao) => void,
): Promise<boolean> {
  const valida = await validarSessaoJwtAtual();
  if (!valida) {
    onSessaoExpirada(acao);
    return false;
  }
  await acao();
  return true;
}

export function solicitarReautenticacaoGlobal(acaoPendente?: AcaoComSessao): void {
  if (typeof window === "undefined") return;
  window.dispatchEvent(
    new CustomEvent("liga:reautenticacao-solicitada", {
      detail: { acaoPendente },
    }),
  );
}
