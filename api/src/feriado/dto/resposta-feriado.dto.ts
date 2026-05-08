/** Resposta de detalhe de feriado (BigInt como string). */
export class RespostaFeriadoDto {
  id: string;
  id_tenacidade: string | null;
  descricao: string | null;
  /** ISO date AAAA-MM-DD */
  data_feriado: string | null;
  id_usuario_auditoria: string | null;
  /** Nome/login do usuário de auditoria para exibição */
  usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
