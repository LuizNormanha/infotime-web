import { useState } from "react";
import { InputText } from "primereact/inputtext";

export type LoginOutlinedTextProps = {
  id: string;
  rotulo: string;
  valor: string;
  aoAlterar: (valor: string) => void;
  tipo?: React.HTMLInputTypeAttribute;
  autoCompletar?: string;
  desabilitado?: boolean;
  nomeCampo?: string;
};

export function LoginOutlinedText({
  id,
  rotulo,
  valor,
  aoAlterar,
  tipo = "text",
  autoCompletar,
  desabilitado,
  nomeCampo,
}: LoginOutlinedTextProps) {
  const [emFoco, setEmFoco] = useState(false);
  const preenchido = Boolean(valor?.length);
  const placeholderVisivel = " ";
  const classeWrapper = `liga-campo-texto liga-login-campo-outlined${emFoco || preenchido ? " liga-login-campo-outlined--ativo" : ""}`;

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
