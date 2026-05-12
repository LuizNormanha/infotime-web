"use client";

import { useCallback, useEffect, useLayoutEffect, useMemo, useRef, useState } from "react";

import type {
  LigaFiltroRefinadoValor,
  LigaPesquisaServidorPayload,
} from "@/components/formulario-pesquisa/liga-listagem.types";
import {
  montarSearchParamsListagemPadrao,
  serializarFiltrosRefinadoParaQuery,
} from "@/lib/listagem-servidor-query";

export type UseListagemCrudServidorOptions = {
  /** URL do BFF sem trailing slash, ex.: `/api/clientes`. Pode incluir query fixa (`/api/x?foo=1`). */
  resourcePath: string;
  /** Parâmetros extras sempre enviados (ex.: `venceHoje` / `atrasado` vindos da URL do cockpit). */
  queryExtraFixo?: Record<string, string>;
  /** Valor inicial do dropdown “Pesquisar por” (campo whitelist na API). */
  campoPesquisaInicial: string;
  /**
   * Quando `true`, carrega com `?todos=1` e não usa `fonteListagem="servidor"`
   * (listagem para seleção em modal / lookup).
   */
  modoSelecao?: boolean;
  /** Padrão da paginação (default 10). */
  linhasPorPaginaInicial?: number;
  /** Chamado quando o fetch da listagem falha (exceto `AbortError`). */
  aoFalhaCarregar?: () => void;
};

/**
 * Normaliza `{ dados, total }` após `JSON.parse`.
 * `total` pode vir como string ou ausente; no DataTable em modo lazy, `totalRegistros === 0`
 * com linhas na página faz a grelha aparecer vazia.
 */
export function normalizarRespostaListagemJson(json: unknown): {
  dados: Record<string, unknown>[];
  total: number;
} {
  const o = json != null && typeof json === "object" ? (json as Record<string, unknown>) : {};
  const rawDados = o["dados"];
  const dados = Array.isArray(rawDados) ? (rawDados as Record<string, unknown>[]) : [];

  const rawTotal = o["total"];
  let total = 0;
  if (typeof rawTotal === "number" && Number.isFinite(rawTotal)) {
    total = rawTotal;
  } else if (typeof rawTotal === "string") {
    const t = Number.parseInt(rawTotal.trim(), 10);
    if (Number.isFinite(t)) total = t;
  }

  if (dados.length > 0 && total === 0) {
    total = dados.length;
  }

  return { dados, total };
}

function mesclarQueryNaUrl(resourcePath: string, params: URLSearchParams): string {
  const qMark = resourcePath.indexOf("?");
  const base = qMark >= 0 ? resourcePath.slice(0, qMark) : resourcePath;
  const merged = new URLSearchParams(qMark >= 0 ? resourcePath.slice(qMark + 1) : "");
  for (const [k, v] of params.entries()) {
    merged.set(k, v);
  }
  return `${base}?${merged.toString()}`;
}

export type LigaListagemServidorBindings = {
  fonteListagem: "servidor";
  paginacaoServidor: {
    primeiroIndice: number;
    linhasPorPagina: number;
    totalRegistros: number;
    aoPaginar: (patch: {
      primeiroIndice: number;
      linhasPorPagina: number;
    }) => void;
  };
  aoPesquisarServidor: (payload: LigaPesquisaServidorPayload) => void;
  aoCampoPesquisaServidorChange: (campoPesquisaApi: string) => void;
  aoFiltrosRefinadoServidor: (
    filtros: Record<string, LigaFiltroRefinadoValor | undefined>,
  ) => void;
  aoLimparBusca: () => void;
};

/**
 * Estado + fetch + handlers do modo listagem paginada no servidor (padrão Cliente).
 * A UI continua em [`LigaListagemBase`](components/formulario-pesquisa/LigaListagemBase.tsx).
 */
