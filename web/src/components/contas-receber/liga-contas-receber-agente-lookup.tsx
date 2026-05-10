"use client";

import { useCallback, useEffect, useRef, useState } from "react";
import {
  AutoComplete,
  type AutoCompleteCompleteEvent,
  type AutoCompleteSelectEvent,
} from "primereact/autocomplete";

import { montarSearchParamsListagemPadrao } from "@/lib/listagem-servidor-query";

type SugestaoAgente = { id: string; label: string };

function rotuloListaCliente(row: Record<string, unknown>): string {
  const id = String(row.idCliente ?? row.id_cliente ?? "").trim();
  const nf = String(row.nomeFantasia ?? row.nome_fantasia ?? "").trim();
  const rz = String(row.razaoSocial ?? row.razao_social ?? "").trim();
  const doc = String(row.cnpj ?? "").trim();
  const nome = nf || rz || "—";
  const corpo = doc ? `${nome} (${doc})` : nome;
  return id ? `#${id} — ${corpo}` : corpo;
}

function rotuloListaFornecedor(row: Record<string, unknown>): string {
  const id = String(row.idFornecedor ?? row.id_fornecedor ?? "").trim();
  const nf = String(row.nomeFantasia ?? row.nome_fantasia ?? "").trim();
  const rz = String(row.razaoSocial ?? row.razao_social ?? "").trim();
  const doc = String(row.cnpj ?? "").trim();
  const nome = nf || rz || "—";
  const corpo = doc ? `${nome} (${doc})` : nome;
  return id ? `#${id} — ${corpo}` : corpo;
}

function rotuloListaColaborador(row: Record<string, unknown>): string {
  const id = String(row.idColaborador ?? row.id_colaborador ?? "").trim();
  const nome = String(row.nome ?? "").trim() || "—";
  const doc = String(row.cpf ?? "").trim();
  const corpo = doc ? `${nome} (${doc})` : nome;
  return id ? `#${id} — ${corpo}` : corpo;
}

async function buscarClientes(
  query: string,
  signal: AbortSignal,
): Promise<SugestaoAgente[]> {
  const q = query.trim();
  if (!q) return [];
  const soDigitos = /^\d+$/.test(q);
  const params = montarSearchParamsListagemPadrao({
    cargaInicial: "primeiraPagina",
    pagina: 0,
    tamanhoPagina: 20,
    termoBusca: q,
    campoPesquisa: soDigitos ? "idCliente" : "nomeFantasia",
  });
  const res = await fetch(`/api/clientes?${params.toString()}`, {
    signal,
    cache: "no-store",
  });
  if (!res.ok) return [];
  const j = (await res.json()) as { dados?: Record<string, unknown>[] };
  return (j.dados ?? [])
    .map((row) => {
      const id = String(row.idCliente ?? row.id_cliente ?? "").trim();
      if (!id) return null;
      return { id, label: rotuloListaCliente(row) };
    })
    .filter((x): x is SugestaoAgente => x != null);
}

async function buscarFornecedores(
  query: string,
  signal: AbortSignal,
): Promise<SugestaoAgente[]> {
  const q = query.trim();
  if (!q) return [];
  const soDigitos = /^\d+$/.test(q);
  const params = montarSearchParamsListagemPadrao({
    cargaInicial: "primeiraPagina",
    pagina: 0,
    tamanhoPagina: 20,
    termoBusca: q,
    campoPesquisa: soDigitos ? "idFornecedor" : "nomeFantasia",
  });
  const res = await fetch(`/api/fornecedores?${params.toString()}`, {
    signal,
    cache: "no-store",
  });
  if (!res.ok) return [];
  const j = (await res.json()) as { dados?: Record<string, unknown>[] };
  return (j.dados ?? [])
    .map((row) => {
      const id = String(row.idFornecedor ?? row.id_fornecedor ?? "").trim();
      if (!id) return null;
      return { id, label: rotuloListaFornecedor(row) };
    })
    .filter((x): x is SugestaoAgente => x != null);
}

