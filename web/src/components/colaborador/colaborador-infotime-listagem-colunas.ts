import type { LigaColunaListagem } from "@/components/formulario-pesquisa/liga-listagem.types";
import { colaboradorBadgePaletaTipoOuSituacao } from "@/lib/colaborador-lookup-paleta-seis";
import { formatarApenasDiaListagemPtBr } from "@/lib/formatar-data-listagem";
import { createElement } from "react";

function formatarCpf(valor: unknown): string {
  const d = String(valor ?? "").replace(/\D/g, "").slice(0, 11);
  if (d.length !== 11) return String(valor ?? "").trim() || "—";
  return d.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

function badgePaletaColaborador(
  id: unknown,
  rotulo: unknown,
  dominio: "tipo" | "situacao",
) {
  const desc = String(rotulo ?? "").trim();
  const texto = desc || "—";
  const variante = colaboradorBadgePaletaTipoOuSituacao(
    String(id ?? "").trim(),
    desc || null,
    dominio,
  );
  return createElement(
    "span",
    { "data-liga-badge-coluna": `colaborador-${dominio}` },
    createElement(
      "span",
      {
        className: `liga-padrao-badge liga-colaborador-infotime-paleta-badge--${variante}`,
      },
      texto,
    ),
  );
}

function badgeSexo(valor: unknown) {
  const s = String(valor ?? "")
    .trim()
    .toUpperCase()
    .slice(0, 1);
  const rotulo =
    s === "M"
      ? "Masculino"
      : s === "F"
        ? "Feminino"
        : s === "N"
          ? "Não informado"
          : s === ""
            ? "—"
            : s;
  return createElement(
    "span",
    { className: "liga-padrao-badge liga-colaborador-infotime-sexo-badge" },
    rotulo,
  );
}

export const COLABORADOR_INFOTIME_COLUNAS_LISTAGEM: LigaColunaListagem[] = [
  {
    campo: "buscaRapida",
    cabecalho: "Busca rápida (nome, CPF, e-mail, celular)",
    ordenavel: false,
    pesquisaServidor: true,
    campoConsulta: "buscaRapida",
    visivelPadrao: false,
  },
  {
    campo: "nome",
    cabecalho: "Nome",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "nome",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
    fixo: true,
  },
  {
    campo: "cpf",
    cabecalho: "CPF",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "cpf",
    mascaraBuscaServidor: "cpf",
    visivelPadrao: true,
    filtroRefinado: { tipo: "texto" },
    corpoCelula: (linha) => formatarCpf((linha as Record<string, unknown>).cpf),
  },
  {
    campo: "dataNascimento",
    cabecalho: "Nascimento",
    ordenavel: true,
    visivelPadrao: true,
    corpoCelula: (linha) =>
      formatarApenasDiaListagemPtBr(
        (linha as Record<string, unknown>).dataNascimento,
      ) || "—",
  },
  {
    campo: "sexo",
    cabecalho: "Sexo",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "sexo",
    visivelPadrao: true,
    corpoCelula: (linha) => badgeSexo((linha as Record<string, unknown>).sexo),
  },
  {
    campo: "celular",
    cabecalho: "Celular",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "celular",
    mascaraBuscaServidor: "telefone",
    visivelPadrao: true,
  },
  {
    campo: "idTipoColaborador",
    cabecalho: "Tipo",
    ordenavel: false,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
    corpoCelula: (linha) => {
      const r = linha as Record<string, unknown>;
      return badgePaletaColaborador(r.idTipoColaborador, r.tipoColaboradorDescricao, "tipo");
    },
  },
  {
    campo: "dataAdmissao",
    cabecalho: "Admissão",
    ordenavel: true,
    visivelPadrao: true,
  },
  {
    campo: "idCargoClassificacaoNivel",
    cabecalho: "Cargo",
    ordenavel: false,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
    corpoCelula: (linha) =>
      String((linha as Record<string, unknown>).cargoDescricao ?? "—"),
  },
  {
    campo: "idSituacaoColaborador",
    cabecalho: "Situação",
    ordenavel: false,
    visivelPadrao: true,
    filtroRefinado: { tipo: "inteiro" },
    corpoCelula: (linha) => {
      const r = linha as Record<string, unknown>;
      return badgePaletaColaborador(
        r.idSituacaoColaborador,
        r.situacaoColaboradorDescricao,
        "situacao",
      );
    },
  },
  {
    campo: "idColaborador",
    cabecalho: "Código",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "idColaborador",
    colunaChavePrimaria: true,
    visivelPadrao: true,
    alinhamento: "right",
    larguraMinPx: 88,
    filtroRefinado: { tipo: "inteiro" },
  },
  {
    campo: "email",
    cabecalho: "E-mail",
    ordenavel: true,
    pesquisaServidor: true,
    campoConsulta: "email",
    visivelPadrao: false,
    filtroRefinado: { tipo: "texto" },
  },
];
