"use client";

import { Suspense, useState } from "react";
import Link from "next/link";
import { useSearchParams } from "next/navigation";
import { useTranslations } from "next-intl";

import { LigaAlternarTema } from "@/components/ui/tema/LigaAlternarTema";
import { LigaBotao } from "@/components/ui/botoes/LigaBotao";
import { LigaCampoSenha } from "@/components/ui/inputs/LigaCampoSenha";
import { LigaCampoTexto } from "@/components/ui/inputs/LigaCampoTexto";
import { LigaDialogoSessao } from "@/components/ui/dialogo/LigaDialogoSessao";
import { LigaLink } from "@/components/ui/links/LigaLink";
import { LigaLoginMarcaInfotime } from "@/components/navegacao/login/LigaLoginMarcaInfotime";
import { LigaLogoLigaImagem } from "@/components/imagem/LigaLogoLigaImagem";
import { limparEstadoAbasHomeSessionStorage } from "@/components/navegacao/home/estado-abas-home-storage";
import { recarregarSessaoAtual } from "@/hooks/useSessaoAtual";

import "./liga-login.css";

const STORAGE_AVISO_LICENCA_POS_LOGIN = "liga.licenca.avisoPosLogin.v1";

/** Evita reutilização de estado React/Next na home após novo login (ex.: abas “fantasma”). */
function redirecionarAposLoginViaCargaCompleta(caminhoOuUrl: string) {
  if (typeof window === "undefined") return;
  const bruto = caminhoOuUrl.trim() || "/home";
  const url =
    bruto.startsWith("http://") || bruto.startsWith("https://")
      ? bruto
      : `${window.location.origin}${bruto.startsWith("/") ? bruto : `/${bruto}`}`;
  window.location.replace(url);
}

/** Nest pode devolver `message` string, array de strings ou objeto `{ mensagem }`. */
function mensagemErroApi(data: {
  message?: unknown;
  mensagem?: unknown;
}): string | undefined {
  if (typeof data.mensagem === "string" && data.mensagem.trim()) {
    return data.mensagem.trim();
  }
  const m = data.message;
  if (typeof m === "string" && m.trim()) return m.trim();
  if (Array.isArray(m) && m.length > 0 && typeof m[0] === "string") {
    return m[0].trim() || undefined;
  }
  if (m && typeof m === "object" && "mensagem" in m) {
    const sub = (m as { mensagem?: unknown }).mensagem;
    if (typeof sub === "string" && sub.trim()) return sub.trim();
  }
  return undefined;
}

function AvisoChecagemAuth() {
  const sp = useSearchParams();
  if (sp.get("auth_check") !== "unavailable") return null;
  return (
    <p role="status" className="liga-texto-aviso-auth">
      Não foi possível contatar o servidor de autenticação. Confirme se a API está
      no ar e tente atualizar a página — sua sessão não foi invalidada.
    </p>
  );
}

