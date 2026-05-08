/** Item da listagem de feriados. */
export class RespostaListagemFeriadoDto {
  id: string;
  descricao: string | null;
  /** ISO date AAAA-MM-DD */
  data_feriado: string | null;
}
