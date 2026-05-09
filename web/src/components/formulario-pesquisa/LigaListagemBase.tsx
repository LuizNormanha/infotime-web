"use client";

import type { CSSProperties, ReactNode } from "react";
import { Fragment } from "react";
import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
  type ComponentRef,
} from "react";
import { useTranslations } from "next-intl";
import type { DataTableStateEvent } from "primereact/datatable";
import type { MenuItem } from "primereact/menuitem";
import { Button } from "primereact/button";
import { Column } from "primereact/column";
import { DataTable } from "primereact/datatable";
import { Dropdown } from "primereact/dropdown";
import { InputMask } from "primereact/inputmask";
import { InputText } from "primereact/inputtext";
import { Menu } from "primereact/menu";
import { MultiSelect } from "primereact/multiselect";
import { createPortal } from "react-dom";
import "./liga-listagem-base.css";
import { LigaListagemBarraFiltrosAtivos } from "./LigaListagemBarraFiltrosAtivos";
import { LigaListagemFiltroRefinadoSidebarForm } from "./LigaListagemFiltroRefinadoSidebar";
import { aplicarFiltrosRefinados } from "./liga-listagem-filtro-refinado";
import type {
  LigaColunaListagem,
  LigaFiltroRefinadoValor,
  LigaListagemOrdenacaoInicial,
  LigaPaginacaoServidorProps,
  LigaPesquisaServidorPayload,
} from "./liga-listagem.types";
import {
  mascaraPrimePorTipo,
  normalizarTermoBuscaServidor,
  resolverMascaraBuscaServidor,
  validarTermoBuscaMascara,
} from "./liga-listagem-mascara-busca";
import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import { useTelaAtivaSlugOpcional } from "@/contexts/TelaAtivaContext";
import { usePermissaoPerfilTelaAtiva } from "@/hooks/usePermissaoPerfilTelaAtiva";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";
import {
  executarComPrecheckSessao,
  solicitarReautenticacaoGlobal,
} from "@/lib/autenticacao/withSessionGuard";
import { ordenarColunasListagemCrud } from "./liga-listagem-ordenacao-colunas";
import {
  ehValorTipoDataListagem,
  formatarApenasDiaListagemPtBr,
  formatarDataHoraListagemPtBr,
} from "@/lib/formatar-data-listagem";
import { atributosSemSugestaoBrowser } from "@/lib/input-sem-sugestao-browser";
import { somenteDigitos } from "@/lib/mascara-para-api";

/** Tempo sem nova alteração nos filtros refinados antes de notificar o pai (consulta no servidor). */
const ATRASO_MS_FILTRO_REFINADO_SERVIDOR = 2000;

function contarFiltrosRefinadoAtivos(
  f: Record<string, LigaFiltroRefinadoValor | undefined>,
): number {
  return Object.values(f).filter((v) => v != null).length;
}

