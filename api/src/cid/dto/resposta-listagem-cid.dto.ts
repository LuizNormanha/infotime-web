export class RespostaListagemCidDto {
  id: string;
  codigo_cid: string | null;
  /** Texto de listagem (pode ser truncado na UI). */
  descricao: string | null;
}
