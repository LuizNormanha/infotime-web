"use client";

import { useState } from "react";
import { Button } from "primereact/button";
import { Dialog } from "primereact/dialog";
import { MultiSelect, type MultiSelectChangeEvent } from "primereact/multiselect";
import { PickList, type PickListChangeEvent } from "primereact/picklist";

type LigaOpcaoCatalogo = { value: string; label: string };

type LigaMultiSelectComModalListaProps = {
  value: string[];
  options: LigaOpcaoCatalogo[];
  onChange: (value: string[]) => void;
  tituloModal: string;
  tituloNaoSelecionados: string;
  tituloSelecionados: string;
  placeholderFiltro: string;
  rotuloCancelar: string;
  rotuloConfirmar: string;
  /** Placeholder do MultiSelect (campo com filtro e checkboxes no painel). */
  placeholderMultiSelect: string;
  disabled?: boolean;
};

/**
 * MultiSelect com filtro + chips no campo (painel com checkboxes ao digitar)
 * e botão de lista (sandwich) **dentro** do campo, à direita, abrindo o modal PickList.
 */
export function LigaMultiSelectComModalLista({
  value,
  options,
  onChange,
  tituloModal,
  tituloNaoSelecionados,
  tituloSelecionados,
  placeholderFiltro,
  rotuloCancelar,
  rotuloConfirmar,
  placeholderMultiSelect,
  disabled = false,
}: LigaMultiSelectComModalListaProps) {
  const [aberto, setAberto] = useState(false);
  const [source, setSource] = useState<LigaOpcaoCatalogo[]>([]);
  const [target, setTarget] = useState<LigaOpcaoCatalogo[]>([]);

  function abrirModal() {
    const selecionados = new Set(value);
    setTarget(options.filter((item) => selecionados.has(item.value)));
    setSource(options.filter((item) => !selecionados.has(item.value)));
    setAberto(true);
  }

  function aoMultiSelectChange(e: MultiSelectChangeEvent) {
    onChange((e.value as string[]) ?? []);
  }

  function aoConfirmarPicklist() {
    onChange(target.map((item) => item.value));
    setAberto(false);
  }

  return (
    <div className="liga-multiselecao-com-multiselect">
      <MultiSelect
        value={value}
        options={options}
        optionLabel="label"
        optionValue="value"
        onChange={aoMultiSelectChange}
        display="chip"
        filter
        filterPlaceholder={placeholderFiltro}
        showSelectAll
        className="w-full p-inputtext-sm"
        placeholder={placeholderMultiSelect}
        disabled={disabled}
      />
      <button
        type="button"
        className="liga-multiselecao-com-multiselect__sandwich"
        onClick={(e) => {
          e.preventDefault();
          e.stopPropagation();
          abrirModal();
        }}
        onPointerDown={(e) => {
          e.stopPropagation();
        }}
        disabled={disabled}
        aria-label={tituloModal}
      >
        <i className="pi pi-list" aria-hidden />
      </button>

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
            setSource(e.source as LigaOpcaoCatalogo[]);
            setTarget(e.target as LigaOpcaoCatalogo[]);
          }}
        />
        <div className="liga-multiselecao-modal-acoes">
          <Button
            type="button"
            outlined
            label={rotuloCancelar}
            onClick={() => setAberto(false)}
          />
          <Button type="button" label={rotuloConfirmar} onClick={aoConfirmarPicklist} />
        </div>
      </Dialog>
    </div>
  );
}
