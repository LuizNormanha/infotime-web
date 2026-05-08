"use client";

import { useState } from "react";
import { Password } from "primereact/password";
import "./liga-campo-senha.css";

export type LigaCampoSenhaProps = {
  id: string;
  rotulo: string;
  valor: string;
  aoAlterar: (valor: string) => void;
  placeholder?: string;
  desabilitado?: boolean;
  nomeCampo?: string;
  variant?: "padrao" | "outlined";
};

export function LigaCampoSenha({
  id,
  rotulo,
  valor,
  aoAlterar,
  placeholder,
  desabilitado,
  nomeCampo,
  variant = "padrao",
}: LigaCampoSenhaProps) {
  const [emFoco, setEmFoco] = useState(false);
  const preenchido = Boolean(valor?.length);
  const placeholderVisivel =
    variant === "outlined"
      ? " "
      : !emFoco && !preenchido
        ? placeholder
        : "";
  const classeWrapper =
    variant === "outlined"
      ? `liga-campo-senha liga-login-campo-outlined${emFoco || preenchido ? " liga-login-campo-outlined--ativo" : ""}`
      : "liga-campo-senha";

  return (
    <div className={classeWrapper}>
      <label className="liga-rotulo-campo" htmlFor={id}>
        {rotulo}
      </label>
      <Password
        id={id}
        name={nomeCampo ?? id}
        value={valor}
        feedback={false}
        toggleMask
        placeholder={placeholderVisivel}
        disabled={desabilitado}
        inputClassName="liga-input liga-input-senha p-inputtext-lg"
        className="liga-password-wrapper"
        onChange={(e) => aoAlterar(e.target.value)}
        onFocus={() => setEmFoco(true)}
        onBlur={() => setEmFoco(false)}
      />
    </div>
  );
}
