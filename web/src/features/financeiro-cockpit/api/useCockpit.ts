"use client";

import { useCallback, useEffect, useRef, useState } from "react";

import type { CockpitResponse } from "../types";

/** Evita refetch automático imediato após resposta recente (equivalente a staleTime do TanStack). */
const STALE_MS = 60_000;

export function useCockpit() {
  const [data, setData] = useState<CockpitResponse | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [isError, setIsError] = useState(false);
  const cache = useRef<{ carregadoEm: number; payload: CockpitResponse } | null>(null);

  const buscar = useCallback(async (forcar: boolean) => {
    if (
      !forcar &&
      cache.current != null &&
      Date.now() - cache.current.carregadoEm < STALE_MS
    ) {
      setData(cache.current.payload);
      setIsLoading(false);
      setIsError(false);
      return;
    }
    setIsLoading(true);
    setIsError(false);
    try {
      const res = await fetch("/api/financeiro/cockpit", {
        credentials: "include",
      });
      if (!res.ok) throw new Error(`cockpit_${String(res.status)}`);
      const json = (await res.json()) as CockpitResponse;
      cache.current = { carregadoEm: Date.now(), payload: json };
      setData(json);
    } catch {
      setIsError(true);
    } finally {
      setIsLoading(false);
    }
  }, []);

  useEffect(() => {
    void buscar(false);
  }, [buscar]);

  return {
    data,
    isLoading,
    isError,
    refetch: () => void buscar(true),
  };
}
