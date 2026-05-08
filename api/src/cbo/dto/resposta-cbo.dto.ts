/** Resposta detalhe — BigInt como string no JSON. */
export class RespostaCboDto {
  id: string;
  descricao: string | null;
  codigo_externo: string | null;
  /** Código numérico CBO quando informado. */
  codigo_cbo: number | null;
  id_usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
