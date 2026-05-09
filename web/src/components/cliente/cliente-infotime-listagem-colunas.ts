import type { LigaColunaListagem } from "@/components/formulario-pesquisa/liga-listagem.types";
import { createElement } from "react";

function formatarDocumentoCliente(valor: unknown): string {
  const bruto = String(valor ?? "").trim();
  if (!bruto) return "—";
  const digitos = bruto.replace(/\D/g, "");
  if (digitos.length === 11) {
    return digitos.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
  }
  if (digitos.length === 14) {
    return digitos.replace(
      /(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/,
      "$1.$2.$3/$4-$5",
    );
  }
  return bruto;
}

function normalizarSituacao(valor: unknown): "ativo" | "inativo" | "lead" | "prospect" | "outro" {
  const s = String(valor ?? "")
    .trim()
    .toLocaleLowerCase("pt-BR");
  if (s === "ativo") return "ativo";
  if (s === "inativo") return "inativo";
  if (s === "lead") return "lead";
  if (s === "prospect") return "prospect";
  return "outro";
}

function badgeSituacaoCliente(valor: unknown) {
  const texto = String(valor ?? "").trim() || "—";
  const tipo = normalizarSituacao(valor);
  return createElement(
    "span",
    {
      className: `liga-cliente-infotime-situacao-badge liga-cliente-infotime-situacao-badge--${tipo}`,
    },
    texto,
  );
}

/** Colunas alinhadas ao SQL legado Cliente_Lst e ao payload `ClienteListaItemDto` da API. */
export const CLIENTE_INFOTIME_COLUNAS_LISTAGEM: LigaColunaListagem[] = [
  {
    campo: "nomeFantasia",
    cabecalho: "Nome Fantaisa",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "nomeFantasia",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
    fixo: true,
  },
  {
    campo: "razaoSocial",
    cabecalho: "Razão social / nome",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "razaoSocial",
    visivelPadrao: false,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "tipoPessoa",
    cabecalho: "Tipo pessoa",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "tipoPessoa",
    visivelPadrao: false,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "cnpj",
    cabecalho: "CNPJ / CPF",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "cnpj",
    mascaraBuscaServidor: "cnpj",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
    corpoCelula: (linha) =>
      formatarDocumentoCliente((linha as Record<string, unknown>).cnpj),
  },
  {
    campo: "cidade",
    cabecalho: "Cidade",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "cidade",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "estado",
    cabecalho: "UF",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "estado",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "telefone",
    cabecalho: "Telefone",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "telefone",
    mascaraBuscaServidor: "telefone",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "celular",
    cabecalho: "Celular",
    ordenavel: false,
    pesquisaServidor: true,
    campoConsulta: "celular",
    mascaraBuscaServidor: "telefone",
    visivelPadrao: false,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "email",
    cabecalho: "E-mail",
    ordenavel: false,
    pesquisaServidor: true,
    campoConsulta: "email",
    visivelPadrao: false,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "idSituacaoCliente",
    cabecalho: "Situação",
    ordenavel: false,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
    corpoCelula: (linha) =>
      badgeSituacaoCliente((linha as Record<string, unknown>).situacaoClienteDescricao),
  },
  {
    campo: "idTipoCliente",
    cabecalho: "Tipo",
    ordenavel: false,
    visivelPadrao: false,
    filtroRefinado: { tipo: "inteiro" },
    corpoCelula: (linha) =>
      String((linha as Record<string, unknown>).tipoClienteDescricao ?? "—"),
  },
  {
    campo: "idClienteCanal",
    cabecalho: "Canal",
    ordenavel: false,
    visivelPadrao: false,
    corpoCelula: (linha) =>
      String((linha as Record<string, unknown>).canalDescricao ?? "—"),
  },
  {
    campo: "contatos",
    cabecalho: "Contatos",
    ordenavel: false,
    visivelPadrao: false,
    quebraLinhaTexto: true,
  },
  {
    campo: "idCliente",
    cabecalho: "ID",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "idCliente",
    colunaChavePrimaria: true,
    visivelPadrao: true,
    alinhamento: "right",
    larguraMinPx: 88,
  },
];
