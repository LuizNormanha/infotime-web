/** Resposta detalhe — ids e BigInt como string no JSON. */
export class RespostaTipoIndicacaoDto {
  id: string;
  codigo: string | null;
  descricao: string | null;
  ativo: string | null;
  id_usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
