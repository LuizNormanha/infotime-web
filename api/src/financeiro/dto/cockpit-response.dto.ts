export type CockpitKpiDto = {
  total: number;
  qtd: number;
};

export type CockpitFluxoDiaDto = {
  data: string;
  entradas: number;
  saidas: number;
};

export type CockpitMiniItemDto = {
  id: string;
  nomeAgente: string;
  valorPrevisao: number;
  dataPrevisao: string;
  diasAtraso?: number;
};

export type CockpitDistribuicaoDto = {
  pendenteReceber: number;
  pendentePagar: number;
  pagosRecebidosMes: number;
  totalEmAtraso: number;
};

export type CockpitResponseDto = {
  receberHoje: CockpitKpiDto;
  receberAtraso: CockpitKpiDto;
  pagarHoje: CockpitKpiDto;
  pagarAtraso: CockpitKpiDto;
  saldoPrevisto30d: number;
  fluxo14dias: CockpitFluxoDiaDto[];
  distribuicao: CockpitDistribuicaoDto;
  miniReceberHoje: CockpitMiniItemDto[];
  miniReceberAtraso: CockpitMiniItemDto[];
  miniPagarHoje: CockpitMiniItemDto[];
  miniPagarAtraso: CockpitMiniItemDto[];
};
