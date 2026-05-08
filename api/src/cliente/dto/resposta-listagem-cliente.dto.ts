/**
 * DTO de resposta para listagem de clientes.
 * Requisito 6.4: Contém apenas os campos necessários para listagem.
 * Requisito 6.7: Campos BigInt são serializados como string.
 */
export class RespostaListagemClienteDto {
  /** BigInt serializado como string */
  id: string;

  nome: string | null;
  nome_social?: string | null;
  cpf: string | null;
  documento: string | null;
  email: string | null;
  telefone: string | null;

  /** Rótulo para coluna sexo na grade. */
  sexo?: string | null;

  /** ISO date (yyyy-mm-dd) ou null */
  data_nascimento?: string | null;

  bairro?: string | null;
  cidade?: string | null;

  /** ISO datetime da inclusão */
  data_inclusao?: string | null;

  /** 'Ativo' | 'Inativo' — derivado do campo bloqueado */
  status: string;
}
