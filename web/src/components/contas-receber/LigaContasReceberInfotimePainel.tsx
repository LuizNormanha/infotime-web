"use client";

import { useCallback, useEffect, useMemo, useState, type RefCallback } from "react";
import { useRouter } from "next/navigation";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";

import { LigaListagemBase } from "@/components/formulario-pesquisa/LigaListagemBase";
import { useListagemCrudServidor } from "@/hooks/useListagemCrudServidor";
import { usePermissaoPerfilTelaAtiva } from "@/hooks/usePermissaoPerfilTelaAtiva";
import { useLigaFeedback } from "@/components/ui/feedback/LigaFeedback";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";
import {
  executarComPrecheckSessao,
  solicitarReautenticacaoGlobal,
} from "@/lib/autenticacao/withSessionGuard";
import {
  EVENTO_SINCRONIZAR_PAINEL_FINANCEIRO,
  chaveStorageIntentPainel,
  type DetalheSincronizarPainelFinanceiro,
  type IntentPainelFinanceiro,
} from "@/lib/navegacao/financeiro-abas-home";

import "@/components/cliente/liga-cliente-infotime.css";
import { CONTAS_RECEBER_INFOTIME_COLUNAS_LISTAGEM } from "./contas-receber-infotime-listagem-colunas";
import "./liga-contas-receber-infotime.css";
import { LigaContasReceberInfotimeFormulario } from "./LigaContasReceberInfotimeFormulario";

type Props = {
  idTenacidade: string | null;
  /** Parâmetros extras na listagem (ex.: drilldown `venceHoje` / `atrasado`). */
  queryListagemExtra?: Record<string, string>;
  /** Sem cabeçalho do módulo quando o shell da rota `/financeiro` já exibe título. */
  omitirCabecalhoModulo?: boolean;
  /** Rotas dedicadas: `novo` ou id numérico abre formulário no mount. */
  idLancamentoRota?: string | null;
  /**
   * Quando definido (ex.: `/financeiro/receber`), lista/novo/edição usam `router.push`
   * em vez de estado interno apenas.
   */
  navegacaoBasePath?: string;
};

const ID_TITULO_LISTAGEM = "liga-contas-receber-infotime-titulo-listagem";

function ListaContasReceberInfotimeInterna({
  aoAbrirCadastro,
  aoNovo,
  hostPortalCabecalhoAcoes,
  queryListagemExtra,
}: {
  aoAbrirCadastro: (linha: Record<string, unknown>) => void;
  aoNovo: () => void;
  hostPortalCabecalhoAcoes: HTMLDivElement | null;
  queryListagemExtra?: Record<string, string>;
}) {
  const t = useTranslations("home.contasReceberInfotime");
  const tLista = useTranslations("home.contasReceberInfotime.lista");
  const feedback = useLigaFeedback();
  const sessao = useSessaoAtual();
  const permAutorizacoes = usePermissaoPerfilTelaAtiva("autorizacoes");

  const listagemHook = useListagemCrudServidor({
    resourcePath: "/api/contas-receber",
    campoPesquisaInicial: "nomeAgente",
    linhasPorPaginaInicial: 10,
    queryExtraFixo: queryListagemExtra,
  });
  const colunas = useMemo(() => CONTAS_RECEBER_INFOTIME_COLUNAS_LISTAGEM, []);

  const mostrarBotaoAutorizacoes =
    sessao.ehSuporte === true ||
    (permAutorizacoes.permissoesCarregadas &&
      (permAutorizacoes.permissoes.incluir || permAutorizacoes.permissoes.editar));

  const acoesSuplementares = (
    <>
      <Button
        type="button"
        size="small"
        outlined
        icon="pi pi-chart-bar"
        label={tLista("relatorioPeriodo")}
        className="liga-listagem-botao-novo"
        onClick={() =>
          void executarComPrecheckSessao(
            () => feedback.aviso(tLista("relatorioEmBreve")),
            (acaoPendente) => solicitarReautenticacaoGlobal(() => void acaoPendente()),
          )
        }
      />
      <Button
        type="button"
        size="small"
        outlined
        icon="pi pi-check-square"
        label={tLista("baixaAutomatica")}
        className="liga-listagem-botao-novo"
        onClick={() =>
          void executarComPrecheckSessao(
            () => feedback.aviso(tLista("baixaAutomaticaEmBreve")),
            (acaoPendente) => solicitarReautenticacaoGlobal(() => void acaoPendente()),
          )
        }
      />
      {mostrarBotaoAutorizacoes ? (
        <Button
          type="button"
          size="small"
          outlined
          icon="pi pi-shield"
          label={tLista("autorizacoes")}
          className="liga-listagem-botao-novo"
          onClick={() =>
            void executarComPrecheckSessao(
              () => feedback.aviso(tLista("autorizacoesEmBreve")),
              (acaoPendente) => solicitarReautenticacaoGlobal(() => void acaoPendente()),
            )
          }
        />
      ) : null}
    </>
  );

  return (
    <LigaListagemBase
      nomeTabela="infotime_lancamento_receita"
      codigoTela="contas-receber"
      listarTodos={false}
      registros={listagemHook.registros}
      colunas={colunas}
      chavePrimaria="idLancamentoReceita"
      linhasPorPaginaPadrao={10}
      textoBotaoNovo={t("lista.botaoNovo")}
      placeholderBusca={t("lista.placeholderBusca")}
      textoNenhumRegistro={t("lista.vazio")}
      aoNovo={aoNovo}
      aoAcaoLinha={aoAbrirCadastro}
      ariaLabelAcaoLinha={t("lista.abrirCadastro")}
      ordenacaoInicial={{ campo: "dataPrevisao", ordem: 1 }}
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
      cabecalhoAcoesSuplementares={acoesSuplementares}
    />
  );
}

