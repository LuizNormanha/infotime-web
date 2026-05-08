"use client";

import { useEffect, useState } from "react";
import type { LayoutFormularioCadastro } from "@/types/formulario-cadastro.types";

type Estado = {
  layout: LayoutFormularioCadastro | null;
  carregando: boolean;
  erro: string | null;
};

/**
 * Busca o layout de formulário de cadastro para uma tela específica.
 * GET /api/layout/:tela/formulario-cadastro
 *
 * - Resposta com secoes preenchidas → personalização do cliente
 * - Resposta com secoes vazias → componente usa layout padrão hardcoded
 */
export function useLayoutFormulario(tela: string): Estado {
  const [estado, setEstado] = useState<Estado>({ layout: null, carregando: true, erro: null });

  useEffect(() => {
    if (!tela) return;
    const ac = new AbortController();
    setEstado({ layout: null, carregando: true, erro: null });

    fetch(`/api/layout/${encodeURIComponent(tela)}/formulario-cadastro`, {
      signal: ac.signal,
      cache: "no-store",
    })
      .then(async (res) => {
        if (!res.ok) throw new Error(`http_${res.status}`);
        const json = (await res.json()) as LayoutFormularioCadastro;
        setEstado({ layout: json, carregando: false, erro: null });
      })
      .catch((e: unknown) => {
        if (e instanceof DOMException && e.name === "AbortError") return;
        const msg = e instanceof Error ? e.message : String(e);
        console.warn("[useLayoutFormulario] falha ao carregar layout, usando padrão:", msg);
        // Continua com layout padrão (secoes: []) para não bloquear o formulário
        setEstado({ layout: { secoes: [] }, carregando: false, erro: msg });
      });

    return () => ac.abort();
  }, [tela]);

  return estado;
}
