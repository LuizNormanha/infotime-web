"use client";

import { useSearchParams } from "next/navigation";
import { useMemo } from "react";

import { LigaContasReceberInfotimePainel } from "@/components/contas-receber/LigaContasReceberInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

export function PaginaContasReceberLista() {
  const sessao = useSessaoAtual();
  const sp = useSearchParams();
  const queryListagemExtra = useMemo(() => {
    const o: Record<string, string> = {};
    if (sp.get("venceHoje") === "true") o.venceHoje = "true";
    if (sp.get("atrasado") === "true") o.atrasado = "true";
    return Object.keys(o).length > 0 ? o : undefined;
  }, [sp]);

  return (
    <LigaContasReceberInfotimePainel
      idTenacidade={sessao.idTenacidade}
      queryListagemExtra={queryListagemExtra}
      omitirCabecalhoModulo
      navegacaoBasePath="/financeiro/receber"
    />
  );
}
