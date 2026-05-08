"use client";

import { useState } from "react";
import { InputText } from "primereact/inputtext";
import "./liga-campo-texto.css";

export type LigaCampoTextoProps = {
  id: string;
  rotulo: string;
  valor: string;
  aoAlterar: (valor: string) => void;
  tipo?: React.HTMLInputTypeAttribute;
  autoCompletar?: string;
  placeholder?: string;
  desabilitado?: boolean;
  nomeCampo?: string;
  /** Rótulo na borda (estilo “outlined”), p.ex. tela de login. */
  variant?: "padrao" | "outlined";
};

export function LigaCampoTexto({
  id,
  rotulo,
  valor,
  aoAlterar,
  tipo = "text",
  autoCompletar,
  placeholder,
  desabilitado,
  nomeCampo,
  variant = "padrao",
}: LigaCampoTextoProps) {
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
      ? `liga-campo-texto liga-login-campo-outlined${emFoco || preenchido ? " liga-login-campo-outlined--ativo" : ""}`
      : "liga-campo-texto";

  return (
    <div className={classeWrapper}>
      <label className="liga-rotulo-campo" htmlFor={id}>
        {rotulo}
      </label>
      <InputText
        id={id}
        name={nomeCampo ?? id}
        value={valor}
        type={tipo}
        autoComplete={autoCompletar}
        placeholder={placeholderVisivel}
        disabled={desabilitado}
        className="liga-input p-inputtext-lg"
        onChange={(e) => aoAlterar(e.target.value)}
        onFocus={() => setEmFoco(true)}
        onBlur={() => setEmFoco(false)}
      />
    </div>
  );
}
