import { useEffect, useState } from "react";
import { Controller, useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { z } from "zod";
import { Button } from "primereact/button";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../../shared/auth/AuthProvider.js";
import { API_V1_PREFIX } from "../../shared/api/constants.js";
import { httpJson } from "../../shared/api/httpClient.js";
import { LoginMarcaInfotime } from "./LoginMarcaInfotime.js";
import { LoginOutlinedText } from "./LoginOutlinedText.js";
import { LoginOutlinedPassword } from "./LoginOutlinedPassword.js";

import "./login-liga-theme-vars.css";
import "./liga-login-layout.css";
import "./liga-login-logo.css";
import "./liga-login-fields.css";
import "./liga-login-alternar-tema.css";
import {
  applyAppThemeToDocument,
  persistAppTheme,
  readStoredAppTheme,
} from "../../shared/theme/appTheme.js";

const schema = z.object({
  login: z.string().trim().min(1),
  senha: z.string().min(1),
  idTenacidade: z.string().trim().regex(/^\d+$/),
});

type FormValues = z.infer<typeof schema>;

export function LoginPage() {
  const { login } = useAuth();
  const navigate = useNavigate();
  const [tema, setTema] = useState(() => readStoredAppTheme());

  const form = useForm<FormValues>({
    resolver: zodResolver(schema),
    defaultValues: { login: "", senha: "", idTenacidade: "" },
  });

  const onSubmit = form.handleSubmit(async (values) => {
    try {
      const res = await httpJson<{ accessToken: string }>(`${API_V1_PREFIX}/auth/login`, {
        method: "POST",
        body: JSON.stringify({
          login: values.login.trim(),
          senha: values.senha,
          idTenacidade: Number(values.idTenacidade),
        }),
      });
      login(res.accessToken, values.idTenacidade, values.login.trim());
      navigate("/");
    } catch (e) {
      const msg = e instanceof Error ? e.message : "Falha no login";
      form.setError("root", { message: msg });
    }
  });

  useEffect(() => {
    applyAppThemeToDocument(tema);
  }, [tema]);

  function alternarTema() {
    setTema((atual) => {
      const next = atual === "light" ? "dark" : "light";
      persistAppTheme(next);
      return next;
    });
  }

  const entrando = form.formState.isSubmitting;

  return (
    <div className="liga-tela-login" data-theme={tema}>
      <div className="liga-tela-login-conteudo">
        <div className="liga-login-cartao">
          <div className="liga-login-mockup">
            <div className="liga-login-mockup-esq">
              <div className="liga-logo-liga-imagem">
                <img
                  src={`${import.meta.env.BASE_URL}logo-liga.png`}
                  alt="Liga"
                  className="liga-logo-liga-imagem__img"
                  width={250}
                  height={250}
                />
              </div>
              <h1 className="liga-login-titulo-pagina">Fazer login</h1>
            </div>
            <div className="liga-login-mockup-dir">
              <div className="liga-login-mockup-infotime">
                <LoginMarcaInfotime />
              </div>
              <form className="liga-form-login liga-login-mockup-form" onSubmit={onSubmit} noValidate>
                <Controller
                  name="idTenacidade"
                  control={form.control}
                  render={({ field }) => (
                    <LoginOutlinedText
                      id="campo-login-tenant"
                      nomeCampo="idTenacidade"
                      rotulo="id_tenacidade"
                      valor={field.value}
                      aoAlterar={field.onChange}
                      tipo="text"
                      autoCompletar="off"
                    />
                  )}
                />
                <Controller
                  name="login"
                  control={form.control}
                  render={({ field }) => (
                    <LoginOutlinedText
                      id="campo-login-usuario"
                      nomeCampo="login"
                      rotulo="Login"
                      valor={field.value}
                      aoAlterar={field.onChange}
                      tipo="text"
                      autoCompletar="username"
                    />
                  )}
                />
                <Controller
                  name="senha"
                  control={form.control}
                  render={({ field }) => (
                    <LoginOutlinedPassword
                      id="campo-login-senha"
                      nomeCampo="senha"
                      rotulo="Senha"
                      valor={field.value}
                      aoAlterar={field.onChange}
                    />
                  )}
                />

                {form.formState.errors.root ? (
                  <p role="alert" className="liga-texto-erro">
                    {(form.formState.errors.root as { message?: string }).message ?? "Erro"}
                  </p>
                ) : null}

                <div className="liga-login-barra-acoes">
                  <Button
                    type="submit"
                    className="liga-login-botao-primario"
                    label={entrando ? "Entrando…" : "Entrar"}
                    disabled={entrando}
                    loading={entrando}
                    aria-label="Entrar"
                  />
                  <Link className="liga-login-link-recuperar" to="/recuperar-senha">
                    Recuperar senha
                  </Link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <footer className="liga-tela-login-rodape-pagina">
        <span className="liga-login-idioma">Português (BR)</span>
        <div className="liga-login-rodape-dir">
          <Link className="liga-login-rodape-link" to="/ajuda">
            Ajuda
          </Link>
          <Link className="liga-login-rodape-link" to="/privacidade">
            Privacidade
          </Link>
          <Link className="liga-login-rodape-link" to="/termos">
            Termos
          </Link>
          <Button
            type="button"
            text
            className="liga-alternar-tema"
            onClick={alternarTema}
            icon={`pi ${tema === "light" ? "pi-moon" : "pi-sun"}`}
            label={tema === "light" ? "Modo escuro" : "Modo claro"}
            aria-label={tema === "light" ? "Ativar modo escuro" : "Ativar modo claro"}
          />
        </div>
      </footer>
    </div>
  );
}
