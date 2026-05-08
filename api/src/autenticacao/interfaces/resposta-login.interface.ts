export interface RespostaLogin {
  access_token: string;
  refresh_token: string;
  /** Aviso opcional quando `data_expiracao` da licença está a ≤10 dias (MCP login). */
  aviso_licenca_proxima_expiracao?: string | null;
}

export interface RespostaLoginSuporte {
  access_token: string;
  redirect: string;
}

export interface RespostaSessaoAtiva {
  mensagem: string;
  id_usuario: string;
  id_tenacidade: string;
}

export interface UsuarioAutenticado {
  id_usuario: string;
  tenantId: string;
  suporte?: boolean;
  jti: string;
}
