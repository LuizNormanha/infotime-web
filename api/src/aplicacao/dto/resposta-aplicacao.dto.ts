export class RespostaAplicacaoDto {
  id!: string;
  codigoAplicacao!: string;
  nomeAplicacao!: string;
  descricaoAplicacao!: string | null;
  nomeTabelaPrincipal!: string;
  nomeRotaFrontend!: string | null;
  nomeEndpointBackend!: string | null;
  usaListagem!: boolean;
  usaFormulario!: boolean;
  ativo!: boolean;
  dicaAplicacao!: string | null;
  observacao!: string | null;
  id_usuario_auditoria!: string | null;
  endereco_ip_auditoria!: string | null;
  nome_aplicacao_auditoria!: string | null;
}
