export class RespostaSetorDto {
  id!: string;
  descricao!: string | null;
  ativo!: string | null;
  codigoMigracao!: number | null;
  codigoExterno!: string | null;
  id_usuario_auditoria!: string | null;
  endereco_ip_auditoria!: string | null;
  nome_aplicacao_auditoria!: string | null;
}
