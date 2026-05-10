"use client";

import { useParams } from "next/navigation";

import { LigaContasPagarInfotimePainel } from "@/components/contas-pagar/LigaContasPagarInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

export default function PaginaFinanceiroPagarId() {
  const sessao = useSessaoAtual();
  const params = useParams();
  const id = decodeURIComponent(String(params.id ?? ""));

  return (
    <LigaContasPagarInfotimePainel
      idTenacidade={sessao.idTenacidade}
      omitirCabecalhoModulo
      idLancamentoRota={id}
      navegacaoBasePath="/financeiro/pagar"
    />
  );
}
