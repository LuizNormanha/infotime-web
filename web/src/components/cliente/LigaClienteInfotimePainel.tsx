"use client";

import { useCallback, useMemo, useState, type RefCallback } from "react";
import { useTranslations } from "next-intl";

import { LigaListagemBase } from "@/components/formulario-pesquisa/LigaListagemBase";
import { useListagemCrudServidor } from "@/hooks/useListagemCrudServidor";

import { CLIENTE_INFOTIME_COLUNAS_LISTAGEM } from "./cliente-infotime-listagem-colunas";
import "./liga-cliente-infotime.css";
import { LigaClienteInfotimeFormulario } from "./LigaClienteInfotimeFormulario";

type Props = {
  idTenacidade: string | null;
};

const ID_TITULO_LISTAGEM_CLIENTE = "liga-cliente-infotime-titulo-listagem";

function ListaClienteInfotimeInterna({
  aoAbrirCadastro,
  aoNovo,
  hostPortalCabecalhoAcoes,
}: {
  aoAbrirCadastro: (linha: Record<string, unknown>) => void;
  aoNovo: () => void;
  hostPortalCabecalhoAcoes: HTMLDivElement | null;
}) {
  const t = useTranslations("home.clienteInfotime");
  const listagemHook = useListagemCrudServidor({
    resourcePath: "/api/clientes",
    campoPesquisaInicial: "nomeFantasia",
    linhasPorPaginaInicial: 10,
  });
  const colunas = useMemo(() => CLIENTE_INFOTIME_COLUNAS_LISTAGEM, []);

  return (
    <LigaListagemBase
      nomeTabela="infotime_cliente"
      codigoTela="clientes"
      listarTodos={false}
      registros={listagemHook.registros}
      colunas={colunas}
      chavePrimaria="idCliente"
      linhasPorPaginaPadrao={10}
      textoBotaoNovo={t("lista.botaoNovo")}
      placeholderBusca={t("lista.placeholderBusca")}
      textoNenhumRegistro={t("lista.vazio")}
      aoNovo={aoNovo}
      aoAcaoLinha={aoAbrirCadastro}
      ariaLabelAcaoLinha={t("lista.abrirCadastro")}
      ordenacaoInicial={{ campo: "nomeFantasia", ordem: 1 }}
      omitirCabecalhoPagina
      hostPortalCabecalhoAcoes={hostPortalCabecalhoAcoes}
      idTituloListagemAcessivel={ID_TITULO_LISTAGEM_CLIENTE}
      carregando={listagemHook.carregando}
      fonteListagem="servidor"
      paginacaoServidor={listagemHook.servidor?.paginacaoServidor}
      aoPesquisarServidor={listagemHook.servidor?.aoPesquisarServidor}
      aoCampoPesquisaServidorChange={listagemHook.servidor?.aoCampoPesquisaServidorChange}
      aoFiltrosRefinadoServidor={listagemHook.servidor?.aoFiltrosRefinadoServidor}
      aoLimparBusca={listagemHook.servidor?.aoLimparBusca}
    />
  );
}

export function LigaClienteInfotimePainel({ idTenacidade }: Props) {
  const t = useTranslations("home.clienteInfotime");
  const subtituloLista = t("lista.subtitulo").trim();

  const [hostCabecalhoAcoes, setHostCabecalhoAcoes] = useState<HTMLDivElement | null>(
    null,
  );
  const refHostCabecalhoAcoes = useCallback<RefCallback<HTMLDivElement>>((el) => {
    setHostCabecalhoAcoes(el);
  }, []);

  const [fluxo, setFluxo] = useState<"lista" | "formulario">("lista");
  const [idEdicao, setIdEdicao] = useState<string | null>(null);
  const [ticketLista, setTicketLista] = useState(0);

  const abrirNovo = useCallback(() => {
    setIdEdicao(null);
    setFluxo("formulario");
  }, []);

  const abrirEdicao = useCallback((linha: Record<string, unknown>) => {
    const id = String(linha.idCliente ?? "").trim();
    if (!id) return;
    setIdEdicao(id);
    setFluxo("formulario");
  }, []);

  const voltarLista = useCallback(() => {
    setFluxo("lista");
    setIdEdicao(null);
  }, []);

  const aposSalvar = useCallback((_id: string) => {
    void _id;
    setTicketLista((x) => x + 1);
    voltarLista();
  }, [voltarLista]);

  if (fluxo === "formulario") {
    return (
      <div className="liga-home-modulo-vazio liga-cliente-infotime-painel">
        <LigaClienteInfotimeFormulario
          idTenacidade={idTenacidade}
          idCliente={idEdicao}
          aoVoltar={voltarLista}
          aoSalvo={aposSalvar}
        />
      </div>
    );
  }

  return (
    <div className="liga-home-modulo-vazio liga-cliente-infotime-painel">
      <header className="liga-home-modulo-cabecalho">
        <div className="liga-home-modulo-titulo-linha liga-cliente-infotime-modulo-titulo-linha">
          <div className="liga-cliente-infotime-modulo-titulo-esquerda">
            <span className="liga-home-modulo-barra-verde" aria-hidden />
            <h1
              id={ID_TITULO_LISTAGEM_CLIENTE}
              className="liga-home-modulo-titulo-principal"
            >
              <i className="pi pi-users liga-home-modulo-titulo-icone" aria-hidden />
              {t("lista.titulo")}
            </h1>
          </div>
          <div
            ref={refHostCabecalhoAcoes}
            className="liga-cliente-infotime-cabecalho-acoes-host"
            aria-label={t("lista.acoesCabecalhoAria")}
          />
        </div>
        {subtituloLista ? (
          <p className="liga-home-modulo-subtitulo">{subtituloLista}</p>
        ) : null}
      </header>

      <ListaClienteInfotimeInterna
        key={ticketLista}
        hostPortalCabecalhoAcoes={hostCabecalhoAcoes}
        aoAbrirCadastro={abrirEdicao}
        aoNovo={abrirNovo}
      />
    </div>
  );
}
