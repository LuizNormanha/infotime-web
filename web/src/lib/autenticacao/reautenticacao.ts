type RespostaLogin = {
  message?: unknown;
  mensagem?: unknown;
  captcha_obrigatorio?: boolean;
  captcha?: { id?: string; pergunta?: string };
};

type RespostaLoginConfirm = {
  message?: unknown;
  mensagem?: unknown;
  aviso_licenca_proxima_expiracao?: string;
  captcha_obrigatorio?: boolean;
  captcha?: { id?: string; pergunta?: string };
};

/** Texto vindo da API no 409 (sessão ativa em outro dispositivo), sem fallback genérico. */
export function mensagemConflitoSessao409(
  data: RespostaLogin | null | undefined,
): string | undefined {
  if (!data || typeof data !== "object") return undefined;
  if (typeof data.mensagem === "string" && data.mensagem.trim()) {
    return data.mensagem.trim();
  }
  if (typeof data.message === "string" && data.message.trim()) {
    return data.message.trim();
  }
  if (Array.isArray(data.message) && data.message.length > 0) {
    const s = String(data.message[0] ?? "").trim();
    return s || undefined;
  }
  return undefined;
}

export function mensagemErroReautenticacao(
  data: RespostaLogin | null | undefined,
): string {
  if (!data || typeof data !== "object") return "Falha ao reautenticar.";
  if (typeof data.mensagem === "string" && data.mensagem.trim()) {
    return data.mensagem.trim();
  }
  if (typeof data.message === "string" && data.message.trim()) {
    return data.message.trim();
  }
  if (Array.isArray(data.message) && data.message.length > 0) {
    return String(data.message[0] ?? "").trim() || "Falha ao reautenticar.";
  }
  return "Falha ao reautenticar.";
}

export async function reautenticarSessao(
  login: string,
  senha: string,
  captcha?: { id: string; resposta: string },
): Promise<{
  ok: boolean;
  mensagemErro?: string;
  captchaObrigatorio?: boolean;
  captcha?: { id: string; pergunta: string };
  /** Resposta 409 — abrir fluxo de confirmação (`login-confirm`), como na página de login. */
  conflitoSessaoAtiva?: boolean;
  mensagemConflitoSessao?: string;
}> {
  try {
    const res = await fetch("/api/auth/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      credentials: "include",
      body: JSON.stringify({
        email: login,
        senha,
        ...(captcha
          ? { captcha_id: captcha.id, captcha_resposta: captcha.resposta }
          : {}),
      }),
    });
    const data = (await res.json().catch(() => ({}))) as RespostaLogin;
    if (res.status === 409) {
      return {
        ok: false,
        conflitoSessaoAtiva: true,
        mensagemConflitoSessao: mensagemConflitoSessao409(data),
      };
    }
    if (!res.ok) {
      if (
        data.captcha_obrigatorio === true &&
        data.captcha?.id &&
        data.captcha?.pergunta
      ) {
        return {
          ok: false,
          mensagemErro: mensagemErroReautenticacao(data),
          captchaObrigatorio: true,
          captcha: {
            id: data.captcha.id,
            pergunta: data.captcha.pergunta,
          },
        };
      }
      return { ok: false, mensagemErro: mensagemErroReautenticacao(data) };
    }
    return { ok: true };
  } catch {
    return {
      ok: false,
      mensagemErro: "Não foi possível reautenticar agora. Tente novamente.",
    };
  }
}

/**
 * Confirma substituir a sessão ativa (POST `login-confirm`), alinhado à página `/login`.
 */
export async function confirmarLoginSubstituindoSessaoAtiva(
  email: string,
  senha: string,
  captcha?: { id: string; resposta: string },
): Promise<{
  ok: boolean;
  mensagemErro?: string;
  captchaObrigatorio?: boolean;
  captcha?: { id: string; pergunta: string };
  avisoLicencaProximaExpiracao?: string;
}> {
  try {
    const res = await fetch("/api/auth/login-confirm", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      credentials: "include",
      body: JSON.stringify({
        email,
        senha,
        ...(captcha
          ? { captcha_id: captcha.id, captcha_resposta: captcha.resposta }
          : {}),
      }),
    });
    const data = (await res.json().catch(() => ({}))) as RespostaLoginConfirm;
    if (!res.ok) {
      if (
        data.captcha_obrigatorio === true &&
        data.captcha?.id &&
        data.captcha?.pergunta
      ) {
        return {
          ok: false,
          mensagemErro: mensagemErroReautenticacao(data),
          captchaObrigatorio: true,
          captcha: {
            id: data.captcha.id,
            pergunta: data.captcha.pergunta,
          },
        };
      }
      return { ok: false, mensagemErro: mensagemErroReautenticacao(data) };
    }
    const aviso =
      typeof data.aviso_licenca_proxima_expiracao === "string" &&
      data.aviso_licenca_proxima_expiracao.trim()
        ? data.aviso_licenca_proxima_expiracao.trim()
        : undefined;
    return { ok: true, avisoLicencaProximaExpiracao: aviso };
  } catch {
    return {
      ok: false,
      mensagemErro: "Não foi possível confirmar o login. Tente novamente.",
    };
  }
}
