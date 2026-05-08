/** Delta por chave de campo — merge sobre o layout padrão do código. */
export class CampoOverlayDto {
  oculto?: boolean;
  obrigatorioExtra?: boolean;
}

export class PermissoesOverlayDto {
  ver?: boolean;
  editar?: boolean;
  salvar?: boolean;
  excluir?: boolean;
}

export class LayoutOverlayDto {
  campos?: Record<string, CampoOverlayDto>;
  permissoes?: PermissoesOverlayDto;
}