/** Nome de arquivo seguro para download CSV (sem caracteres proibidos no Windows). */
function nomeArquivoExportacaoListagem(nomeTabela: string): string {
  const s = nomeTabela
    .trim()
    .replace(/[\\/:*?"<>|]+/g, "")
    .replace(/\s+/g, "_")
    .slice(0, 120);
  return s.length > 0 ? s : "listagem";
}

export type {
  LigaColunaListagem,
  LigaListagemOrdenacaoInicial,
  LigaMascaraBuscaServidor,
  LigaPaginacaoServidorProps,
  LigaPesquisaServidorPayload,
} from "./liga-listagem.types";

function escapeRegExp(texto: string) {
  return texto.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

/** Placeholder dinâmico: cabeçalhos mistos → minúsculas (ex.: Nome → nome); siglas só maiúsculas → mantidas (ex.: CPF). */
function rotuloParaPlaceholderBusca(cabecalho: string): string {
  const s = cabecalho.trim();
  if (!s) return "";
  const temMinuscula = /[a-zà-ÿ]/.test(s);
  if (
    !temMinuscula &&
    s.length <= 16 &&
    /^[A-ZÀ-Ü0-9\s]+$/.test(s)
  ) {
    return s;
  }
  return s.toLocaleLowerCase("pt-BR");
}

function compararValorCelula(a: unknown, b: unknown, ordem: 1 | -1): number {
  if (a == null && b == null) return 0;
  if (a == null) return ordem;
  if (b == null) return -ordem;
  if (
    typeof a === "number" &&
    typeof b === "number" &&
    !Number.isNaN(a) &&
    !Number.isNaN(b)
  ) {
    return ordem * (a - b);
  }
  return (
    ordem *
    String(a).localeCompare(String(b), undefined, {
      numeric: true,
      sensitivity: "base",
    })
  );
}

function LigaListagemCarregandoSplash({
  titulo,
  subtitulo,
}: {
  titulo: string;
  subtitulo: string;
}) {
  return (
    <div
      className="liga-listagem-carregando-splash"
      role="status"
      aria-live="polite"
      aria-busy="true"
    >
      <div className="liga-listagem-carregando-visual" aria-hidden>
        <span className="liga-listagem-carregando-anel" />
        <span className="liga-listagem-carregando-nucleo" />
      </div>
      <p className="liga-listagem-carregando-texto-principal">{titulo}</p>
      <p className="liga-listagem-carregando-texto-dica">{subtitulo}</p>
      <div className="liga-listagem-carregando-pontos" aria-hidden>
        <span />
        <span />
        <span />
      </div>
    </div>
  );
}

type FormatadoresValorCelulaListagem = {
  ativo: string;
  inativo: string;
  simComLetra: string;
  naoComLetra: string;
};

/** Normaliza valores típicos de SN para §11.7 (persistência pode ser S/N ou boolean). */
function normalizarSnValorListagem(valor: unknown): "S" | "N" | "" {
  if (valor === true) return "S";
  if (valor === false) return "N";
  if (valor == null || valor === "") return "";
  const u = String(valor).trim().toUpperCase();
  if (u === "S" || u === "SIM") return "S";
  if (u === "N" || u === "NAO" || u === "NÃO") return "N";
  return "";
}

function modoValorExibicaoColuna(
  col: LigaColunaListagem,
): "padrao" | "ativoInativo" | "simNao" {
  if (col.valorExibicao != null) return col.valorExibicao;
  if (col.campo === "ativo") return "ativoInativo";
  return "padrao";
}

function textoCelulaListagem(
  valor: unknown,
  col: LigaColunaListagem,
  fmt: FormatadoresValorCelulaListagem,
): string {
  const modoVal = modoValorExibicaoColuna(col);
  if (modoVal === "ativoInativo") {
    if (valor === true) return fmt.ativo;
    if (valor === false) return fmt.inativo;
    const sn = normalizarSnValorListagem(valor);
    if (sn === "S") return fmt.ativo;
    if (sn === "N") return fmt.inativo;
    return valor === null || valor === undefined ? "" : String(valor);
  }
  if (modoVal === "simNao") {
    if (valor === true) return fmt.simComLetra;
    if (valor === false) return fmt.naoComLetra;
    const sn = normalizarSnValorListagem(valor);
    if (sn === "S") return fmt.simComLetra;
    if (sn === "N") return fmt.naoComLetra;
    return valor === null || valor === undefined ? "" : String(valor);
  }

  const modo = col.formatoDataListagem ?? "auto";
  if (modo === "texto") {
    return valor === null || valor === undefined ? "" : String(valor);
  }
  if (modo === "data") {
    if (!ehValorTipoDataListagem(valor)) {
      return valor === null || valor === undefined ? "" : String(valor);
    }
    return formatarApenasDiaListagemPtBr(valor);
  }
  if (modo === "dataHora") {
    if (!ehValorTipoDataListagem(valor)) {
      return valor === null || valor === undefined ? "" : String(valor);
    }
    return formatarDataHoraListagemPtBr(valor);
  }
  if (ehValorTipoDataListagem(valor)) return formatarDataHoraListagemPtBr(valor);
  return valor === null || valor === undefined ? "" : String(valor);
}

function celulaComDestaque(valor: unknown, termoBusca: string): ReactNode {
  const str = valor === null || valor === undefined ? "" : String(valor);
  const t = termoBusca.trim();
  if (!t) return str;
  let re: RegExp;
  try {
    re = new RegExp(`(${escapeRegExp(t)})`, "gi");
  } catch {
    return str;
  }
  const partes = str.split(re);
  if (partes.length < 2) return str;
  return partes.map((parte, i) => {
    if (parte === "") {
      return <Fragment key={`q-${t}-${i}-empty`} />;
    }
    if (parte.toLowerCase() === t.toLowerCase()) {
      return (
        <mark
          key={`q-${t}-${i}-m`}
          className="liga-listagem-busca-destaque"
        >
          {parte}
        </mark>
      );
    }
    return (
      <span key={`q-${t}-i${i}-txt`}>{parte}</span>
    );
  });
}

/** Destaca trechos de `texto` que coincidem com `termoBusca` (mesmo `<mark>` da busca da listagem). */
export function ligaListagemCelulaComDestaqueTexto(
  texto: string,
  termoBusca: string,
): ReactNode {
  return celulaComDestaque(texto, termoBusca);
}

type LigaListagemBaseProps = {
  nomeTabela: string;
  listarTodos: boolean;
  registros: Record<string, unknown>[];
  colunas: LigaColunaListagem[];
  camposBuscaExtras?: string[];
  chavePrimaria: string;
  linhasPorPaginaPadrao?: number;
  opcoesLinhasPorPagina?: number[];
  textoBotaoNovo: string;
  placeholderBusca: string;
  textoNenhumRegistro: string;
  aoNovo?: () => void;
  aoLimparBusca?: () => void;
  aoAcaoLinha?: (registro: Record<string, unknown>) => void;
  ariaLabelAcaoLinha?: string;
  /** Segunda ação na mesma coluna (ex.: abrir mapa / grade). */
  aoAcaoLinhaSecundaria?: (registro: Record<string, unknown>) => void;
  ariaLabelAcaoLinhaSecundaria?: string;
  /** PrimeIcons, ex. `pi-th-large`. Default `pi-th-large`. */
  iconeAcaoLinhaSecundaria?: string;
  /** Exibe o título "Ações" no cabeçalho da coluna (default: só leitores de tela). */
  tituloColunaAcoesVisivel?: boolean;
  ordenacaoInicial?: LigaListagemOrdenacaoInicial;
  iconeTitulo?: string;
  subtitulo?: string;
  carregando?: boolean;
  modoSelecao?: boolean;
  acaoLinhaSomenteConsulta?: boolean;
  permitirNovoEmModoSelecao?: boolean;
  codigoTela?: string;
  buscaInicial?: string;
  botaoNovoDesabilitado?: boolean;
  mensagemBotaoNovoBloqueado?: string | null;
  /**
   * `memoria` = comportamento legado (filtro local + paginação no cliente).
   * `servidor` = dados paginados no backend; exige `paginacaoServidor` e normalmente `aoPesquisarServidor`.
   */
  fonteListagem?: "memoria" | "servidor";
  /** Obrigatório quando `fonteListagem === "servidor"`. */
  paginacaoServidor?: LigaPaginacaoServidorProps;
  /** Busca no banco ao pressionar Enter (modo servidor). */
  aoPesquisarServidor?: (payload: LigaPesquisaServidorPayload) => void;
  /**
   * Chamado ao mudar o campo da busca no dropdown (modo servidor).
   * Use para manter `campoPesquisa` do estado pai alinhado ao dropdown e limpar o termo ao trocar de coluna.
   */
  aoCampoPesquisaServidorChange?: (campoPesquisaApi: string) => void;
  /**
   * Modo servidor: repassa filtros refinados ao pai para aplicar no SQL (todas as páginas).
   * Quando definido, o grid não reaplica `aplicarFiltrosRefinados` no cliente — os dados já vêm filtrados.
   * A notificação ao pai usa debounce (2 s após a última mudança), exceto ao remover um filtro
   * (menos critérios ativos), quando a consulta é disparada na hora.
   */
  aoFiltrosRefinadoServidor?: (
    filtros: Record<string, LigaFiltroRefinadoValor | undefined>,
  ) => void;
  /**
   * Quando `false`, não exibe sidebar de filtro refinado.
   * Default: `true` se existir coluna com `filtroRefinado`.
   */
  habilitarFiltroRefinado?: boolean;
  /**
   * Seletor de colunas visíveis.
   * Default: `true` se existir coluna com `ocultavel !== false`.
   */
  habilitarSeletorColunas?: boolean;
  /** Exibe botão Exportar (CSV nativo; PDF no menu, desabilitado até implementação futura). Default: true. */
  habilitarExportacao?: boolean;
  /**
   * Quando `true`, não renderiza o cabeçalho interno (título `nomeTabela` + subtítulo).
   * Use com `hostPortalCabecalhoAcoes` para portar Exportar/Novo ao cabeçalho do módulo (shell).
   */
  omitirCabecalhoPagina?: boolean;
  /** Destino DOM para portal das ações Exportar + Novo (ex.: container na linha do título do módulo). */
  hostPortalCabecalhoAcoes?: HTMLElement | null;
  /** `id` do título visível para `aria-labelledby` da seção (obrigatório quando `omitirCabecalhoPagina`). */
  idTituloListagemAcessivel?: string;
};

export function LigaListagemBase({
  nomeTabela,
  listarTodos,
  registros,
  colunas,
  camposBuscaExtras,
  chavePrimaria,
  linhasPorPaginaPadrao = 10,
  opcoesLinhasPorPagina = [5, 10, 20, 50],
  textoBotaoNovo,
  placeholderBusca,
  textoNenhumRegistro,
  aoNovo,
  aoLimparBusca,
  aoAcaoLinha,
  ariaLabelAcaoLinha,
  aoAcaoLinhaSecundaria,
  ariaLabelAcaoLinhaSecundaria,
  iconeAcaoLinhaSecundaria = "pi-th-large",
  tituloColunaAcoesVisivel = false,
  ordenacaoInicial,
  iconeTitulo,
  subtitulo,
  carregando = false,
  modoSelecao = false,
  acaoLinhaSomenteConsulta = false,
  permitirNovoEmModoSelecao = false,
  codigoTela,
  buscaInicial = "",
  botaoNovoDesabilitado = false,
  mensagemBotaoNovoBloqueado = null,
  fonteListagem = "memoria",
  paginacaoServidor,
  aoPesquisarServidor,
  aoCampoPesquisaServidorChange,
  aoFiltrosRefinadoServidor,
  habilitarFiltroRefinado: habilitarFiltroRefinadoProp,
  habilitarSeletorColunas: habilitarSeletorColunasProp,
  habilitarExportacao = true,
  omitirCabecalhoPagina = false,
  hostPortalCabecalhoAcoes = null,
  idTituloListagemAcessivel = "liga-listagem-titulo-principal",
}: LigaListagemBaseProps) {
  const t = useTranslations("home");
  const colunasOrdenadas = useMemo(
    () => ordenarColunasListagemCrud(colunas, chavePrimaria),
    [colunas, chavePrimaria],
  );
  const formatadoresValorCelula = useMemo(
    (): FormatadoresValorCelulaListagem => ({
      ativo: t("listagem.comum.valorCelulaAtivo"),
      inativo: t("listagem.comum.valorCelulaInativo"),
      simComLetra: t("listagem.comum.valorCelulaSimComLetra"),
      naoComLetra: t("listagem.comum.valorCelulaNaoComLetra"),
    }),
    [t],
  );
  const feedback = useLigaFeedback();
  const sessao = useSessaoAtual();
  const slugTelaAtivaShell = useTelaAtivaSlugOpcional();
  const { tela, permissoes, permissoesCarregadas } = usePermissaoPerfilTelaAtiva(codigoTela);

  /** Com `appendTo={document.body}`, painéis do Prime podem ficar órfãos ou com posição inválida ao trocar de aba na home até um relayout (ex.: abrir o filtro refinado). */
  useLayoutEffect(() => {
    if (typeof document === "undefined") return;
    document
      .querySelectorAll(".p-dropdown-panel.liga-listagem-pesquisar-por-panel")
      .forEach((el) => {
        el.parentElement?.removeChild(el);
      });
    window.dispatchEvent(new Event("resize"));
  }, [nomeTabela, slugTelaAtivaShell]);

  const buscaWrapperRef = useRef<HTMLDivElement | null>(null);
  const toggleRefinadoRef = useRef<HTMLButtonElement | null>(null);
  const ignorarPrimeiraSyncFiltroServidor = useRef(true);
  const filtrosRefinadoAnteriorServidorRef = useRef<
    Record<string, LigaFiltroRefinadoValor | undefined>
  >({});
  const timeoutFiltroRefinadoServidorRef = useRef<number | null>(null);
  const pulouDebounceFiltroRefinadoRef = useRef(false);
  const dataTableListagemRef = useRef<ComponentRef<typeof DataTable>>(null);
  const menuExportRef = useRef<ComponentRef<typeof Menu>>(null);
  const [menuExportAberto, setMenuExportAberto] = useState(false);

  const [entradaBusca, setEntradaBusca] = useState("");
  const [termoBuscaAplicado, setTermoBuscaAplicado] = useState("");
  const [first, setFirst] = useState(0);
  const [linhasPagina, setLinhasPagina] = useState(linhasPorPaginaPadrao);
  const [ordenacaoCampo, setOrdenacaoCampo] = useState<string | null>(
    ordenacaoInicial?.campo ?? null,
  );
  const [ordenacaoOrdem, setOrdenacaoOrdem] = useState<1 | -1 | null>(
    ordenacaoInicial?.ordem ?? null,
  );

  const [painelRefinadoAberto, setPainelRefinadoAberto] = useState(false);
  const [filtrosRefinado, setFiltrosRefinado] = useState<
    Record<string, LigaFiltroRefinadoValor | undefined>
  >({});

  const colunasComPesquisaServidor = useMemo(
    () => colunasOrdenadas.filter((c) => c.pesquisaServidor === true),
    [colunasOrdenadas],
  );

  const [indiceCampoPesquisa, setIndiceCampoPesquisa] = useState(0);

  useEffect(() => {
    setIndiceCampoPesquisa(0);
  }, [colunasComPesquisaServidor.length]);

  const opcoesDropdownPesquisa = useMemo(
    () =>
      colunasComPesquisaServidor.map((c, i) => ({
        label: c.cabecalho,
        value: i,
      })),
    [colunasComPesquisaServidor],
  );

  const temRefinadoColunas = useMemo(
    () => colunasOrdenadas.some((c) => c.filtroRefinado != null),
    [colunasOrdenadas],
  );
  const habilitarFiltroRefinado =
    habilitarFiltroRefinadoProp !== false && temRefinadoColunas;

  const temColunasOcultaveis = useMemo(
    () => colunasOrdenadas.some((c) => c.ocultavel !== false),
    [colunasOrdenadas],
  );
  const habilitarSeletorColunas =
    habilitarSeletorColunasProp !== false && temColunasOcultaveis;

  const [colunasVisiveis, setColunasVisiveis] = useState<Set<string>>(() => {
    const s = new Set<string>();
    for (const c of colunasOrdenadas) {
      if (c.visivelPadrao !== false) s.add(c.campo);
    }
    return s;
  });

  useEffect(() => {
    setColunasVisiveis((prev) => {
      const next = new Set<string>();
      for (const c of colunasOrdenadas) {
        if (prev.has(c.campo) || c.visivelPadrao !== false) next.add(c.campo);
      }
      if (next.size === 0 && colunasOrdenadas.length > 0) {
        for (const c of colunasOrdenadas) next.add(c.campo);
      }
      return next;
    });
  }, [colunasOrdenadas]);

  const colunasExibidas = useMemo(
    () => colunasOrdenadas.filter((c) => colunasVisiveis.has(c.campo)),
    [colunasOrdenadas, colunasVisiveis],
  );

  const opcoesSeletorColunas = useMemo(
    () =>
      colunasOrdenadas
        .filter((c) => c.ocultavel !== false)
        .map((c) => ({ label: c.cabecalho, value: c.campo })),
    [colunasOrdenadas],
  );

  const valoresSeletorColunas = useMemo(
    () => colunasExibidas.map((c) => c.campo).filter((campo) =>
      colunasOrdenadas.some((x) => x.campo === campo && x.ocultavel !== false),
    ),
    [colunasOrdenadas, colunasExibidas],
  );

  const baseDados = useMemo(() => {
    if (fonteListagem === "servidor") return registros;
    return listarTodos ? registros : registros.slice(0, 10);
  }, [fonteListagem, listarTodos, registros]);

  const aplicarFiltroRefinadoLocal =
    fonteListagem !== "servidor" || !aoFiltrosRefinadoServidor;

  const aposRefinados = useMemo(() => {
    if (!aplicarFiltroRefinadoLocal) return baseDados;
    return aplicarFiltrosRefinados(baseDados, colunasOrdenadas, filtrosRefinado);
  }, [
    aplicarFiltroRefinadoLocal,
    baseDados,
    colunasOrdenadas,
    filtrosRefinado,
  ]);

  const camposFiltroGlobais = useMemo(() => {
    const base = colunasOrdenadas.map((c) => c.campo).filter(Boolean);
    const extras = camposBuscaExtras ?? [];
    const junto = [...base];
    for (const e of extras) {
      if (e && !junto.includes(e)) junto.push(e);
    }
    return junto;
  }, [colunasOrdenadas, camposBuscaExtras]);

  const filtrados = useMemo(() => {
    if (fonteListagem === "servidor") return aposRefinados;
    const termo = termoBuscaAplicado.trim().toLowerCase();
    if (!termo) return aposRefinados;
    return aposRefinados.filter((row) =>
      camposFiltroGlobais.some((campo) => {
        const v = row[campo];
        return v != null && String(v).toLowerCase().includes(termo);
      }),
    );
  }, [
    fonteListagem,
    aposRefinados,
    termoBuscaAplicado,
    camposFiltroGlobais,
  ]);

  const ordenados = useMemo(() => {
    if (!ordenacaoCampo || ordenacaoOrdem == null) return filtrados;
    const campo = ordenacaoCampo;
    const ordem = ordenacaoOrdem;
    return [...filtrados].sort((a, b) =>
      compararValorCelula(a[campo], b[campo], ordem),
    );
  }, [filtrados, ordenacaoCampo, ordenacaoOrdem]);

  const exportarCsvListagem = useCallback(() => {
    const base = nomeArquivoExportacaoListagem(nomeTabela);
    const dt = dataTableListagemRef.current as unknown as {
      exportCSV?: (opts?: {
        selectionOnly?: boolean;
        fileName?: string;
      }) => void;
    };
    dt?.exportCSV?.({ selectionOnly: false, fileName: `${base}.csv` });
  }, [nomeTabela]);

  const itensMenuExportacao = useMemo<MenuItem[]>(
    () => [
      {
        label: t("listagem.comum.exportarCsv"),
        icon: "pi pi-file",
        command: exportarCsvListagem,
      },
      {
        label: t("listagem.comum.exportarPdf"),
        icon: "pi pi-file-pdf",
        disabled: true,
        title: t("listagem.comum.exportarPdfEmBreve"),
      },
    ],
    [t, exportarCsvListagem],
  );

  const totalFiltrado = ordenados.length;

  const modoServidor = fonteListagem === "servidor";
  const pag = paginacaoServidor;

  const maxFirst =
    totalFiltrado === 0
      ? 0
      : Math.floor((totalFiltrado - 1) / linhasPagina) * linhasPagina;
  const primeiroMemoria = Math.min(first, maxFirst);

  const primeiroIndiceGrid = modoServidor ? (pag?.primeiroIndice ?? 0) : primeiroMemoria;
  const linhasGrid = modoServidor
    ? (pag?.linhasPorPagina ?? linhasPorPaginaPadrao)
    : linhasPagina;
  const totalRecordsGrid = modoServidor
    ? (pag?.totalRegistros ?? 0)
    : totalFiltrado;

  const placeholderBuscaAtivo = useMemo(() => {
    if (!modoServidor || colunasComPesquisaServidor.length === 0) {
      return placeholderBusca;
    }
    const col = colunasComPesquisaServidor[indiceCampoPesquisa];
    const nomeCampo = col?.cabecalho?.trim() ?? "";
    if (!nomeCampo) return placeholderBusca;
    return t("listagem.comum.buscaPlaceholderPorCampo", {
      campo: rotuloParaPlaceholderBusca(nomeCampo),
    });
  }, [
    modoServidor,
    colunasComPesquisaServidor,
    indiceCampoPesquisa,
    placeholderBusca,
    t,
  ]);

  /** PrimeReact substitui `{0}` pela quantidade; o literal não pode vir do JSON com ICU do next-intl. */
  const rotuloSelectedItemsColunas = useMemo(
    () => `{0} ${t("listagem.comum.colunasSelecionadasRotulo")}`,
    [t],
  );

  const colunaAtivaPesquisaServidor = useMemo(() => {
    if (!modoServidor || opcoesDropdownPesquisa.length === 0) return undefined;
    return colunasComPesquisaServidor[indiceCampoPesquisa];
  }, [
    modoServidor,
    opcoesDropdownPesquisa.length,
    colunasComPesquisaServidor,
    indiceCampoPesquisa,
  ]);

  const tipoMascaraBuscaServidor = useMemo(
    () => resolverMascaraBuscaServidor(colunaAtivaPesquisaServidor),
    [colunaAtivaPesquisaServidor],
  );

  const primeMaskBuscaServidor = useMemo(() => {
    if (!tipoMascaraBuscaServidor) return null;
    return mascaraPrimePorTipo(tipoMascaraBuscaServidor);
  }, [tipoMascaraBuscaServidor]);

  const mostrarColunaAcao = Boolean(
    (aoAcaoLinha && ariaLabelAcaoLinha) ||
      (aoAcaoLinhaSecundaria && ariaLabelAcaoLinhaSecundaria),
  );

  function aoMudarPagina(patch: { first?: number; rows?: number }) {
    if (modoServidor && pag) {
      pag.aoPaginar({
        primeiroIndice: patch.first ?? 0,
        linhasPorPagina: patch.rows ?? linhasPorPaginaPadrao,
      });
      return;
    }
    setFirst(patch.first ?? 0);
    setLinhasPagina(patch.rows ?? linhasPorPaginaPadrao);
  }

  function aplicarQuickSearch() {
    const colAtiva =
      modoServidor && opcoesDropdownPesquisa.length > 0
        ? colunasComPesquisaServidor[indiceCampoPesquisa]
        : undefined;
    const campoApi =
      colAtiva != null
        ? (colAtiva.campoConsulta ?? colAtiva.campo).trim()
        : "";
    const bruto = entradaBusca.trim();

    if (modoServidor && aoPesquisarServidor && campoApi !== "") {
      const tipoMascara = resolverMascaraBuscaServidor(colAtiva);
      if (tipoMascara && bruto !== "") {
        const val = validarTermoBuscaMascara(colAtiva, bruto);
        if (!val.ok) {
          feedback.aviso(t(val.chaveI18n));
          return;
        }
      }
      const termo = normalizarTermoBuscaServidor(colAtiva, bruto);
      aoPesquisarServidor({
        termo,
        campoPesquisa: campoApi,
      });
      setTermoBuscaAplicado(termo);
      return;
    }

    setTermoBuscaAplicado(bruto);
    setFirst(0);
  }

  const aplicarQuickSearchRef = useRef(aplicarQuickSearch);
  aplicarQuickSearchRef.current = aplicarQuickSearch;

  /**
   * Modo servidor + máscara CPF/CNPJ: ao completar todos os dígitos, dispara a busca sem exigir Enter
   * (evita sensação de “digitei e não foi no banco”).
   * `aoPesquisarServidor` não entra nas deps: callback inline no pai reiniciaria o debounce a cada render.
   */
  useEffect(() => {
    if (!modoServidor || !aoPesquisarServidor || opcoesDropdownPesquisa.length === 0) {
      return;
    }
    const tipo = tipoMascaraBuscaServidor;
    if (tipo !== "cpf" && tipo !== "cnpj") return;
    const colAtiva = colunasComPesquisaServidor[indiceCampoPesquisa];
    if (!colAtiva) return;
    const bruto = entradaBusca.trim();
    const d = somenteDigitos(bruto);
    const completo =
      (tipo === "cpf" && d.length === 11) ||
      (tipo === "cnpj" && d.length === 14);
    if (!completo) return;
    const termoNorm = normalizarTermoBuscaServidor(colAtiva, bruto);
    if (termoNorm === termoBuscaAplicado) return;
    const val = validarTermoBuscaMascara(colAtiva, bruto);
    if (!val.ok) return;
    const idTimeout = window.setTimeout(() => {
      aplicarQuickSearchRef.current();
    }, 400);
    return () => window.clearTimeout(idTimeout);
    // eslint-disable-next-line react-hooks/exhaustive-deps -- aoPesquisarServidor instável (inline no pai)
  }, [
    modoServidor,
    opcoesDropdownPesquisa.length,
    tipoMascaraBuscaServidor,
    colunasComPesquisaServidor,
    indiceCampoPesquisa,
    entradaBusca,
    termoBuscaAplicado,
  ]);

  function limparQuickSearch() {
    setEntradaBusca("");
    setTermoBuscaAplicado("");
    setFirst(0);
    setLinhasPagina(linhasPorPaginaPadrao);
    const colAtiva =
      modoServidor && opcoesDropdownPesquisa.length > 0
        ? colunasComPesquisaServidor[indiceCampoPesquisa]
        : undefined;
    const campoApi =
      colAtiva != null
        ? (colAtiva.campoConsulta ?? colAtiva.campo).trim()
        : "";
    if (modoServidor && aoPesquisarServidor && campoApi !== "") {
      aoPesquisarServidor({ termo: "", campoPesquisa: campoApi });
    }
    aoLimparBusca?.();
  }

  const quickSearchTemConteudo =
    entradaBusca.trim() !== "" || termoBuscaAplicado !== "";

  const filtrosAtivosLista = useMemo(
    () =>
      Object.entries(filtrosRefinado).filter(
        (e): e is [string, LigaFiltroRefinadoValor] => e[1] != null,
      ),
    [filtrosRefinado],
  );

  useEffect(() => {
    const inputBusca = buscaWrapperRef.current?.querySelector("input");
    if (!inputBusca) return;
    inputBusca.focus();
    inputBusca.select();
  }, []);

  useEffect(() => {
    const termo = buscaInicial.trim();
    setEntradaBusca(termo);
    setTermoBuscaAplicado(termo);
    setFirst(0);
  }, [buscaInicial]);

  const indiceCampoPesquisaAnterior = useRef<number | null>(null);
  useEffect(() => {
    if (!modoServidor || opcoesDropdownPesquisa.length === 0) {
      indiceCampoPesquisaAnterior.current = indiceCampoPesquisa;
      return;
    }
    if (
      indiceCampoPesquisaAnterior.current !== null &&
      indiceCampoPesquisaAnterior.current !== indiceCampoPesquisa
    ) {
      setEntradaBusca("");
      setTermoBuscaAplicado("");
    }
    indiceCampoPesquisaAnterior.current = indiceCampoPesquisa;
  }, [indiceCampoPesquisa, modoServidor, opcoesDropdownPesquisa.length]);

  useEffect(() => {
    window.dispatchEvent(
      new CustomEvent("liga:debug-painel-ativo", {
        detail: { tipo: "listagem", nomeTabela },
      }),
    );
  }, [nomeTabela]);

  useEffect(() => {
    if (fonteListagem !== "servidor" || !aoFiltrosRefinadoServidor) return;
    if (ignorarPrimeiraSyncFiltroServidor.current) {
      ignorarPrimeiraSyncFiltroServidor.current = false;
      filtrosRefinadoAnteriorServidorRef.current = filtrosRefinado;
      return;
    }

    if (pulouDebounceFiltroRefinadoRef.current) {
      pulouDebounceFiltroRefinadoRef.current = false;
      filtrosRefinadoAnteriorServidorRef.current = filtrosRefinado;
      return;
    }

    const anterior = filtrosRefinadoAnteriorServidorRef.current;
    const removendoAlgumFiltro =
      contarFiltrosRefinadoAtivos(filtrosRefinado) <
      contarFiltrosRefinadoAtivos(anterior);
    filtrosRefinadoAnteriorServidorRef.current = filtrosRefinado;

    if (removendoAlgumFiltro) {
      aoFiltrosRefinadoServidor(filtrosRefinado);
      return;
    }

    const id = window.setTimeout(() => {
      aoFiltrosRefinadoServidor(filtrosRefinado);
    }, ATRASO_MS_FILTRO_REFINADO_SERVIDOR);
    timeoutFiltroRefinadoServidorRef.current = id;
    return () => {
      window.clearTimeout(id);
      timeoutFiltroRefinadoServidorRef.current = null;
    };
  }, [filtrosRefinado, fonteListagem, aoFiltrosRefinadoServidor]);

  function notificarFiltrosRefinadoServidorImediato(
    filtros: Record<string, LigaFiltroRefinadoValor | undefined>,
  ) {
    if (fonteListagem !== "servidor" || !aoFiltrosRefinadoServidor) return;
    const pendente = timeoutFiltroRefinadoServidorRef.current;
    if (pendente != null) {
      window.clearTimeout(pendente);
      timeoutFiltroRefinadoServidorRef.current = null;
    }
    pulouDebounceFiltroRefinadoRef.current = true;
    filtrosRefinadoAnteriorServidorRef.current = filtros;
    aoFiltrosRefinadoServidor(filtros);
    setFiltrosRefinado(filtros);
  }

  const aguardandoDefinicoes =
    !sessao.sessaoCarregada || (!!tela && !permissoesCarregadas);

  if (aguardandoDefinicoes) {
    return (
      <section className="liga-listagem-base" aria-labelledby={idTituloListagemAcessivel}>
        <LigaListagemCarregandoSplash
          titulo={t("listagem.comum.carregando")}
          subtitulo={t("listagem.comum.carregandoDica")}
        />
      </section>
    );
  }

  function aoOrdenar(evento: DataTableStateEvent) {
    setOrdenacaoCampo(
      typeof evento.sortField === "string" ? evento.sortField : null,
    );
    const ordem = evento.sortOrder;
    setOrdenacaoOrdem(
      ordem === 1 || ordem === -1 ? ordem : null,
    );
    if (!modoServidor) setFirst(0);
  }

  const corpoAcao = (linha: Record<string, unknown>) => {
    const desabilitarAcaoPrincipal =
      !modoSelecao && !acaoLinhaSomenteConsulta && !permissoesCarregadas;

    const botaoPrincipal = aoAcaoLinha && ariaLabelAcaoLinha && (
      <button
        key="acao-principal"
        type="button"
        className="liga-listagem-acao-icone"
        disabled={desabilitarAcaoPrincipal}
        onClick={() => {
          const executar = async () => {
            await executarComPrecheckSessao(
              () => {
                if (modoSelecao) {
                  aoAcaoLinha(linha);
                  return;
                }
                if (acaoLinhaSomenteConsulta) {
                  aoAcaoLinha(linha);
                  return;
                }
                if (!permissoesCarregadas) return;
                if (!permissoes.editar) {
                  feedback.aviso(
                    `Perfil sem permissao para editar nesta tela (${tela ?? "nao identificada"}). Permissoes: incluir=${permissoes.incluir ? "S" : "N"}, editar=${permissoes.editar ? "S" : "N"}, excluir=${permissoes.excluir ? "S" : "N"}.`,
                  );
                  return;
                }
                aoAcaoLinha(linha);
              },
              (acaoPendente) =>
                solicitarReautenticacaoGlobal(() => void acaoPendente()),
            );
          };
          void executar();
        }}
        aria-label={ariaLabelAcaoLinha}
      >
        <i
          className={
            modoSelecao
              ? "pi pi-check"
              : acaoLinhaSomenteConsulta
                ? "pi pi-eye"
                : "pi pi-pencil"
          }
          aria-hidden="true"
        />
      </button>
    );

    const botaoSecundario =
      aoAcaoLinhaSecundaria &&
      ariaLabelAcaoLinhaSecundaria &&
      !modoSelecao &&
      !acaoLinhaSomenteConsulta ? (
        <button
          key="acao-secundaria"
          type="button"
          className="liga-listagem-acao-icone"
          disabled={!permissoesCarregadas}
          onClick={() => {
            void executarComPrecheckSessao(
              () => {
                if (!permissoesCarregadas) return;
                aoAcaoLinhaSecundaria(linha);
              },
              (acaoPendente) =>
                solicitarReautenticacaoGlobal(() => void acaoPendente()),
            );
          }}
          aria-label={ariaLabelAcaoLinhaSecundaria}
        >
          <i className={`pi ${iconeAcaoLinhaSecundaria}`} aria-hidden="true" />
        </button>
      ) : null;

    if (botaoSecundario) {
      return (
        <div className="liga-listagem-acoes-linha">
          {botaoPrincipal}
          {botaoSecundario}
        </div>
      );
    }

    return botaoPrincipal;
  };

  const cabecalhoAcoesJsx =
    habilitarExportacao || aoNovo ? (
      <div className="liga-listagem-titulo-acoes">
        {habilitarExportacao ? (
          <>
            <Button
              type="button"
              size="small"
              outlined
              className="liga-listagem-botao-novo liga-listagem-botao-export-dropdown"
              disabled={ordenados.length === 0}
              title={
                ordenados.length === 0 ? t("listagem.comum.nenhumRegistro") : undefined
              }
              aria-haspopup="menu"
              aria-expanded={menuExportAberto}
              onClick={(e) => menuExportRef.current?.toggle(e)}
            >
              <span className="liga-listagem-export-botao-conteudo">
                <i className="pi pi-download" aria-hidden />
                <span>{t("listagem.comum.exportar")}</span>
                <i className="pi pi-angle-down liga-listagem-export-seta" aria-hidden />
              </span>
            </Button>
            <Menu
              ref={menuExportRef}
              popup
              model={itensMenuExportacao}
              onShow={() => setMenuExportAberto(true)}
              onHide={() => setMenuExportAberto(false)}
              className="liga-listagem-menu-export"
            />
          </>
        ) : null}
        {aoNovo ? (
          <Button
            type="button"
            icon="pi pi-plus"
            label={textoBotaoNovo}
            className="liga-listagem-botao-novo"
            title={
              botaoNovoDesabilitado && mensagemBotaoNovoBloqueado
                ? mensagemBotaoNovoBloqueado
                : undefined
            }
            disabled={
              !permissoesCarregadas ||
              (modoSelecao && !permitirNovoEmModoSelecao) ||
              botaoNovoDesabilitado
            }
            onClick={() => {
              const executar = async () => {
                await executarComPrecheckSessao(
                  () => {
                    if (botaoNovoDesabilitado) {
                      if (mensagemBotaoNovoBloqueado) {
                        feedback.aviso(mensagemBotaoNovoBloqueado);
                      }
                      return;
                    }
                    if (modoSelecao && !permitirNovoEmModoSelecao) return;
                    if (!permissoes.incluir) {
                      feedback.aviso(
                        `Perfil sem permissao para incluir nesta tela (${tela ?? "nao identificada"}). Permissoes: incluir=${permissoes.incluir ? "S" : "N"}, editar=${permissoes.editar ? "S" : "N"}, excluir=${permissoes.excluir ? "S" : "N"}.`,
                      );
                      return;
                    }
                    aoNovo();
                  },
                  (acaoPendente) =>
                    solicitarReautenticacaoGlobal(() => void acaoPendente()),
                );
              };
              void executar();
            }}
          />
        ) : null}
      </div>
    ) : null;

  const portalCabecalhoAcoesDom =
    omitirCabecalhoPagina && hostPortalCabecalhoAcoes && cabecalhoAcoesJsx != null
      ? createPortal(cabecalhoAcoesJsx, hostPortalCabecalhoAcoes)
      : null;

  return (
    <section className="liga-listagem-base" aria-labelledby={idTituloListagemAcessivel}>
      {!omitirCabecalhoPagina ? (
        <header className="liga-listagem-pagina-cabecalho">
          <div className="liga-listagem-titulo-linha">
            <div className="liga-listagem-titulo-esquerda">
              <span className="liga-listagem-barra-verde" aria-hidden="true" />
              <h1 id="liga-listagem-titulo-principal" className="liga-listagem-titulo-principal">
                {iconeTitulo ? (
                  <i
                    className={`pi ${iconeTitulo} liga-listagem-titulo-icone`}
                    aria-hidden="true"
                  />
                ) : null}
                {nomeTabela}
              </h1>
            </div>
            {cabecalhoAcoesJsx}
          </div>
          {subtitulo ? (
            <p className="liga-listagem-subtitulo">{subtitulo}</p>
          ) : null}
        </header>
      ) : (
        <>
          {portalCabecalhoAcoesDom}
          {!hostPortalCabecalhoAcoes && cabecalhoAcoesJsx != null ? (
            <div className="liga-listagem-cabecalho-acoes-fallback">{cabecalhoAcoesJsx}</div>
          ) : null}
        </>
      )}

      <div className="liga-listagem-barra-ferramentas">
        <div className="liga-listagem-barra-metade-tela liga-listagem-barra-ferramentas--busca-e-novo">
          <div className="liga-listagem-toolbar-grupo-pesquisa">
            <div className="liga-listagem-toolbar-busca-linha">
            {habilitarFiltroRefinado ? (
              <button
                ref={toggleRefinadoRef}
                type="button"
                className="liga-listagem-refinado-toggle"
                aria-expanded={painelRefinadoAberto}
                aria-controls="liga-listagem-refinado-drawer"
                title={t("listagem.comum.filtroRefinadoAlternar")}
                onClick={() => setPainelRefinadoAberto((v) => !v)}
              >
                <i
                  className={
                    painelRefinadoAberto ? "pi pi-chevron-left" : "pi pi-chevron-right"
                  }
                  aria-hidden="true"
                />
              </button>
            ) : null}

            {modoServidor && opcoesDropdownPesquisa.length > 0 ? (
              <Dropdown
                key={`liga-listagem-dd-pesquisa-${nomeTabela}-${slugTelaAtivaShell ?? "fora-shell"}`}
                value={indiceCampoPesquisa}
                options={opcoesDropdownPesquisa}
                optionLabel="label"
                optionValue="value"
                onChange={(e) => {
                  const next = Number(e.value);
                  setIndiceCampoPesquisa(next);
                  const col = colunasComPesquisaServidor[next];
                  const api = (col?.campoConsulta ?? col?.campo ?? "").trim();
                  aoCampoPesquisaServidorChange?.(api);
                }}
                className="liga-listagem-pesquisar-por"
                panelClassName="liga-listagem-pesquisar-por-panel"
                appendTo={() => document.body}
                aria-label={t("listagem.comum.pesquisarPor")}
              />
            ) : null}

            <div className="liga-listagem-busca-wrap" ref={buscaWrapperRef}>
              <div
                className="liga-listagem-busca liga-listagem-busca-com-icones"
                onKeyDownCapture={(evento) => {
                  const alvo = evento.target;
                  if (!(alvo instanceof HTMLInputElement)) return;
                  if (evento.key !== "Enter" && evento.key !== "NumpadEnter") {
                    return;
                  }
                  evento.preventDefault();
                  evento.stopPropagation();
                  aplicarQuickSearch();
                }}
                role="search"
              >
                {primeMaskBuscaServidor ? (
                  <InputMask
                    key={`liga-busca-mask-${indiceCampoPesquisa}-${primeMaskBuscaServidor}`}
                    mask={primeMaskBuscaServidor}
                    value={entradaBusca}
                    onChange={(e) => setEntradaBusca(e.target?.value ?? "")}
                    {...atributosSemSugestaoBrowser()}
                    placeholder={placeholderBuscaAtivo}
                    className="liga-listagem-busca-input"
                    aria-label={placeholderBuscaAtivo}
                    title={t("listagem.comum.buscaAplicarComEnter")}
                  />
                ) : (
                  <InputText
                    {...atributosSemSugestaoBrowser()}
                    value={entradaBusca}
                    onChange={(evento) => setEntradaBusca(evento.target.value)}
                    placeholder={placeholderBuscaAtivo}
                    className="liga-listagem-busca-input"
                    aria-label={placeholderBuscaAtivo}
                    title={t("listagem.comum.buscaAplicarComEnter")}
                  />
                )}
                <div className="liga-listagem-busca-acoes-direita">
                  {quickSearchTemConteudo ? (
                    <button
                      type="button"
                      className="liga-listagem-busca-botao-icone"
                      onClick={limparQuickSearch}
                      aria-label={t("listagem.comum.limparBusca")}
                    >
                      <i className="pi pi-times" aria-hidden="true" />
                    </button>
                  ) : null}
                  <button
                    type="button"
                    className="liga-listagem-busca-botao-icone liga-listagem-busca-icone-lupa"
                    onClick={() => aplicarQuickSearch()}
                    aria-label={t("listagem.comum.buscaAplicar")}
                    title={t("listagem.comum.buscaAplicarComEnter")}
                  >
                    <i className="pi pi-search" aria-hidden="true" />
                  </button>
                </div>
              </div>
            </div>

            {habilitarSeletorColunas && opcoesSeletorColunas.length > 0 ? (
              <MultiSelect
                value={valoresSeletorColunas}
                options={opcoesSeletorColunas}
                onChange={(e) => {
                  let chosen = new Set<string>((e.value as string[]) ?? []);
                  for (const c of colunasOrdenadas) {
                    if (c.ocultavel === false) chosen.add(c.campo);
                  }
                  if (chosen.size === 0) {
                    chosen = new Set(colunasOrdenadas.map((c) => c.campo));
                  }
                  setColunasVisiveis(chosen);
                }}
                display="chip"
                maxSelectedLabels={1}
                selectedItemsLabel={rotuloSelectedItemsColunas}
                className="liga-listagem-seletor-colunas"
                placeholder={t("listagem.comum.colunasPlaceholder")}
                filter={false}
                aria-label={t("listagem.comum.colunasVisiveis")}
              />
            ) : null}
            </div>
          </div>

          {habilitarFiltroRefinado && filtrosAtivosLista.length > 0 ? (
            <LigaListagemBarraFiltrosAtivos
              colunas={colunasOrdenadas}
              filtrosAtivosLista={filtrosAtivosLista}
              setFiltrosRefinado={setFiltrosRefinado}
              t={t}
            />
          ) : null}
        </div>
      </div>

      <div className="liga-listagem-refinado-shell">
        {painelRefinadoAberto && habilitarFiltroRefinado ? (
          <>
            <button
              type="button"
              className="liga-listagem-refinado-backdrop"
              aria-label={t("listagem.comum.fecharFiltroRefinado")}
              onClick={() => setPainelRefinadoAberto(false)}
            />
            <aside
              id="liga-listagem-refinado-drawer"
              className="liga-listagem-refinado-drawer"
              role="dialog"
              aria-modal="true"
              aria-labelledby="liga-listagem-refinado-titulo"
            >
              <div className="liga-listagem-refinado-drawer-topo">
                <h2 id="liga-listagem-refinado-titulo" className="liga-listagem-refinado-titulo">
                  {t("listagem.comum.filtroRefinadoTitulo")}
                </h2>
                <button
                  type="button"
                  className="liga-listagem-refinado-fechar"
                  onClick={() => {
                    setPainelRefinadoAberto(false);
                    toggleRefinadoRef.current?.focus();
                  }}
                  aria-label={t("listagem.comum.fechar")}
                >
                  <i className="pi pi-times" aria-hidden="true" />
                </button>
              </div>
              <div className="liga-listagem-refinado-corpo">
                <LigaListagemFiltroRefinadoSidebarForm
                  colunas={colunasOrdenadas}
                  filtros={filtrosRefinado}
                  onChange={(campo, valor) =>
                    setFiltrosRefinado((prev) => ({ ...prev, [campo]: valor }))
                  }
                  pesquisarRefinadoServidorImediato={
                    fonteListagem === "servidor" && aoFiltrosRefinadoServidor
                      ? notificarFiltrosRefinadoServidorImediato
                      : undefined
                  }
                  feedbackAvisoRefinado={(chaveI18n) =>
                    feedback.aviso(t(chaveI18n))
                  }
                />
              </div>
            </aside>
          </>
        ) : null}

        <div className="liga-listagem-moldura-tabela">
        <DataTable
          ref={dataTableListagemRef}
          key={`liga-listagem-dt-${nomeTabela}`}
          value={ordenados}
          dataKey={chavePrimaria}
          className="liga-listagem-grid"
          loading={carregando}
          lazy={modoServidor}
          loadingIcon={
            <LigaListagemCarregandoSplash
              titulo={t("listagem.comum.carregando")}
              subtitulo={t("listagem.comum.carregandoDica")}
            />
          }
          emptyMessage={textoNenhumRegistro}
          paginator
          paginatorPosition="bottom"
          first={primeiroIndiceGrid}
          rows={linhasGrid}
          totalRecords={totalRecordsGrid}
          rowsPerPageOptions={opcoesLinhasPorPagina}
          paginatorTemplate="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink RowsPerPageDropdown"
          currentPageReportTemplate={t("listagem.comum.paginacaoIntervalo")}
          onPage={(e) => aoMudarPagina(e)}
          stripedRows
          sortField={ordenacaoCampo ?? undefined}
          sortOrder={ordenacaoOrdem ?? undefined}
          onSort={aoOrdenar}
          removableSort
        >
          {mostrarColunaAcao ? (
            <Column
              header={() =>
                tituloColunaAcoesVisivel ? (
                  <span className="liga-listagem-cabecalho-acoes-visivel">
                    {t("listagem.comum.colunaAcoes")}
                  </span>
                ) : (
                  <span className="liga-sr-only">
                    {t("listagem.comum.colunaAcoes")}
                  </span>
                )
              }
              body={corpoAcao}
              exportable={false}
              sortable={false}
              className="liga-listagem-coluna-acoes"
              headerClassName="liga-listagem-celula--nowrap"
              bodyClassName="liga-listagem-celula--nowrap"
              style={{
                width: aoAcaoLinhaSecundaria ? "min(7.25rem, 22vw)" : "3.465rem",
                textAlign: "center",
              }}
            />
          ) : null}
          {colunasExibidas.map((coluna) => {
            const ordenavel = coluna.ordenavel !== false;
            const align = coluna.alinhamento;
            const classeCelula =
              coluna.quebraLinhaTexto === true
                ? "liga-listagem-celula--quebra"
                : "liga-listagem-celula--nowrap";
            const estiloColuna: CSSProperties = {
              textAlign: align,
            };
            if (coluna.larguraMinPxMaisPercentual) {
              estiloColuna.minWidth = coluna.larguraMinPxMaisPercentual.px;
              estiloColuna.width = `calc(${coluna.larguraMinPxMaisPercentual.percentual}% + ${coluna.larguraMinPxMaisPercentual.px}px)`;
            } else if (coluna.larguraPercentual != null) {
              estiloColuna.width = `${coluna.larguraPercentual}%`;
            } else if (coluna.larguraPx != null && coluna.larguraPx > 0) {
              estiloColuna.width = `${coluna.larguraPx}px`;
            }
            if (coluna.larguraMinPx != null) {
              estiloColuna.minWidth = coluna.larguraMinPx;
            }
            return (
              <Column
                key={coluna.campo}
                field={coluna.campo}
                header={coluna.cabecalho}
                sortable={ordenavel}
                frozen={coluna.fixo === true}
                headerClassName={classeCelula}
                bodyClassName={classeCelula}
                style={estiloColuna}
                body={(linha) =>
                  coluna.corpoCelula ? (
                    coluna.corpoCelula(linha as Record<string, unknown>, {
                      termoBusca: termoBuscaAplicado,
                    })
                  ) : (
                    celulaComDestaque(
                      textoCelulaListagem(
                        linha[coluna.campo],
                        coluna,
                        formatadoresValorCelula,
                      ),
                      termoBuscaAplicado,
                    )
                  )
                }
              />
            );
          })}
        </DataTable>
        </div>
      </div>
    </section>
  );
}
