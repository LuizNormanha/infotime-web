export class RespostaListagemTipoPagamentoDto {
  id: string;
  codigo_tipo_pagamento: string | null;
  descricao: string | null;
  limite_parcelas: number | null;
  bandeira: string | null;
  documento_obrigatorio: string | null;
}
