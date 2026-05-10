import type { LigaColunaListagem } from "@/components/formulario-pesquisa/liga-listagem.types";

function formatarMoedaBr(valor: unknown): string {
  const bruto = String(valor ?? "").trim();
  if (!bruto) return "—";
  const n = Number.parseFloat(bruto.replace(",", "."));
  if (!Number.isFinite(n)) return bruto;
  return n.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
}

/** Colunas alinhadas ao legado LancamentoReceita_Lst e ao DTO da API. */
export const CONTAS_RECEBER_INFOTIME_COLUNAS_LISTAGEM: LigaColunaListagem[] = [
  {
    campo: "dataPrevisao",
    cabecalho: "Previsto para",
    ordenavel: true,
    visivelPadrao: true,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "data" },
  },
  {
    campo: "valorPrevisao",
    cabecalho: "Valor Previsto",
    ordenavel: true,
    visivelPadrao: true,
    corpoCelula: (linha) =>
      formatarMoedaBr((linha as Record<string, unknown>).valorPrevisao),
  },
  {
    campo: "dataRealizacao",
    cabecalho: "Recebido em",
    ordenavel: true,
    visivelPadrao: true,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "data" },
  },
  {
    campo: "valorRealizacao",
    cabecalho: "Valor Recebido",
    ordenavel: true,
    visivelPadrao: true,
    corpoCelula: (linha) =>
      formatarMoedaBr((linha as Record<string, unknown>).valorRealizacao),
  },
  {
    campo: "valorOriginal",
    cabecalho: "Valor Original",
    ordenavel: true,
    visivelPadrao: false,
    corpoCelula: (linha) =>
      formatarMoedaBr((linha as Record<string, unknown>).valorOriginal),
  },
  {
    campo: "tipoEspecieDescricao",
    cabecalho: "Espécie",
    ordenavel: true,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "nomeAgente",
    cabecalho: "Nome / Razão social",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "nomeAgente",
    visivelPadrao: true,
    fixo: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "cnpjCpf",
    cabecalho: "CPF/CNPJ",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "cnpjCpf",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "historico",
    cabecalho: "Histórico",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "historico",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "dataCompetencia",
    cabecalho: "Competência",
    ordenavel: true,
    visivelPadrao: true,
    formatoDataListagem: "data",
    filtroRefinado: { tipo: "data" },
  },
  {
    campo: "contaCaixaDescricao",
    cabecalho: "Conta",
    ordenavel: true,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "idSituacaoDocumento",
    cabecalho: "Código da situação",
    ordenavel: true,
    visivelPadrao: false,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "situacaoDocumentoDescricao",
    cabecalho: "Situação",
    ordenavel: true,
    visivelPadrao: true,
  },
  {
    campo: "empresaDescricao",
    cabecalho: "Empresa",
    ordenavel: true,
    visivelPadrao: false,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "planoContaDescricao",
    cabecalho: "Plano de Contas",
    ordenavel: true,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "dataBaixa",
    cabecalho: "Baixado",
    ordenavel: true,
    visivelPadrao: false,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "data" },
  },
  {
    campo: "tipoAgenteDescricao",
    cabecalho: "Tipo",
    ordenavel: true,
    visivelPadrao: false,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "idNotaFiscal",
    cabecalho: "Código da nota fiscal",
    ordenavel: true,
    visivelPadrao: false,
    pesquisaServidor: true,
    campoConsulta: "idNotaFiscal",
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "notaFiscal",
    cabecalho: "Nota Fiscal",
    ordenavel: true,
    visivelPadrao: false,
  },
  {
    campo: "numeroDocumento",
    cabecalho: "Documento",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "numeroDocumento",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "unidadeOrigem",
    cabecalho: "Unidade origem",
    ordenavel: true,
    visivelPadrao: false,
  },
  {
    campo: "usuarioExterno",
    cabecalho: "Usuário externo",
    ordenavel: true,
    visivelPadrao: false,
  },
  {
    campo: "idLancamentoReceita",
    cabecalho: "Código",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "idLancamentoReceita",
    colunaChavePrimaria: true,
    visivelPadrao: true,
    alinhamento: "right",
    larguraMinPx: 88,
  },
  {
    campo: "dataInclusao",
    cabecalho: "Inclusão",
    ordenavel: true,
    visivelPadrao: false,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "dataIntervaloInclusao" },
  },
  {
    campo: "parcela",
    cabecalho: "Parcela",
    ordenavel: false,
    visivelPadrao: false,
  },
];