async function buscarColaboradores(
  query: string,
  signal: AbortSignal,
): Promise<SugestaoAgente[]> {
  const q = query.trim();
  if (!q) return [];
  const params = new URLSearchParams();
  params.set("cargaInicial", "primeiraPagina");
  params.set("pagina", "0");
  params.set("tamanhoPagina", "20");
  params.set("q", q);
  const url = `/api/contas-receber/colaboradores?${params.toString()}`;
  const res = await fetch(url, { signal, cache: "no-store" });
  if (!res.ok) return [];
  const j = (await res.json()) as { dados?: Record<string, unknown>[] };
  return (j.dados ?? [])
    .map((row) => {
      const id = String(row.idColaborador ?? row.id_colaborador ?? "").trim();
      if (!id) return null;
      return { id, label: rotuloListaColaborador(row) };
    })
    .filter((x): x is SugestaoAgente => x != null);
}

export type LigaContasReceberAgenteLookupProps = {
  tipoAgente: "1" | "2" | "3";
  rotuloExibicao: string;
  onInputRotulo: (texto: string) => void;
  onSelecionar: (id: string, rotulo: string) => void;
  inputId: string;
  label: string;
  placeholder: string;
  ariaLabel: string;
};

export function LigaContasReceberAgenteLookup({
  tipoAgente,
  rotuloExibicao,
  onInputRotulo,
  onSelecionar,
  inputId,
  label,
  placeholder,
  ariaLabel,
}: LigaContasReceberAgenteLookupProps) {
  const [sugestoes, setSugestoes] = useState<SugestaoAgente[]>([]);
  const abortRef = useRef<AbortController | null>(null);

  useEffect(() => {
    setSugestoes([]);
  }, [tipoAgente]);

  const buscar = useCallback(
    async (ev: AutoCompleteCompleteEvent) => {
      abortRef.current?.abort();
      const ac = new AbortController();
      abortRef.current = ac;
      const query = ev.query.trim();
      if (!query) {
        setSugestoes([]);
        return;
      }
      try {
        let lista: SugestaoAgente[] = [];
        if (tipoAgente === "1") lista = await buscarClientes(query, ac.signal);
        else if (tipoAgente === "2") lista = await buscarFornecedores(query, ac.signal);
        else if (tipoAgente === "3") lista = await buscarColaboradores(query, ac.signal);
        if (!ac.signal.aborted) setSugestoes(lista);
      } catch {
        if (!ac.signal.aborted) setSugestoes([]);
      }
    },
    [tipoAgente],
  );

  return (
    <div className="liga-cliente-infotime-campo-primeira-linha">
      <label className="liga-cliente-infotime-primeira-linha-label" htmlFor={inputId}>
        {label} *
      </label>
      <div className="liga-cliente-infotime-primeira-linha-controles">
        <AutoComplete
          key={tipoAgente}
          inputId={inputId}
          className="w-full liga-contas-receber-agente-lookup"
          inputClassName="w-full"
          value={rotuloExibicao}
          suggestions={sugestoes}
          completeMethod={buscar}
          minLength={1}
          placeholder={placeholder}
          dropdown
          aria-label={ariaLabel}
          onChange={(e) => {
            const v = e.value;
            if (v != null && typeof v === "object" && "id" in v) return;
            onInputRotulo(typeof v === "string" ? v : String(v ?? ""));
          }}
          onSelect={(e: AutoCompleteSelectEvent) => {
            const item = e.value as SugestaoAgente;
            if (item?.id && item.label) onSelecionar(item.id, item.label);
          }}
          itemTemplate={(item: SugestaoAgente) => (
            <span className="liga-contas-receber-agente-lookup-item">{item.label}</span>
          )}
        />
      </div>
    </div>
  );
}
