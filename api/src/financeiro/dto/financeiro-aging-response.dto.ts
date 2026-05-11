export type FinanceiroAgingFaixaDto = {
  label: string;
  valor: number;
  qtd: number;
};

/** Aging de contas a receber (resumo por faixa). Estrutura estável para evoluir com consultas reais. */
export type FinanceiroAgingResponseDto = {
  referencia: string;
  faixas: FinanceiroAgingFaixaDto[];
  totalEmAberto: number;
};
