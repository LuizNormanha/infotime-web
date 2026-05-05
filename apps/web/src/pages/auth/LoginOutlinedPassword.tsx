import { useState } from "react";
import { Password } from "primereact/password";

export type LoginOutlinedPasswordProps = {
  id: string;
  rotulo: string;
  valor: string;
  aoAlterar: (valor: string) => void;
  desabilitado?: boolean;
  nomeCampo?: string;
};

export function LoginOutlinedPassword({
  id,
  rotulo,
  valor,
  aoAlterar,
  desabilitado,
  nomeCampo,
}: LoginOutlinedPasswordProps) {
  const [emFoco, setEmFoco] = useState(false);
  const preenchido = Boolean(valor?.length);
  const placeholderVisivel = " ";
  const classeWrapper = `liga-campo-senha liga-login-campo-outlined${emFoco || preenchido ? " liga-login-campo-outlined--ativo" : ""}`;

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
