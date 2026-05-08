"use client";

import { createContext, useContext } from "react";

/**
 * Slug da tela ativa (código do catálogo de telas), alinhado a `GET /auth/permissoes?tela=`.
 * `undefined` = fora do provider (fallback para evento `liga:tela-ativa`).
 * `null` = aba sem slug de catálogo (ex.: ajuda).
 */
export const TelaAtivaContext = createContext<string | null | undefined>(undefined);

export function useTelaAtivaSlugOpcional(): string | null | undefined {
  return useContext(TelaAtivaContext);
}
