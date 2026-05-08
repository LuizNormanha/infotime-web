"use client";

import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import "./liga-mensagem-pop-up.css";

export type LigaMensagemPopUpProps = {
  aberto: boolean;
  titulo: string;
  mensagem: string;
  rotuloCancelar: string;
  rotuloConfirmar: string;
  aoFechar: () => void;
  aoConfirmar: () => void;
};

export function LigaMensagemPopUp({
  aberto,
  titulo,
  mensagem,
  rotuloCancelar,
  rotuloConfirmar,
  aoFechar,
  aoConfirmar,
}: LigaMensagemPopUpProps) {
  const rodape = (
    <div className="liga-mensagem-pop-up-rodape">
      <Button
        type="button"
        label={rotuloCancelar}
        className="p-button-outlined p-button-secondary liga-mensagem-pop-up-botao-secundario"
        onClick={aoFechar}
      />
      <Button
        type="button"
        label={rotuloConfirmar}
        className="liga-botao liga-mensagem-pop-up-botao-primario"
        onClick={aoConfirmar}
      />
    </div>
  );

  return (
    <Dialog
      className="liga-mensagem-pop-up"
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
      <p className="liga-mensagem-pop-up-texto">{mensagem}</p>
    </Dialog>
  );
}
