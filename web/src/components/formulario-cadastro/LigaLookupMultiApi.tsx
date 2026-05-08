"use client";

import { useEffect, useMemo, useState } from "react";
import { MultiSelect } from "primereact/multiselect";

import "./liga-lookup-multi-api.css";

import {
  aplicarLimiteStringAgregada,
  parseListaAgregada,
  serializarListaAgregada,
} from "./liga-lookup-multi-agregada";
import {
  mapCatalogoParaOpcoes,
  type LigaLookupCatalogoTipo,
  type LigaLookupMultiOpcao,
} from "./liga-lookup-multi-api-mappers";

export type { LigaLookupMultiOpcao, LigaLookupCatalogoTipo };

export type LigaLookupMultiApiProps = {
  idInput?: string;
  value: string | null;
  onChange: (valor: string | null) => void;
  disabled: boolean;
  placeholder: string;
  ariaLabel: string;
  invalid?: boolean;
  campoChave: string;
  endpoint: string;
  catalogo: LigaLookupCatalogoTipo;
  listaMaxLen?: number;
  mensagens: {
    carregando: string;
    vazio: string;
    filtroVazio: string;
  };
};

export function LigaLookupMultiApi({
  idInput,
  value,
  onChange,
  disabled,
  placeholder,
  ariaLabel,
  invalid,
  campoChave,
  endpoint,
  catalogo,
  listaMaxLen = 4000,
  mensagens,
}: LigaLookupMultiApiProps) {
  const [opcoes, setOpcoes] = useState<LigaLookupMultiOpcao[]>([]);
  const [carregando, setCarregando] = useState(true);

  const valorMultiselect = useMemo(() => parseListaAgregada(value), [value]);

  useEffect(() => {
    let cancel = false;
    void (async () => {
      setCarregando(true);
      try {
        const res = await fetch(endpoint, {
          credentials: "include",
          cache: "no-store",
        });
        if (!res.ok) return;
        const body = (await res.json()) as { dados?: unknown[] };
        const dados = body.dados;
        if (!cancel && dados) setOpcoes(mapCatalogoParaOpcoes(catalogo, dados));
      } catch {
        /* catálogo opcional */
      } finally {
        if (!cancel) setCarregando(false);
      }
    })();
    return () => {
      cancel = true;
    };
  }, [endpoint, catalogo]);

  return (
    <MultiSelect
      inputId={idInput}
      value={valorMultiselect}
      options={opcoes}
      optionLabel="label"
      optionValue="value"
      onChange={(e) => {
        const bruto = (e.value as string[] | null | undefined) ?? [];
        onChange(
          aplicarLimiteStringAgregada(serializarListaAgregada(bruto), listaMaxLen),
        );
      }}
      display="chip"
      filter
      filterBy="label,value,meta"
      filterMatchMode="contains"
      showClear
      maxSelectedLabels={4}
      className="w-full liga-lookup-multi-api-ms"
      panelClassName="liga-lookup-multi-api-panel"
      disabled={disabled}
      loading={carregando}
      placeholder={placeholder}
      aria-label={ariaLabel}
      invalid={invalid}
      data-campo-chave={campoChave}
      emptyFilterMessage={mensagens.filtroVazio}
      emptyMessage={carregando ? mensagens.carregando : mensagens.vazio}
      itemTemplate={(op: LigaLookupMultiOpcao) => (
        <div className="liga-lookup-multi-api-item">
          <span className="liga-lookup-multi-api-item__titulo">{op.label}</span>
          <span className="liga-lookup-multi-api-item__meta">{op.meta}</span>
        </div>
      )}
    />
  );
}
