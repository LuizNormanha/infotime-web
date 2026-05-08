export type RespostaUsuarioPermissaoDto = {
  id: string;
  idGrupoUsuario: string;
  idFormulario: string;
  grupoUsuarioDescricao: string | null;
  formularioCodigo: string;
  formularioDescricao: string | null;
  administrador: boolean;
  incluir: boolean;
  editar: boolean;
  excluir: boolean;
  id_usuario_auditoria: string | null;
  endereco_ip_auditoria: string | null;
  nome_aplicacao_auditoria: string | null;
};

export type RespostaListagemUsuarioPermissaoDto = {
  id: string;
  idGrupoUsuario: string;
  idFormulario: string;
  grupoUsuarioDescricao: string | null;
  formularioCodigo: string;
  formularioDescricao: string | null;
  administrador: boolean;
  incluir: boolean;
  editar: boolean;
  excluir: boolean;
};
