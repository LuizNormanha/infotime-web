"use client";

import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import "./liga-dialogo-sessao.css";

export type LigaDialogoSessaoProps = {
  aberto: boolean;
  titulo: string;
  mensagem: string;
  rotuloCancelar: string;
  rotuloConfirmar: string;
  aoFechar: () => void;
  aoConfirmar: () => void;
};

export function LigaDialogoSessao({
  aberto,
  titulo,
  mensagem,
  rotuloCancelar,
  rotuloConfirmar,
  aoFechar,
  aoConfirmar,
}: LigaDialogoSessaoProps) {
  const rodape = (
    <div className="liga-dialogo-sessao-rodape">
      <Button
        type="button"
        label={rotuloCancelar}
        className="p-button-text liga-dialogo-botao-secundario"
        onClick={aoFechar}
      />
      <Button
        type="button"
        label={rotuloConfirmar}
        className="liga-botao liga-dialogo-botao-primario"
        onClick={aoConfirmar}
      />
    </div>
  );

  return (
    <Dialog
      className="liga-dialogo-sessao"
      header={titulo}
      visible={aberto}
      onHide={aoFechar}
      footer={rodape}
      modal
      dismissableMask={false}
      draggable={false}
      resizable={false}
      blockScroll
    >
      <p className="liga-dialogo-sessao-mensagem">{mensagem}</p>
    </Dialog>
  );
}
