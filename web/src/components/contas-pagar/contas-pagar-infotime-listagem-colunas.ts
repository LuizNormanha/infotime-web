import type { LigaColunaListagem } from "@/components/formulario-pesquisa/liga-listagem.types";

function formatarMoedaBr(valor: unknown): string {
  const bruto = String(valor ?? "").trim();
  if (!bruto) return "—";
  const n = Number.parseFloat(bruto.replace(",", "."));
  if (!Number.isFinite(n)) return bruto;
  return n.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
}

/** Colunas alinhadas ao legado LancamentoDespesa_Lst e ao DTO da API. */
export const CONTAS_PAGAR_INFOTIME_COLUNAS_LISTAGEM: LigaColunaListagem[] = [
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
    campo: "valorPrevisaoLiquido",
    cabecalho: "Valor Previsto Líquido",
    ordenavel: true,
    visivelPadrao: false,
    corpoCelula: (linha) =>
      formatarMoedaBr((linha as Record<string, unknown>).valorPrevisaoLiquido),
  },
  {
    campo: "dataRealizacao",
    cabecalho: "Pago em",
    ordenavel: true,
    visivelPadrao: true,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "data" },
  },
  {
    campo: "valorRealizacao",
    cabecalho: "Valor Pago",
    ordenavel: true,
    visivelPadrao: true,
    corpoCelula: (linha) =>
      formatarMoedaBr((linha as Record<string, unknown>).valorRealizacao),
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
    cabecalho: "Conta Caixa",
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
    cabecalho: "Tipo de agente",
    ordenavel: true,
    visivelPadrao: false,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "idLancamentoDespesa",
    cabecalho: "Código",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "idLancamentoDespesa",
    colunaChavePrimaria: true,
    visivelPadrao: true,
    alinhamento: "right",
    larguraMinPx: 88,
  },
  {
    campo: "dataInclusao",
    cabecalho: "Incluído em",
    ordenavel: true,
    visivelPadrao: false,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "dataIntervaloInclusao" },
  },
  {
    campo: "qtdParcela",
    cabecalho: "Qtd Parcelas",
    ordenavel: false,
    visivelPadrao: false,
  },
  {
    campo: "cnpj",
    cabecalho: "CNPJ Fornecedor",
    ordenavel: false,
    visivelPadrao: false,
  },
  {
    campo: "dataAgendamento",
    cabecalho: "Agendado para",
    ordenavel: true,
    visivelPadrao: false,
    formatoDataListagem: "dataHora",
    filtroRefinado: { tipo: "data" },
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
    campo: "parcela",
    cabecalho: "Parcela",
    ordenavel: false,
    visivelPadrao: false,
  },
];
