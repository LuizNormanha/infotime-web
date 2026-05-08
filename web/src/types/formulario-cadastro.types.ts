// [APRESENTAÇÃO] Tipos do contrato de layout de formulário.
// Espelham o DTO retornado pela API — sem lógica de negócio.
// O backend resolve o catálogo `infolab_formulario` + JSON por usuário e devolve
// este contrato via GET /layout/:tela/formulario-cadastro (envelope interno `{ v, layout }`).
// Quando a resposta vem vazia (secoes: []), o componente usa o layout padrão da tela.
// Quando vem preenchida, usa a personalização do cliente.

// [APRESENTAÇÃO] Tipos de campo suportados pelo formulário de cadastro.
export type TipoCampoFormulario =
  | "texto"
  | "email"
  | "senha"
  | "numero"
  | "data"
  | "textarea"
  | "select"
  | "checkbox"
  /** Coluna `ativo` (S/N no banco): `InputSwitch` na UI; estado tipicamente boolean ou S/N conforme a tela. */
  | "ativo"
  /**
   * Exceção rara: rádios S/N com rótulos customizados. **Não** usar para o campo padrão `ativo`
   * (usar `tipo: "ativo"` + Switch — `mcp/padroes/ui` rules §7.4).
   */
  | "ativoRadio"
  | "somenteLeitura";

// [APRESENTAÇÃO] Opção de campo select.
export type OpcaoCampo = {
  label: string;
  value: string;
};

/** [APRESENTAÇÃO] Definição de um campo individual dentro de uma seção. */
export type CampoFormularioCadastro = {
  /** Chave que mapeia para o campo no objeto de dados (ex.: "nome", "cpf"). */
  chave: string;
  label: string;
  tipo: TipoCampoFormulario;
  obrigatorio?: boolean;
  /** NOT NULL no banco — não configurável pelo usuário. */
  obrigatorio_sistema?: boolean;
  /** Campo de tenant — somente leitura, nunca editável. */
  eh_tenant?: boolean;
  /**
   * Largura na grade 12 colunas no desktop: omitido = metade; último campo
   * “solto” (quantidade ímpar de campos não-checkbox na seção) ocupa a linha inteira.
   * `1` = linha inteira; `2` = metade (span 6); `3` = um terço (span 4); `4` = dois terços (span 8).
   */
  colunas?: 1 | 2 | 3 | 4;
  maxLength?: number;
  placeholder?: string;
  /**
   * Apenas para `tipo: "data"`: quando **o negócio** exige data+hora distinta (ex.: agendamento
   * com horário), usa `Calendar` com `showTime` e persiste ISO 8601 completo. **Omissão** = só dia
   * civil (`YYYY-MM-DD`), mesmo que a coluna no banco seja `timestamp` (sem seletor de hora na UI).
   */
  dataComHorario?: boolean;
  /** Apenas para tipo "select". */
  opcoes?: OpcaoCampo[];
  /** `textarea`: altura; `somenteLeitura`: se > 1, usa área de texto desabilitada (ex.: segredo JWT). */
  linhas?: number;
  /** Ocultar campo na inclusão (ex.: ID gerado pelo banco). */
  ocultarNaInclusao?: boolean;
  /** Ocultar campo na edição. */
  ocultarNaEdicao?: boolean;
};

/** [APRESENTAÇÃO] Sub-bloco de campos dentro de uma seção (uma entrada na sidebar). */
export type GrupoCamposFormularioCadastro = {
  id: string;
  titulo?: string;
  descricao?: string;
  /**
   * Título opcional acima de checkboxes consecutivos neste grupo
   * (sobreposto ao `tituloGrupoCheckbox` da seção quando definido).
   */
  tituloGrupoCheckbox?: string;
  campos: CampoFormularioCadastro[];
};

/** [APRESENTAÇÃO] Seção da sidebar do formulário. */
export type SecaoFormularioCadastro = {
  id: string;
  titulo: string;
  descricao?: string;
  /** Ícone PrimeIcons sem prefixo "pi " (ex.: "pi-user"). */
  icone: string;
  /** Campos da seção; pode ser vazio quando `grupos` define o conteúdo. */
  campos: CampoFormularioCadastro[];
  /**
   * Quando preenchido, os campos são mostrados em sub-blocos com título próprio
   * (evita repetir o mesmo título de seção na barra lateral).
   */
  grupos?: GrupoCamposFormularioCadastro[];
  /**
   * Título opcional acima do bloco quando há checkboxes consecutivos agrupados
   * (ex.: indicadores em “Dados pessoais”).
   */
  tituloGrupoCheckbox?: string;
  /**
   * Evita que o último campo (quantidade ímpar) vire linha inteira — necessário em grades
   * com 3+ colunas na mesma linha (ex.: identificação em definição de mapa).
   */
  ignorarLarguraAutomaticaUltimo?: boolean;
  /** Grade CSS em `liga-formulario-cadastro-base.css` (uma linha com 2 ou 3 colunas). */
  idGradeVariante?: "mapaDefIdent";
};

/** [APRESENTAÇÃO] Contrato completo retornado pela API de layout. */
export type LayoutFormularioCadastro = {
  /** Título padrão para inclusão. */
  tituloNovo?: string;
  /** Título padrão para edição. */
  tituloEditar?: string;
  subtituloNovo?: string;
  subtituloEditar?: string;
  iconeTitulo?: string;
  secoes: SecaoFormularioCadastro[];
};
