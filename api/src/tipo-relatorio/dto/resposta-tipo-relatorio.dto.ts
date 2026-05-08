/** Resposta detalhe — ids como string no JSON. */
export class RespostaTipoRelatorioDto {
  id: string;
  descricao: string | null;
  ativo: string | null;
  id_usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
