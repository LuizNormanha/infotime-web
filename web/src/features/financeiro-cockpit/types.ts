export type CockpitKpi = {
  total: number;
  qtd: number;
};

export type CockpitFluxoDia = {
  data: string;
  entradas: number;
  saidas: number;
};

export type CockpitMiniItem = {
  id: string;
  nomeAgente: string;
  valorPrevisao: number;
  dataPrevisao: string;
  diasAtraso?: number;
};

export type CockpitDistribuicao = {
  pendenteReceber: number;
  pendentePagar: number;
  pagosRecebidosMes: number;
  totalEmAtraso: number;
};

export type CockpitResponse = {
  receberHoje: CockpitKpi;
  receberAtraso: CockpitKpi;
  pagarHoje: CockpitKpi;
  pagarAtraso: CockpitKpi;
  saldoPrevisto30d: number;
  fluxo14dias: CockpitFluxoDia[];
  distribuicao: CockpitDistribuicao;
  miniReceberHoje: CockpitMiniItem[];
  miniReceberAtraso: CockpitMiniItem[];
  miniPagarHoje: CockpitMiniItem[];
  miniPagarAtraso: CockpitMiniItem[];
};
