/** Detalhe — BigInt como string; binário `cer_arq` não é exposto na API. */
export class RespostaSerieNotaFiscalServicoDto {
  id!: string;
  id_tenacidade!: string | null;
  id_unidade!: string;
  sigla!: string;
  numeracao!: string;
  tipo_nota_fiscal!: number | null;
  ativo!: string | null;
  ambiente!: number | null;
  lote!: string | null;
  frase_secreta!: string | null;
  senha_web!: string | null;
  usuario_web!: string | null;
  cer_senha!: string | null;
  id_usuario_auditoria!: string | null;
  usuario_auditoria!: string | null;
  endereco_ip_auditoria!: string | null;
  nome_aplicacao_auditoria!: string | null;
}
