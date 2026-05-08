/**
 * Contratos da listagem (LigaListagemBase).
 * Busca no servidor exige whitelist no backend alinhada a índices reais — ver ai/domains/padroes-ui.
 */

import type { ReactNode } from "react";

/** Tipo de controle do filtro refinado (apenas sobre registros já carregados no grid). */
export type LigaFiltroRefinadoTipo =
  | "texto"
  | "inteiro"
  | "decimal"
  | "data"
  | /** Intervalo inclusão / datas de cadastro */
    "dataIntervaloInclusao"
  | "enum";

export type LigaFiltroRefinadoOpcaoEnum = {
  valor: string;
  rotulo: string;
};

export type LigaFiltroRefinadoDef = {
  tipo: LigaFiltroRefinadoTipo;
  /** Obrigatório para tipo enum (ex.: sexo, bloqueado S/N). */
  opcoes?: LigaFiltroRefinadoOpcaoEnum[];
};

/**
 * Máscara do input de busca rápida (modo servidor + dropdown "Pesquisar por").
 * Também pode ser inferida pelo nome de `campo` / `campoConsulta` quando omitida.
 */
export type LigaMascaraBuscaServidor =
  | "cpf"
  | "cnpj"
  | "data"
  | "cep"
  | "telefone";

export type LigaColunaListagem = {
  campo: string;
  cabecalho: string;
  ordenavel?: boolean;
  filtravel?: boolean;
  larguraPx?: number | null;
  alinhamento?: "left" | "center" | "right";
  fixo?: boolean;
  quebraLinhaTexto?: boolean;
  formatoDataListagem?: "auto" | "dataHora" | "data" | "texto";
  /** Default true: coluna visível ao abrir. */
  visivelPadrao?: boolean;
  /** Default true: pode ser ocultada pelo seletor de colunas. */
  ocultavel?: boolean;
  /**
   * Coluna elegível para busca no banco (dropdown "Pesquisar por").
   * O nome do campo na API pode divergir via campoConsulta.
   */
  pesquisaServidor?: boolean;
  /** Nome do campo na query da API quando diferente de `campo`. */
  campoConsulta?: string;
  /**
   * Máscara no campo de busca quando esta coluna está selecionada no dropdown.
   * Se omitido, tenta-se inferir por `campo` / `campoConsulta` / `formatoDataListagem`.
   */
  mascaraBuscaServidor?: LigaMascaraBuscaServidor;
  /** Metadados do filtro refinado (sidebar); omitir = coluna não entra no filtro refinado. */
  filtroRefinado?: LigaFiltroRefinadoDef;
  /**
   * §11.7 padroes-ui — como exibir o valor bruto (além de datas em `formatoDataListagem`).
   * `ativoInativo`: SN / boolean → rótulos Ativo/Inativo.
   * `simNao`: SN / boolean → Sim (S) / Não (N).
   * Quando omitido e `campo === "ativo"`, o motor assume `ativoInativo`.
   */
  valorExibicao?: "padrao" | "ativoInativo" | "simNao";
  /**
   * Força a coluna a ser tratada como chave técnica no fim da lista (além do match por `chavePrimaria`).
   * Uso raro; em geral basta coincidir `campo` com a prop `chavePrimaria` de `LigaListagemBase`.
   */
  colunaChavePrimaria?: boolean;
  /**
   * Conteúdo customizado da célula (ex.: tag de status, lista de exames).
   * Quando definido, ignora a formatação padrão de `textoCelulaListagem` para o valor bruto.
   * `ctx.termoBusca` espelha o termo já aplicado na busca (para destaque com `ligaListagemCelulaComDestaqueTexto`).
   */
  corpoCelula?: (
    linha: Record<string, unknown>,
    ctx?: { termoBusca: string },
  ) => ReactNode;
  /** Largura em % da coluna (tabela com `table-layout: fixed` + grid flex). */
  larguraPercentual?: number;
  /** `minWidth` em px e parcela adicional em % (ex.: coluna de exames com mínimo e flex). */
  larguraMinPxMaisPercentual?: { px: number; percentual: number };
  /** Mínimo em px (ex.: coluna numérica estreita). */
  larguraMinPx?: number;
};

export type LigaListagemOrdenacaoInicial = {
  campo: string;
  ordem: 1 | -1;
};

/** Estado serializável de um critério do filtro refinado (valor por tipo). */
export type LigaFiltroRefinadoValor =
  | { tipo: "texto"; contem: string }
  | { tipo: "inteiro"; igual: string }
  | { tipo: "decimal"; igual: string }
  | {
      tipo: "data";
      /** `true`: intervalo com início/fim; omitido/false: apenas `de` = mesmo dia civil. */
      entreDatas?: boolean;
      de: Date | null;
      ate: Date | null;
    }
  | {
      tipo: "dataIntervaloInclusao";
      entreDatas?: boolean;
      de: Date | null;
      ate: Date | null;
    }
  | { tipo: "enum"; valores: string[] };

export type LigaPaginacaoServidorProps = {
  primeiroIndice: number;
  linhasPorPagina: number;
  totalRegistros: number;
  aoPaginar: (patch: { primeiroIndice: number; linhasPorPagina: number }) => void;
};

/** Parâmetros da busca no servidor (Enter na caixa de busca). */
export type LigaPesquisaServidorPayload = {
  termo: string;
  /** Campo da API (campoConsulta ?? campo da coluna). */
  campoPesquisa: string;
};
