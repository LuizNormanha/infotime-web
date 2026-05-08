export class CampoFormularioCadastroDto {
  chave: string;
  label: string;
  tipo: string;
  obrigatorio?: boolean;
  obrigatorio_sistema?: boolean; // NOT NULL no banco — não configurável
  eh_tenant?: boolean; // campo de tenant — somente leitura
  colunas?: 1 | 2 | 3 | 4;
  maxLength?: number;
  placeholder?: string;
  opcoes?: { label: string; value: string }[];
  linhas?: number;
  ocultarNaInclusao?: boolean;
  ocultarNaEdicao?: boolean;
}

export class SecaoFormularioCadastroDto {
  id: string;
  titulo: string;
  descricao?: string;
  icone: string;
  campos: CampoFormularioCadastroDto[];
}

export class LayoutFormularioCadastroDto {
  tituloNovo?: string;
  tituloEditar?: string;
  subtituloNovo?: string;
  subtituloEditar?: string;
  iconeTitulo?: string;
  secoes: SecaoFormularioCadastroDto[];
}
