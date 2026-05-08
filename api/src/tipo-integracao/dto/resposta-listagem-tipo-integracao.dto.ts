export class RespostaListagemTipoIntegracaoDto {
  id: string;
  descricao: string | null;
  ativo: string | null;
  /** BigInt serializado como string. */
  codigo_migracao: string | null;
}
