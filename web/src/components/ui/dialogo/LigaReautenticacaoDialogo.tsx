"use client";

import { Dialog } from "primereact/dialog";
import { LigaCampoTexto } from "@/components/ui/inputs/LigaCampoTexto";
import { LigaCampoSenha } from "@/components/ui/inputs/LigaCampoSenha";
import { LigaBotao } from "@/components/ui/botoes/LigaBotao";
import { LigaLoginMarcaInfotime } from "@/components/navegacao/login/LigaLoginMarcaInfotime";
import { LigaLogoLigaImagem } from "@/components/imagem/LigaLogoLigaImagem";
import "@/app/login/liga-login.css";

type Props = {
  aberta: boolean;
  login: string;
  senha: string;
  carregando: boolean;
  erro: string | null;
  captcha?: { id: string; pergunta: string } | null;
  captchaResposta?: string;
  aoAlterarLogin: (valor: string) => void;
  aoAlterarSenha: (valor: string) => void;
  aoAlterarCaptchaResposta?: (valor: string) => void;
  aoConfirmar: () => void | Promise<void>;
  aoCancelar: () => void;
  titulo?: string;
  mensagem?: string;
  textoBotaoConfirmar?: string;
  textoBotaoConfirmando?: string;
  textoBotaoCancelar?: string;
};

export function LigaReautenticacaoDialogo({
  aberta,
  login,
  senha,
  carregando,
  erro,
  captcha = null,
  captchaResposta = "",
  aoAlterarLogin,
  aoAlterarSenha,
  aoAlterarCaptchaResposta,
  aoConfirmar,
  aoCancelar,
  titulo = "Sessão expirada",
  mensagem = "A sessão expirou. Faça login para continuar sem perder o contexto atual.",
  textoBotaoConfirmar = "Confirmar",
  textoBotaoConfirmando = "Reautenticando...",
  textoBotaoCancelar = "Cancelar",
}: Props) {
  return (
    <Dialog
      header={undefined}
      visible={aberta}
      onHide={aoCancelar}
      modal
      draggable={false}
      resizable={false}
      dismissableMask={false}
      closeOnEscape={!carregando}
      style={{ width: "min(1180px, 98vw)" }}
    >
      <div className="liga-tela-login--embutido-coletor w-full">
        <div className="liga-login-cartao">
          <div className="liga-login-mockup">
            <div className="liga-login-mockup-esq">
              <LigaLogoLigaImagem />
              <h1 className="liga-login-titulo-pagina">{titulo}</h1>
            </div>
            <div className="liga-login-mockup-dir">
              <div className="liga-login-mockup-infotime">
                <LigaLoginMarcaInfotime />
              </div>
              <form
                className="liga-form-login liga-login-mockup-form"
                onSubmit={(e) => {
                  e.preventDefault();
                  void aoConfirmar();
                }}
                noValidate
              >
                <p style={{ margin: 0 }}>{mensagem}</p>
                <LigaCampoTexto
                  id="reauth-login"
                  nomeCampo="login"
                  rotulo="E-mail"
                  placeholder="usuario@dominio.com"
                  valor={login}
                  aoAlterar={aoAlterarLogin}
                  tipo="email"
                  autoCompletar="username"
                  variant="outlined"
                />
                <LigaCampoSenha
                  id="reauth-senha"
                  nomeCampo="senha"
                  rotulo="Senha"
                  placeholder="Digite sua senha"
                  valor={senha}
                  aoAlterar={aoAlterarSenha}
                  variant="outlined"
                />
                {captcha ? (
                  <LigaCampoTexto
                    id="reauth-captcha"
                    nomeCampo="captcha"
                    rotulo={captcha.pergunta}
                    placeholder="Digite o resultado"
                    valor={captchaResposta}
                    aoAlterar={aoAlterarCaptchaResposta ?? (() => undefined)}
                    tipo="text"
                    autoCompletar="off"
                    variant="outlined"
                  />
                ) : null}
                {erro ? (
                  <span style={{ color: "var(--red-500, #dc2626)" }}>{erro}</span>
                ) : null}

                <div className="liga-login-barra-acoes">
                  <LigaBotao
                    type="submit"
                    className="liga-login-botao-primario"
                    label={carregando ? textoBotaoConfirmando : textoBotaoConfirmar}
                    disabled={carregando || !login.trim() || !senha.trim()}
                    loading={carregando}
                    aria-label={textoBotaoConfirmar}
                  />
                  <LigaBotao
                    type="button"
                    outlined
                    className="liga-login-barra-acoes--coletor-segundo-botao"
                    label={textoBotaoCancelar}
                    disabled={carregando}
                    onClick={aoCancelar}
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </Dialog>
  );
}
