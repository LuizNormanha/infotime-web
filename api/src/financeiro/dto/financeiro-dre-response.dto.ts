export type FinanceiroDreLinhaDto = {
  nivel: number;
  descricao: string;
  valor: number;
};

/** DRE sintética por período. Estrutura estável para evoluir com plano de contas analítico. */
export type FinanceiroDreResponseDto = {
  periodoInicio: string;
  periodoFim: string;
  linhas: FinanceiroDreLinhaDto[];
};