export default function TelaLogin() {
  const t = useTranslations("login");

  const [email, setEmail] = useState("");
  const [senha, setSenha] = useState("");
  const [erro, setErro] = useState<string | null>(null);
  const [carregando, setCarregando] = useState(false);
  const [modalAberto, setModalAberto] = useState(false);
  const [mensagemModal, setMensagemModal] = useState("");
  const [captcha, setCaptcha] = useState<{ id: string; pergunta: string } | null>(
    null,
  );
  const [captchaResposta, setCaptchaResposta] = useState("");

  async function tentarLogin(credenciais: { email: string; senha: string }) {
    setErro(null);
    setCarregando(true);

    try {
      const res = await fetch("/api/auth/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        credentials: "include",
        body: JSON.stringify({
          ...credenciais,
          ...(captcha
            ? { captcha_id: captcha.id, captcha_resposta: captchaResposta }
            : {}),
        }),
      });
      const data = (await res.json()) as {
        redirect?: string;
        refresh_token?: string;
        aviso_licenca_proxima_expiracao?: string;
        message?: string | string[];
        mensagem?: string;
        captcha_obrigatorio?: boolean;
        captcha?: { id?: string; pergunta?: string };
      };

      if (res.status === 409) {
        setMensagemModal(
          data.mensagem ?? t("sessaoAtivaDetectada"),
        );
        setModalAberto(true);
        return;
      }

      if (!res.ok) {
        if (
          data.captcha_obrigatorio === true &&
          data.captcha?.id &&
          data.captcha?.pergunta
        ) {
          setCaptcha({
            id: data.captcha.id,
            pergunta: data.captcha.pergunta,
          });
          setCaptchaResposta("");
        }
        setErro(mensagemErroApi(data) ?? t("erroCredenciais"));
        return;
      }

      setCaptcha(null);
      setCaptchaResposta("");
      if (
        typeof data.aviso_licenca_proxima_expiracao === "string" &&
        data.aviso_licenca_proxima_expiracao.trim()
      ) {
        sessionStorage.setItem(
          STORAGE_AVISO_LICENCA_POS_LOGIN,
          data.aviso_licenca_proxima_expiracao.trim(),
        );
      }
      recarregarSessaoAtual();
      limparEstadoAbasHomeSessionStorage();
      redirecionarAposLoginViaCargaCompleta(data.redirect ?? "/home");
      return;
    } catch (err: unknown) {
      console.error("[login] Erro inesperado ao fazer login:", err);
      setErro(t("erroInesperado"));
    } finally {
      setCarregando(false);
    }
  }

  async function confirmarNovasSessao() {
    setModalAberto(false);
    setErro(null);
    setCarregando(true);
    try {
      const res = await fetch("/api/auth/login-confirm", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        credentials: "include",
        body: JSON.stringify({
          email,
          senha,
          ...(captcha
            ? { captcha_id: captcha.id, captcha_resposta: captchaResposta }
            : {}),
        }),
      });
      const dataConfirm = (await res.json().catch(() => ({}))) as {
        message?: unknown;
        mensagem?: unknown;
        aviso_licenca_proxima_expiracao?: string;
        captcha_obrigatorio?: boolean;
        captcha?: { id?: string; pergunta?: string };
      };
      if (!res.ok) {
        if (
          dataConfirm.captcha_obrigatorio === true &&
          dataConfirm.captcha?.id &&
          dataConfirm.captcha?.pergunta
        ) {
          setCaptcha({
            id: dataConfirm.captcha.id,
            pergunta: dataConfirm.captcha.pergunta,
          });
          setCaptchaResposta("");
        }
        setErro(
          mensagemErroApi(dataConfirm) ?? t("erroConfirmarSessao"),
        );
        return;
      }
      setCaptcha(null);
      setCaptchaResposta("");
      if (
        typeof dataConfirm.aviso_licenca_proxima_expiracao === "string" &&
        dataConfirm.aviso_licenca_proxima_expiracao.trim()
      ) {
        sessionStorage.setItem(
          STORAGE_AVISO_LICENCA_POS_LOGIN,
          dataConfirm.aviso_licenca_proxima_expiracao.trim(),
        );
      }
      recarregarSessaoAtual();
      limparEstadoAbasHomeSessionStorage();
      redirecionarAposLoginViaCargaCompleta("/home");
      return;
    } catch {
      setErro(t("erroConfirmarSessao"));
    } finally {
      setCarregando(false);
    }
  }

  return (
    <div className="liga-tela-login">
      <div className="liga-tela-login-conteudo">
        <div className="liga-login-cartao">
          <div className="liga-login-mockup">
            <div className="liga-login-mockup-esq">
              <LigaLogoLigaImagem />
              <h1 className="liga-login-titulo-pagina">{t("tituloPagina")}</h1>
            </div>
            <div className="liga-login-mockup-dir">
              <div className="liga-login-mockup-infotime">
                <LigaLoginMarcaInfotime />
              </div>
              <form
                className="liga-form-login liga-login-mockup-form"
                onSubmit={(e) => {
                  e.preventDefault();
                  void tentarLogin({ email, senha });
                }}
                noValidate
              >
                <LigaCampoTexto
                  id="campo-login-email"
                  nomeCampo="email"
                  rotulo={t("emailLabel")}
                  placeholder={t("emailPlaceholder")}
                  valor={email}
                  aoAlterar={setEmail}
                  tipo="email"
                  autoCompletar="email"
                  variant="outlined"
                />

                <LigaCampoSenha
                  id="campo-login-senha"
                  nomeCampo="senha"
                  rotulo={t("senhaLabel")}
                  placeholder={t("senhaPlaceholder")}
                  valor={senha}
                  aoAlterar={setSenha}
                  variant="outlined"
                />

                {captcha ? (
                  <LigaCampoTexto
                    id="campo-login-captcha"
                    nomeCampo="captcha_resposta"
                    rotulo={captcha.pergunta}
                    placeholder="Digite o resultado"
                    valor={captchaResposta}
                    aoAlterar={setCaptchaResposta}
                    tipo="text"
                    autoCompletar="off"
                    variant="outlined"
                  />
                ) : null}

                <Suspense fallback={null}>
                  <AvisoChecagemAuth />
                </Suspense>

                {erro ? (
                  <p role="alert" className="liga-texto-erro">
                    {erro}
                  </p>
                ) : null}

                <div className="liga-login-barra-acoes">
                  <LigaBotao
                    type="submit"
                    className="liga-login-botao-primario"
                    label={carregando ? t("entrando") : t("entrar")}
                    disabled={carregando}
                    loading={carregando}
                    aria-label={t("entrarAcessibilidade")}
                  />
                  <LigaLink
                    texto={t("recuperarSenha")}
                    href="/recuperar-senha"
                    className="liga-login-link-recuperar"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <footer className="liga-tela-login-rodape-pagina">
        <span className="liga-login-idioma">{t("rodape.idioma")}</span>
        <div className="liga-login-rodape-dir">
          <Link className="liga-login-rodape-link" href="#">
            {t("rodape.ajuda")}
          </Link>
          <Link className="liga-login-rodape-link" href="#">
            {t("rodape.privacidade")}
          </Link>
          <Link className="liga-login-rodape-link" href="#">
            {t("rodape.termos")}
          </Link>
          <LigaAlternarTema />
        </div>
      </footer>

      <LigaDialogoSessao
        aberto={modalAberto}
        titulo={t("modal.titulo")}
        mensagem={mensagemModal}
        rotuloCancelar={t("modal.cancelar")}
        rotuloConfirmar={t("modal.continuar")}
        aoFechar={() => setModalAberto(false)}
        aoConfirmar={() => void confirmarNovasSessao()}
      />
    </div>
  );
}
