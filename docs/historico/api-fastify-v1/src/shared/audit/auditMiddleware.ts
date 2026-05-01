/** Campos de auditoria aplicados em services — middleware Prisma pode ser plugado depois. */
export function auditAppFields(
  request: { ip?: string },
  codigoAplicacao?: string,
): {
  enderecoIpAuditoria?: string;
  nomeAplicacaoAuditoria?: string;
} {
  return {
    enderecoIpAuditoria: request.ip,
    nomeAplicacaoAuditoria: codigoAplicacao ?? "infotime-api",
  };
}
