"use client";

import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
} from "react";
import { PrimeReactProvider } from "primereact/api";

import { LigaFeedbackProvider } from "@/components/ui/feedback/LigaFeedback";

export type TemaLiga = "light" | "dark";

type ValorContextoTema = {
  tema: TemaLiga;
  alternarTema: () => void;
  definirTema: (t: TemaLiga) => void;
};

const ContextoTemaLiga = createContext<ValorContextoTema | null>(null);

export function useTemaLiga() {
  const ctx = useContext(ContextoTemaLiga);
  if (!ctx) {
    throw new Error("useTemaLiga deve ser usado dentro de LigaProvedorApp");
  }
  return ctx;
}

export function LigaProvedorApp({ children }: { children: React.ReactNode }) {
  const [tema, setTema] = useState<TemaLiga>("light");

  useEffect(() => {
    document.documentElement.setAttribute("data-theme", tema);
  }, [tema]);

  const alternarTema = useCallback(() => {
    setTema((t) => (t === "light" ? "dark" : "light"));
  }, []);

  const valor = useMemo(
    () => ({
      tema,
      alternarTema,
      definirTema: setTema,
    }),
    [tema, alternarTema],
  );

  return (
    <PrimeReactProvider>
      <LigaFeedbackProvider>
        <ContextoTemaLiga.Provider value={valor}>
          {children}
        </ContextoTemaLiga.Provider>
      </LigaFeedbackProvider>
    </PrimeReactProvider>
  );
}
