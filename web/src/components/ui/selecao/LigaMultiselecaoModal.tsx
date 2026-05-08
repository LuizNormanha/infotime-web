"use client";

import { useMemo, useState } from "react";
import { Button } from "primereact/button";
import { Chip } from "primereact/chip";
import { Dialog } from "primereact/dialog";
import { PickList, type PickListChangeEvent } from "primereact/picklist";

export type LigaOpcaoSelecao = {
  value: string;
  label: string;
};

type LigaMultiselecaoModalProps = {
  value: string[];
  options: LigaOpcaoSelecao[];
  onChange: (value: string[]) => void;
  tituloModal: string;
  tituloNaoSelecionados: string;
  tituloSelecionados: string;
  placeholderFiltro: string;
  rotuloCancelar: string;
  rotuloConfirmar: string;
  rotuloNenhumSelecionado: string;
  disabled?: boolean;
};

export function LigaMultiselecaoModal({
  value,
  options,
  onChange,
  tituloModal,
  tituloNaoSelecionados,
  tituloSelecionados,
  placeholderFiltro,
  rotuloCancelar,
  rotuloConfirmar,
  rotuloNenhumSelecionado,
  disabled = false,
}: LigaMultiselecaoModalProps) {
  const [aberto, setAberto] = useState(false);
  const [source, setSource] = useState<LigaOpcaoSelecao[]>([]);
  const [target, setTarget] = useState<LigaOpcaoSelecao[]>([]);

  const mapaOpcoes = useMemo(
    () => new Map(options.map((item) => [item.value, item.label])),
    [options],
  );

  const itensSelecionados = useMemo(
    () =>
      value.map((id) => ({
        value: id,
        label: mapaOpcoes.get(id) ?? id,
      })),
    [value, mapaOpcoes],
  );

  function abrirModal() {
    const selecionados = new Set(value);
    setTarget(options.filter((item) => selecionados.has(item.value)));
    setSource(options.filter((item) => !selecionados.has(item.value)));
    setAberto(true);
  }

  return (
    <div className="liga-multiselecao-modal">
      <button
        type="button"
        className="liga-multiselecao-modal-input"
        onClick={abrirModal}
        disabled={disabled}
        aria-label={tituloModal}
      >
        <div className="liga-multiselecao-modal-chips">
          {itensSelecionados.length === 0 ? (
            <span className="liga-multiselecao-modal-placeholder">{rotuloNenhumSelecionado}</span>
          ) : (
            itensSelecionados.map((item) => (
              <Chip
                key={item.value}
                label={item.label}
                removable={!disabled}
                onRemove={() => {
                  onChange(value.filter((id) => id !== item.value));
                  return true;
                }}
              />
            ))
          )}
        </div>
        <i className="pi pi-list" aria-hidden />
      </button>

      <div className="liga-multiselecao-modal-acao-secundaria">
        <Button
          type="button"
          icon="pi pi-list"
          outlined
          disabled={disabled}
          onClick={abrirModal}
          aria-label={tituloModal}
        />
      </div>

      <Dialog
        visible={aberto}
        onHide={() => setAberto(false)}
        header={tituloModal}
        style={{ width: "80vw", maxWidth: "1100px" }}
      >
        <PickList
          source={source}
          target={target}
          dataKey="value"
          sourceHeader={tituloNaoSelecionados}
          targetHeader={tituloSelecionados}
          sourceStyle={{ minHeight: "20rem" }}
          targetStyle={{ minHeight: "20rem" }}
          itemTemplate={(item) => <span>{item.label}</span>}
          filter
          filterBy="label"
          sourceFilterPlaceholder={placeholderFiltro}
          targetFilterPlaceholder={placeholderFiltro}
          onChange={(e: PickListChangeEvent) => {
            setSource(e.source as LigaOpcaoSelecao[]);
            setTarget(e.target as LigaOpcaoSelecao[]);
          }}
        />
        <div className="liga-multiselecao-modal-acoes">
          <Button
            type="button"
            outlined
            label={rotuloCancelar}
            onClick={() => setAberto(false)}
          />
          <Button
            type="button"
            label={rotuloConfirmar}
            onClick={() => {
              onChange(target.map((item) => item.value));
              setAberto(false);
            }}
          />
        </div>
      </Dialog>
    </div>
  );
}
