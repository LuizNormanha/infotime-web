/**
 * DTO de resposta para operações de detalhe de cliente.
 * Requisito 6.3: Contém todos os campos EXCETO senha_internet.
 * Requisito 6.7: Campos BigInt são serializados como string.
 */
export class RespostaClienteDto {
  /** BigInt serializado como string */
  id: string;

  /** BigInt serializado como string — preenchido pelo service */
  id_tenacidade: string | null;

  nome: string | null;
  nome_social: string | null;
  cpf: string | null;
  documento: string | null;
  codigo_passaporte: string | null;
  prontuario: string | null;
  codigo_externo: string | null;
  sexo: string | null;
  estado_civil: string | null;
  data_nascimento: string | null;

  /** BigInt serializado como string */
  peso: string | null;

  /** BigInt serializado como string */
  altura: string | null;

  diabetico: string | null;
  falecido: string | null;
  receber_mensagem: string | null;
  /** S | N — cliente inativo (bloqueado) não deve ser usado em novos atendimentos. */
  bloqueado: string | null;
  cep: string | null;
  logradouro: string | null;
  numero: string | null;
  complemento: string | null;
  bairro: string | null;
  cidade: string | null;
  estado: string | null;
  endereco_referencia: string | null;
  telefone: string | null;
  celular: string | null;
  email: string | null;

  // senha_internet é OMITIDA intencionalmente — nunca retornada (Requisito 6.3)

  observacao_resultado: string | null;
  data_inclusao: string | null;

  /** BigInt serializado como string */
  id_usuario_auditoria: string | null;

  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
}
