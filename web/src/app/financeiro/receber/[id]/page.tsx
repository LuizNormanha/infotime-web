"use client";

import { useParams } from "next/navigation";

import { LigaContasReceberInfotimePainel } from "@/components/contas-receber/LigaContasReceberInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

export default function PaginaFinanceiroReceberId() {
  const sessao = useSessaoAtual();
  const params = useParams();
  const id = decodeURIComponent(String(params.id ?? ""));

  return (
    <LigaContasReceberInfotimePainel
      idTenacidade={sessao.idTenacidade}
      omitirCabecalhoModulo
      idLancamentoRota={id}
      navegacaoBasePath="/financeiro/receber"
    />
  );
}
