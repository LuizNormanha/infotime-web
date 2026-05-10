import type { LigaColunaListagem } from "@/components/formulario-pesquisa/liga-listagem.types";
import { createElement } from "react";

function formatarDocumento(valor: unknown): string {
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

/** Colunas alinhadas ao SQL legado Fornecedor_Lst e ao DTO da API. */
export const FORNECEDOR_INFOTIME_COLUNAS_LISTAGEM: LigaColunaListagem[] = [
  {
    campo: "nomeFantasia",
    cabecalho: "Nome",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "nomeFantasia",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
    fixo: true,
  },
  {
    campo: "tipoPessoa",
    cabecalho: "Tipo pessoa",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "tipoPessoa",
    visivelPadrao: true,
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
      formatarDocumento((linha as Record<string, unknown>).cnpj),
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
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "celular",
    mascaraBuscaServidor: "telefone",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "email",
    cabecalho: "E-mail",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "email",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
  },
  {
    campo: "idSituacaoFornecedor",
    cabecalho: "Situação",
    ordenavel: true,
    visivelPadrao: true,
    corpoCelula: (linha) =>
      String((linha as Record<string, unknown>).situacaoFornecedorDescricao ?? "—"),
  },
  {
    campo: "fabricante",
    cabecalho: "Fabricante",
    ordenavel: false,
    visivelPadrao: true,
    corpoCelula: (linha) => {
      const sim = (linha as Record<string, unknown>).fabricante === true;
      return createElement(
        "span",
        {
          className: sim
            ? "liga-fornecedor-infotime-badge-fab liga-fornecedor-infotime-badge-fab--sim"
            : "liga-fornecedor-infotime-badge-fab liga-fornecedor-infotime-badge-fab--nao",
        },
        sim ? "Sim" : "—",
      );
    },
  },
  {
    campo: "contatos",
    cabecalho: "Contatos",
    ordenavel: true,
    visivelPadrao: false,
    quebraLinhaTexto: true,
  },
  {
    campo: "idFornecedor",
    cabecalho: "Código",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "idFornecedor",
    colunaChavePrimaria: true,
    visivelPadrao: true,
    alinhamento: "right",
    larguraMinPx: 88,
  },
];
