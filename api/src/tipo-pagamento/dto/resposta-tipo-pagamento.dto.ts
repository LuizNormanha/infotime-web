/** Resposta detalhe — ids e BigInt como string no JSON. */
export class RespostaTipoPagamentoDto {
  id: string;
  codigo_tipo_pagamento: string | null;
  descricao: string | null;
  limite_parcelas: number | null;
  bandeira: string | null;
  documento_obrigatorio: string | null;
  codigo_migracao: number | null;
  codigo_externo: string | null;
  id_usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
