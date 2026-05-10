"use client";

import { LigaContasReceberInfotimePainel } from "@/components/contas-receber/LigaContasReceberInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

export default function PaginaFinanceiroReceberNovo() {
  const sessao = useSessaoAtual();
  return (
    <LigaContasReceberInfotimePainel
      idTenacidade={sessao.idTenacidade}
      omitirCabecalhoModulo
      idLancamentoRota="novo"
      navegacaoBasePath="/financeiro/receber"
    />
  );
}