export function useListagemCrudServidor({
  resourcePath,
  campoPesquisaInicial,
  modoSelecao = false,
  linhasPorPaginaInicial = 10,
  aoFalhaCarregar,
  queryExtraFixo,
}: UseListagemCrudServidorOptions) {
  const [registros, setRegistros] = useState<Record<string, unknown>[]>([]);
  const [carregando, setCarregando] = useState(true);
  const [totalRegistros, setTotalRegistros] = useState(0);
  const [primeiroIndice, setPrimeiroIndice] = useState(0);
  const [linhasPagina, setLinhasPagina] = useState(linhasPorPaginaInicial);
  const [pesquisaSrv, setPesquisaSrv] = useState({
    termo: "",
    campo: campoPesquisaInicial,
  });
  const [filtrosRefinadoApi, setFiltrosRefinadoApi] = useState<
    Record<string, LigaFiltroRefinadoValor | undefined>
  >({});

  const filtroRefinadoQuery = useMemo(
    () => serializarFiltrosRefinadoParaQuery(filtrosRefinadoApi),
    [filtrosRefinadoApi],
  );

  const mesclarQueryExtra = useCallback(
    (params: URLSearchParams) => {
      if (!queryExtraFixo) return;
      for (const [k, v] of Object.entries(queryExtraFixo)) {
        if (v !== "") params.set(k, v);
      }
    },
    [queryExtraFixo],
  );

  const registrosRef = useRef<Record<string, unknown>[]>([]);
  useLayoutEffect(() => {
    registrosRef.current = registros;
  }, [registros]);

  const aoFalhaCarregarRef = useRef(aoFalhaCarregar);
  useLayoutEffect(() => {
    aoFalhaCarregarRef.current = aoFalhaCarregar;
  }, [aoFalhaCarregar]);

  const carregarModoSelecao = useCallback(
    (sinal?: AbortSignal) => {
      setCarregando(true);
      const merged = new URLSearchParams(
        resourcePath.includes("?") ? resourcePath.slice(resourcePath.indexOf("?") + 1) : "",
      );
      merged.set("todos", "1");
      mesclarQueryExtra(merged);
      const base = resourcePath.split("?")[0];
      const url = `${base}?${merged.toString()}`;
      fetch(url, { signal: sinal })
        .then(async (res) => {
          if (!res.ok) throw new Error();
          const json: unknown = await res.json();
          const { dados, total } = normalizarRespostaListagemJson(json);
          setRegistros(dados);
          setTotalRegistros(total);
        })
        .catch((e: unknown) => {
          if (e instanceof DOMException && e.name === "AbortError") return;
          setRegistros([]);
          setTotalRegistros(0);
          aoFalhaCarregarRef.current?.();
        })
        .finally(() => {
          if (!sinal?.aborted) setCarregando(false);
        });
    },
    [resourcePath, mesclarQueryExtra],
  );

  const carregarListagemServidor = useCallback(
    (sinal?: AbortSignal) => {
      if (registrosRef.current.length === 0) {
        setCarregando(true);
      }
      const pagina = Math.floor(primeiroIndice / linhasPagina);
      const params = montarSearchParamsListagemPadrao({
        pagina,
        tamanhoPagina: linhasPagina,
        termoBusca: pesquisaSrv.termo,
        campoPesquisa: pesquisaSrv.campo,
        filtroRefinadoJson: filtroRefinadoQuery,
      });
      mesclarQueryExtra(params);
      const url = mesclarQueryNaUrl(resourcePath, params);
      fetch(url, { signal: sinal })
        .then(async (res) => {
          if (!res.ok) throw new Error();
          const json: unknown = await res.json();
          const { dados, total } = normalizarRespostaListagemJson(json);
          setRegistros(dados);
          setTotalRegistros(total);
        })
        .catch((e: unknown) => {
          if (e instanceof DOMException && e.name === "AbortError") return;
          setRegistros([]);
          setTotalRegistros(0);
          aoFalhaCarregarRef.current?.();
        })
        .finally(() => {
          if (!sinal?.aborted) setCarregando(false);
        });
    },
    [
      resourcePath,
      primeiroIndice,
      linhasPagina,
      pesquisaSrv,
      filtroRefinadoQuery,
      mesclarQueryExtra,
    ],
  );

  const aoFiltrosRefinadoServidor = useCallback(
    (filtros: Record<string, LigaFiltroRefinadoValor | undefined>) => {
      setFiltrosRefinadoApi(filtros);
      setPrimeiroIndice(0);
    },
    [],
  );

  useEffect(() => {
    const ac = new AbortController();
    if (modoSelecao) {
      carregarModoSelecao(ac.signal);
    } else {
      carregarListagemServidor(ac.signal);
    }
    return () => ac.abort();
  }, [modoSelecao, carregarModoSelecao, carregarListagemServidor]);

  const servidor: LigaListagemServidorBindings | undefined = modoSelecao
    ? undefined
    : {
        fonteListagem: "servidor",
        paginacaoServidor: {
          primeiroIndice,
          linhasPorPagina: linhasPagina,
          totalRegistros,
          aoPaginar: ({ primeiroIndice: pi, linhasPorPagina: lp }) => {
            setPrimeiroIndice(pi);
            setLinhasPagina(lp);
          },
        },
        aoCampoPesquisaServidorChange: (campo) => {
          setPesquisaSrv({ termo: "", campo });
          setPrimeiroIndice(0);
        },
        aoPesquisarServidor: ({ termo, campoPesquisa }) => {
          setPesquisaSrv({ termo, campo: campoPesquisa });
          setPrimeiroIndice(0);
        },
        aoFiltrosRefinadoServidor,
        aoLimparBusca: () => {
          setPesquisaSrv((prev) => ({ termo: "", campo: prev.campo }));
          setPrimeiroIndice(0);
        },
      };

  return {
    registros,
    carregando,
    /** Spread em `LigaListagemBase` quando `!modoSelecao`. */
    servidor,
    aoLimparBuscaModoSelecao: () => {
      carregarModoSelecao();
    },
  };
}
