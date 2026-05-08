/** Detalhe (`infolab_tenacidade_configuracao`) — mesmo shape que o formulário achata após o GET. */
export type RespostaConfiguracaoTenacidadeImplantacaoDto = {
  id_configuracao: string;
  id_tenacidade: string;
  razao_social: string | null;
  nome_fantasia: string | null;
  chave_acesso: string | null;
  data_expiracao: string | null;
  ultimo_ano: string | null;
  ultimo_atendimento: string | null;
  dominio_tenacidade: string | null;
  chave_jwt: string | null;
  infolab_vet: boolean | string | null;
  somente_interfaceamento: boolean | string | null;
  utilizar_numeracao_origem_liberacao: boolean | string | null;
  utilizar_deltacheck_liberacao: boolean | string | null;
  liberar_resultado_interfaceado_baixado: boolean | string | null;
  capturar_versao_exame_apoio: boolean | string | null;
  liberar_resultado_informado: boolean | string | null;
  diretorio_exportacao_resultado: string | null;
  diretorio_triagem_amostra: string | null;
  mensagem_exame_repetido: string | null;
  lista_setor_libera_informado: string | null;
  endpoint_pedido: string | null;
  endpoint_chatbot: string | null;
  timeout_sessao_minutos: number | null;
  quantidade_licenca: number | null;
  config_endereco_ip_auditoria: string | null;
  config_nome_aplicacao_auditoria: string | null;
};

/** Mestre (`infolab_tenacidade`) + detalhe (`infolab_tenacidade_configuracao`). */
export type RespostaTenacidadeImplantacaoDto = {
  id: string;
  ativo: string | null;
  id_usuario_auditoria: string | null;
  usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
  configuracao: RespostaConfiguracaoTenacidadeImplantacaoDto;
};

export type RespostaListagemTenacidadeImplantacaoDto = {
  id: string;
  razao_social: string | null;
  nome_fantasia: string | null;
  dominio_tenacidade: string | null;
  ativo: string | null;
  data_expiracao: string | null;
};
