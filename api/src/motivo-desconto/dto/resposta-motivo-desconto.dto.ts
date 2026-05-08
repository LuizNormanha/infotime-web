/** Resposta detalhe — ids e BigInt como string no JSON. */
export class RespostaMotivoDescontoDto {
  id: string;
  descricao: string | null;
  codigo_migracao: number | null;
  codigo_externo: string | null;
  id_usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
