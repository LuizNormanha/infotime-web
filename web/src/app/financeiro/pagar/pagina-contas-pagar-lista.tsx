"use client";

import { useSearchParams } from "next/navigation";
import { useMemo } from "react";

import { LigaContasPagarInfotimePainel } from "@/components/contas-pagar/LigaContasPagarInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

export function PaginaContasPagarLista() {
  const sessao = useSessaoAtual();
  const sp = useSearchParams();
  const queryListagemExtra = useMemo(() => {
    const o: Record<string, string> = {};
    if (sp.get("venceHoje") === "true") o.venceHoje = "true";
    if (sp.get("atrasado") === "true") o.atrasado = "true";
    return Object.keys(o).length > 0 ? o : undefined;
  }, [sp]);

  return (
    <LigaContasPagarInfotimePainel
      idTenacidade={sessao.idTenacidade}
      queryListagemExtra={queryListagemExtra}
      omitirCabecalhoModulo
      navegacaoBasePath="/financeiro/pagar"
    />
  );
}