export function LigaContasReceberInfotimePainel({
  idTenacidade,
  queryListagemExtra,
  omitirCabecalhoModulo = false,
  idLancamentoRota,
  navegacaoBasePath,
}: Props) {
  void idTenacidade;
  const router = useRouter();
  const t = useTranslations("home.contasReceberInfotime");
  const subtituloLista = t("lista.subtitulo").trim();

  const rotaNovo = idLancamentoRota === "novo";
  const rotaIdEdicao =
    idLancamentoRota != null && idLancamentoRota !== "" && !rotaNovo
      ? idLancamentoRota
      : null;

  const [hostCabecalhoAcoes, setHostCabecalhoAcoes] = useState<HTMLDivElement | null>(null);
  const refHostCabecalhoAcoes = useCallback<RefCallback<HTMLDivElement>>((el) => {
    setHostCabecalhoAcoes(el);
  }, []);

  const [fluxo, setFluxo] = useState<"lista" | "formulario">(
    rotaNovo || rotaIdEdicao != null ? "formulario" : "lista",
  );
  const [idEdicao, setIdEdicao] = useState<string | null>(rotaNovo ? null : rotaIdEdicao);
  const [ticketLista, setTicketLista] = useState(0);
  const [intentListagem, setIntentListagem] = useState<Record<string, string> | undefined>(
    undefined,
  );

  const queryListaMerged = useMemo((): Record<string, string> | undefined => {
    const a = intentListagem ?? {};
    const b = queryListagemExtra ?? {};
    const o = { ...a, ...b };
    return Object.keys(o).length > 0 ? o : undefined;
  }, [intentListagem, queryListagemExtra]);

  const aplicarIntentPainel = useCallback((intent: IntentPainelFinanceiro) => {
    if (intent.abrir === "novo") {
      setIntentListagem(undefined);
      setFluxo("formulario");
      setIdEdicao(null);
    } else if (intent.abrir === "edicao" && intent.idEdicao) {
      setIntentListagem(undefined);
      setFluxo("formulario");
      setIdEdicao(intent.idEdicao);
    } else {
      if (intent.listagemExtra !== undefined) {
        if (Object.keys(intent.listagemExtra).length > 0) {
          setIntentListagem({ ...intent.listagemExtra });
        } else {
          setIntentListagem(undefined);
        }
      }
      setFluxo("lista");
      setIdEdicao(null);
    }
    setTicketLista((x) => x + 1);
  }, []);

  useEffect(() => {
    if (navegacaoBasePath) return;
    try {
      const raw = sessionStorage.getItem(chaveStorageIntentPainel("contas-receber"));
      if (!raw) return;
      sessionStorage.removeItem(chaveStorageIntentPainel("contas-receber"));
      aplicarIntentPainel(JSON.parse(raw) as IntentPainelFinanceiro);
    } catch {
      /* JSON inválido */
    }
  }, [navegacaoBasePath, aplicarIntentPainel]);

  useEffect(() => {
    if (navegacaoBasePath) return;
    const aoSincronizar = (ev: Event) => {
      const det = (ev as CustomEvent<DetalheSincronizarPainelFinanceiro>).detail;
      if (det?.alvo !== "contas-receber") return;
      aplicarIntentPainel(det.intent);
    };
    window.addEventListener(EVENTO_SINCRONIZAR_PAINEL_FINANCEIRO, aoSincronizar as EventListener);
    return () => {
      window.removeEventListener(
        EVENTO_SINCRONIZAR_PAINEL_FINANCEIRO,
        aoSincronizar as EventListener,
      );
    };
  }, [navegacaoBasePath, aplicarIntentPainel]);

  const abrirNovo = useCallback(() => {
    if (navegacaoBasePath) {
      router.push(`${navegacaoBasePath}/novo`);
      return;
    }
    setIdEdicao(null);
    setFluxo("formulario");
  }, [navegacaoBasePath, router]);

  const abrirEdicao = useCallback(
    (linha: Record<string, unknown>) => {
      const id = String(linha.idLancamentoReceita ?? "").trim();
      if (!id) return;
      if (navegacaoBasePath) {
        router.push(`${navegacaoBasePath}/${encodeURIComponent(id)}`);
        return;
      }
      setIdEdicao(id);
      setFluxo("formulario");
    },
    [navegacaoBasePath, router],
  );

  const voltarLista = useCallback(() => {
    if (navegacaoBasePath) {
      router.push(navegacaoBasePath);
      return;
    }
    setFluxo("lista");
    setIdEdicao(null);
  }, [navegacaoBasePath, router]);

  const aposSalvar = useCallback(
    (_id: string) => {
      void _id;
      setTicketLista((x) => x + 1);
      if (navegacaoBasePath) {
        router.push(navegacaoBasePath);
        return;
      }
      voltarLista();
    },
    [navegacaoBasePath, router, voltarLista],
  );

  if (fluxo === "formulario") {
    return (
      <div className="liga-home-modulo-vazio liga-cliente-infotime-painel liga-contas-receber-infotime-painel">
        <LigaContasReceberInfotimeFormulario
          idLancamentoReceita={idEdicao}
          aoVoltar={voltarLista}
          aoSalvo={aposSalvar}
        />
      </div>
    );
  }

  return (
    <div className="liga-home-modulo-vazio liga-cliente-infotime-painel liga-contas-receber-infotime-painel">
      {omitirCabecalhoModulo ? null : (
        <header className="liga-home-modulo-cabecalho">
          <div className="liga-home-modulo-titulo-linha liga-cliente-infotime-modulo-titulo-linha">
            <div className="liga-cliente-infotime-modulo-titulo-esquerda">
              <span className="liga-home-modulo-barra-verde" aria-hidden />
              <h1
                id={ID_TITULO_LISTAGEM}
                className="liga-home-modulo-titulo-principal"
              >
                <i className="pi pi-plus-circle liga-home-modulo-titulo-icone" aria-hidden />
                {t("lista.titulo")}
              </h1>
            </div>
            <div
              ref={refHostCabecalhoAcoes}
              className="liga-contas-receber-infotime-cabecalho-acoes-host"
              aria-label={t("lista.acoesCabecalhoAria")}
            />
          </div>
          {subtituloLista ? (
            <p className="liga-home-modulo-subtitulo">{subtituloLista}</p>
          ) : null}
        </header>
      )}

      <ListaContasReceberInfotimeInterna
        key={`${String(ticketLista)}-${JSON.stringify(queryListaMerged ?? {})}`}
        hostPortalCabecalhoAcoes={omitirCabecalhoModulo ? null : hostCabecalhoAcoes}
        aoAbrirCadastro={abrirEdicao}
        aoNovo={abrirNovo}
        queryListagemExtra={queryListaMerged}
      />
    </div>
  );
}
