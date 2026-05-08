/** Item de listagem — BigInt como string. */
export class RespostaListagemSerieNotaFiscalServicoDto {
  id!: string;
  sigla!: string;
  numeracao!: string;
  id_unidade!: string;
  /** Rótulo para exibição (nome fantasia / sigla da unidade). */
  unidade_rotulo!: string | null;
}
