"use client";

import {
  useCallback,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
  type RefCallback,
} from "react";
import { useTranslations } from "next-intl";

import { LigaListagemBase } from "@/components/formulario-pesquisa/LigaListagemBase";
import { sincronizarBadgesLarguraIgualNoContainer } from "@/components/ui/badge/sincronizar-badges-largura-igual";
import { useListagemCrudServidor } from "@/hooks/useListagemCrudServidor";

import "@/components/cliente/liga-cliente-infotime.css";
import { COLABORADOR_INFOTIME_COLUNAS_LISTAGEM } from "./colaborador-infotime-listagem-colunas";
import "./liga-colaborador-infotime.css";
import { LigaColaboradorInfotimeFormulario } from "./LigaColaboradorInfotimeFormulario";

type Props = {
  idTenacidade: string | null;
};

const ID_TITULO_LISTAGEM = "liga-colaborador-infotime-titulo-listagem";

function ListaInterna({
  aoAbrirCadastro,
  aoNovo,
  hostPortalCabecalhoAcoes,
}: {
  aoAbrirCadastro: (linha: Record<string, unknown>) => void;
  aoNovo: () => void;
  hostPortalCabecalhoAcoes: HTMLDivElement | null;
}) {
  const t = useTranslations("home.colaboradorInfotime");
  const listagemHook = useListagemCrudServidor({
    resourcePath: "/api/colaboradores",
    campoPesquisaInicial: "buscaRapida",
    linhasPorPaginaInicial: 10,
  });
  const colunas = useMemo(() => COLABORADOR_INFOTIME_COLUNAS_LISTAGEM, []);
  const refLista = useRef<HTMLDivElement>(null);

  useLayoutEffect(() => {
    const root = refLista.current;
    if (!root) return;

    const aplicar = () => {
      requestAnimationFrame(() => {
        requestAnimationFrame(() => sincronizarBadgesLarguraIgualNoContainer(root));
      });
    };

    const ro = new ResizeObserver(() => {
      aplicar();
    });
    ro.observe(root);
    aplicar();

    return () => {
      ro.disconnect();
    };
  }, [listagemHook.registros, listagemHook.carregando]);

  return (
    <div ref={refLista}>
      <LigaListagemBase
        nomeTabela="infotime_colaborador"
        codigoTela="colaboradores"
        listarTodos={false}
        registros={listagemHook.registros}
        colunas={colunas}
        chavePrimaria="idColaborador"
        linhasPorPaginaPadrao={10}
        textoBotaoNovo={t("lista.botaoNovo")}
        placeholderBusca={t("lista.placeholderBusca")}
        textoNenhumRegistro={t("lista.vazio")}
        aoNovo={aoNovo}
        aoAcaoLinha={aoAbrirCadastro}
        ariaLabelAcaoLinha={t("lista.abrirCadastro")}
        ordenacaoInicial={{ campo: "nome", ordem: 1 }}
        omitirCabecalhoPagina
        hostPortalCabecalhoAcoes={hostPortalCabecalhoAcoes}
        idTituloListagemAcessivel={ID_TITULO_LISTAGEM}
        carregando={listagemHook.carregando}
        fonteListagem="servidor"
        paginacaoServidor={listagemHook.servidor?.paginacaoServidor}
        aoPesquisarServidor={listagemHook.servidor?.aoPesquisarServidor}
        aoCampoPesquisaServidorChange={listagemHook.servidor?.aoCampoPesquisaServidorChange}
        aoFiltrosRefinadoServidor={listagemHook.servidor?.aoFiltrosRefinadoServidor}
        aoLimparBusca={listagemHook.servidor?.aoLimparBusca}
      />
    </div>
  );
}

export function LigaColaboradorInfotimePainel({ idTenacidade }: Props) {
  const t = useTranslations("home.colaboradorInfotime");
  const subtituloLista = t("lista.subtitulo").trim();

  const [hostCabecalhoAcoes, setHostCabecalhoAcoes] = useState<HTMLDivElement | null>(null);
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
    const id = String(linha.idColaborador ?? "").trim();
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
      <div className="liga-home-modulo-vazio liga-colaborador-infotime-painel">
        <LigaColaboradorInfotimeFormulario
          idTenacidade={idTenacidade}
          idColaborador={idEdicao}
          aoVoltar={voltarLista}
          aoSalvo={aposSalvar}
        />
      </div>
    );
  }

  return (
    <div className="liga-home-modulo-vazio liga-colaborador-infotime-painel">
      <header className="liga-home-modulo-cabecalho">
        <div className="liga-home-modulo-titulo-linha liga-cliente-infotime-modulo-titulo-linha">
          <div className="liga-cliente-infotime-modulo-titulo-esquerda">
            <span className="liga-home-modulo-barra-verde" aria-hidden />
            <h1
              id={ID_TITULO_LISTAGEM}
              className="liga-home-modulo-titulo-principal"
            >
              <i className="pi pi-id-card liga-home-modulo-titulo-icone" aria-hidden />
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

      <ListaInterna
        key={ticketLista}
        hostPortalCabecalhoAcoes={hostCabecalhoAcoes}
        aoAbrirCadastro={abrirEdicao}
        aoNovo={abrirNovo}
      />
    </div>
  );
}
