"use client";

import { LigaContasPagarInfotimePainel } from "@/components/contas-pagar/LigaContasPagarInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

export default function PaginaFinanceiroPagarNovo() {
  const sessao = useSessaoAtual();
  return (
    <LigaContasPagarInfotimePainel
      idTenacidade={sessao.idTenacidade}
      omitirCabecalhoModulo
      idLancamentoRota="novo"
      navegacaoBasePath="/financeiro/pagar"
    />
  );
}
