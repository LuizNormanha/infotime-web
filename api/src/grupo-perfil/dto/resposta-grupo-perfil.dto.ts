import type { RespostaListagemUsuarioPermissaoDto } from '../../usuario-permissoes/dto/resposta-usuario-permissao.dto';

export class RespostaGrupoPerfilDto {
  id!: string;
  descricao!: string | null;
  /** FK tenant — somente leitura na UI (escopo do tenant). */
  idTenacidade!: string;
  /** Nome amigável resolvido em `infolab_tenacidade` (fantasia ou razão social). */
  tenacidadeNomeExibicao!: string | null;
  id_usuario_auditoria!: string | null;
  endereco_ip_auditoria!: string | null;
  nome_aplicacao_auditoria!: string | null;
  /** Detalhes carregados com o mestre (mesmo GET). */
  permissoes?: RespostaListagemUsuarioPermissaoDto[];
  /** Estrutura de menu específica do grupo (quando houver). */
  menu?: unknown;
}