export type ReguaCobrancaListaItemDto = {
  id: string;
  nome: string;
  ativo: boolean;
};

export type ReguaCobrancaListaResponseDto = {
  itens: ReguaCobrancaListaItemDto[];
};
