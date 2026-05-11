"use client";

import {
  type MutableRefObject,
  type ReactNode,
  useCallback,
  useEffect,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
} from "react";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Message } from "primereact/message";
import { LigaAba } from "../abas/LigaAba";
import { focarPrimeiroCampoHabilitado } from "./focar-primeiro-campo-secao";
import "./liga-formulario-base.css";

export type LigaFormularioSecao = {
  id: string;
  titulo: string;
  descricao?: string;
  /** Classe PrimeIcons sem prefixo `pi ` (ex.: `pi-user`). */
  icone: string;
  conteudo: ReactNode;
  /** Conteúdo à direita do título da seção (h2), na mesma linha (ex.: legenda de cores). */
  conteudoAoLadoDoTituloSecao?: ReactNode;
  /** Botões ou ações à direita do título da seção (mesma linha do cabeçalho do cartão). */
  acoesCabecalho?: ReactNode;
};

export type NavegacaoSecoes = "sidebar" | "etapasHorizontais" | "abasTopo";

/** Controles imperativos do wizard (`etapasHorizontais`), preenchidos pelo `LigaFormularioBase`. */
export type LigaFormularioEtapasControle = {
  avancar: () => void;
  tentarIrParaSecao: (secaoId: string) => void;
};

export const LIGA_FORMULARIO_ETAPAS_BOTAO_AVANCAR_ID =
  "liga-formulario-etapas-botao-avancar";
export const LIGA_FORMULARIO_ETAPAS_BOTAO_CONCLUIR_ID =
  "liga-formulario-etapas-botao-concluir";

type LigaFormularioBaseProps = {
  titulo: string;
  /** Conteúdo exibido no título, após o texto do título (ex.: badge de status). */
  sufixoTitulo?: ReactNode;
  subtitulo?: string;
  /** Ícone PrimeIcons sem prefixo `pi` (ex.: `pi-users`), alinhado ao menu. */
  iconeTitulo?: string;
  /** Não exibe título/subtítulo no topo (mantém só `barraAcoes`, ex.: formulário embutido em outra seção). */
  semTituloTopo?: boolean;
  secoes: LigaFormularioSecao[];
  /** Botões globais (ex.: cancelar, salvar) — canto superior direito. */
  barraAcoes?: ReactNode;
  /** Conteúdo em largura total logo abaixo do cabeçalho (título/subtítulo/ações), antes do alerta global. */
  abaixoDoTopo?: ReactNode;
  /** Exibe legenda (fora do cartão) quando há obrigatórios. */
  temLegendaCamposObrigatorios?: boolean;
  /** Erro não vinculado a um campo (ex.: conflito, regra de negócio). Exibido abaixo do cabeçalho, estilo alerta. */
  mensagemErroGlobal?: string | null;
  /** Ativa a seção lateral que contém o primeiro campo com erro (validação). */
  secaoParaAtivar?: string | null;
  /** Se existir em `secoes`, a navegação lateral inicia nesta aba (senão a primeira seção). */
  secaoInicialId?: string | null;
  /**
   * `sidebar` (padrão) usa navegação lateral livre. `etapasHorizontais` bloqueia
   * seções futuras até a etapa atual ser validada (wizard); seções concluídas
   * continuam navegáveis para revisão. `abasTopo` usa a mesma faixa visual de abas
   * horizontais, sem wizard (todas as seções livres; sem rodapé Voltar/Avançar) —
   * padrão para painéis de detalhe em mestre–detalhe (MCP `padroes/ui`).
   */
  navegacaoSecoes?: NavegacaoSecoes;
  /**
   * Retorne `null` para liberar a próxima etapa; uma string exibe feedback como
   * `mensagemErroGlobal` sem avançar. Executada apenas em `etapasHorizontais`.
   */
  validarEtapaAntesDeAvancar?: (secaoId: string) => string | null;
  /** Notifica o pai quando a última etapa foi atingida (ex.: habilitar Salvar). */
  aoMudarIndiceEtapa?: (indice: number, total: number) => void;
  /**
   * Na **última** etapa do wizard, o botão do rodapé vira **Concluir** e, após
   * `validarEtapaAntesDeAvancar` retornar `null`, executa a mesma ação do **Salvar**
   * (persistência). Só aplica em `etapasHorizontais`.
   */
  onConcluirEtapas?: () => void;
  /** Desabilita o botão Concluir (ex.: salvando ou sem permissão). */
  concluirEtapasDesabilitado?: boolean;
  concluirEtapasCarregando?: boolean;
  /**
   * Em `etapasHorizontais`, ids de seção em que o fluxo **avança sozinho** para a
   * próxima etapa quando `validarEtapaAntesDeAvancar(secaoAtual) === null`, desde que
   * o usuário esteja na **fronteira** do wizard (`índice ativo === último índice já
   * liberado`) — evita avançar ao revisitar uma etapa anterior. **Não** usar em
   * etapas com multisseleção / listas mestre-detalhe (MCP `padroes/ui` §12.5).
   */
  secaoIdsAvancoAutomaticoEtapas?: readonly string[];
  /**
   * Notificação contínua da seção/aba com foco (sidebar, etapas ou abas). Útil para
   * preservar a seção após `carregando` (GET) sem voltar à primeira.
   */
  onSecaoAtivaChange?: (secaoId: string) => void;
  /**
   * Só em `etapasHorizontais`: após avançar com sucesso (botão Avançar ou avanço automático),
   * notifica `de` → `para` para o pai reposicionar foco (ex.: lookup da próxima etapa).
   */
  onAposAvancarEtapas?: (secaoAnteriorId: string, secaoNovaId: string) => void;
  /**
   * Referência mutável preenchida quando `navegacaoSecoes === "etapasHorizontais"`; `null` nos demais modos.
   */
  controleEtapasExternoRef?: MutableRefObject<LigaFormularioEtapasControle | null>;
  /** Barra vertical verde à esquerda do título (mesmo padrão visual das listagens). */
  tituloComBarraVerde?: boolean;
  /**
   * Quando `true`, `subtitulo` é renderizado dentro do `h1`, logo abaixo de `titulo`
   * (coluna de texto), em vez de um `p` separado — útil para cabeçalhos estilo “marca + faixa”.
   */
  subtituloAgrupadoAoTitulo?: boolean;
};

export function LigaFormularioBase({
  titulo,
  sufixoTitulo,
  subtitulo,
  iconeTitulo,
  semTituloTopo = false,
  secoes,
  barraAcoes,
  abaixoDoTopo,
  temLegendaCamposObrigatorios = false,
  mensagemErroGlobal = null,
  secaoParaAtivar = null,
  secaoInicialId = null,
  navegacaoSecoes = "sidebar",
  validarEtapaAntesDeAvancar,
  aoMudarIndiceEtapa,
  onConcluirEtapas,
  concluirEtapasDesabilitado = false,
  concluirEtapasCarregando = false,
  secaoIdsAvancoAutomaticoEtapas,
  onSecaoAtivaChange,
  onAposAvancarEtapas,
  controleEtapasExternoRef,
  tituloComBarraVerde = false,
  subtituloAgrupadoAoTitulo = false,
}: LigaFormularioBaseProps) {
  const t = useTranslations("home.formulario");
  const primeira = secoes[0]?.id ?? "";
  const secaoPadrao =
    secaoInicialId && secoes.some((s) => s.id === secaoInicialId) ? secaoInicialId : primeira;
  const [secaoAtiva, setSecaoAtiva] = useState(secaoPadrao);
  const [indiceEtapaMaxDesbloqueado, setIndiceEtapaMaxDesbloqueado] = useState(0);
  const [mensagemErroEtapa, setMensagemErroEtapa] = useState<string | null>(null);
  const secaoConteudoRef = useRef<HTMLDivElement | null>(null);
  const ativo = secoes.find((s) => s.id === secaoAtiva);
  const ehEtapas = navegacaoSecoes === "etapasHorizontais";
  const ehAbasTopo = navegacaoSecoes === "abasTopo";
  const ehFaixaHorizontal = ehEtapas || ehAbasTopo;
  const ehSidebar = navegacaoSecoes === "sidebar";

  const idsConcatenados = secoes.map((s) => s.id).join("|");
  useEffect(() => {
    if (secoes.length === 0) return;
    if (!secoes.some((s) => s.id === secaoAtiva)) {
      const fallback =
        secaoInicialId && secoes.some((s) => s.id === secaoInicialId) ? secaoInicialId : secoes[0].id;
      setSecaoAtiva(fallback);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps -- `idsConcatenados` detecta mudança da lista; `secoes` no closure é o da renderização corrente.
  }, [idsConcatenados, secaoAtiva, secaoInicialId]);

  /** Quando a identidade da lista de seções muda (ex.: layout trocado com GET), re-alinha a aba a `secaoInicialId` vinda do pai. MCP `padroes/ui` §8.4. */
  const idsAnterioresRef = useRef<string | null>(null);
  useLayoutEffect(() => {
    if (secoes.length === 0) {
      return;
    }
    const inicioValida =
      secaoInicialId && secoes.some((s) => s.id === secaoInicialId) ? secaoInicialId : null;
    const listaMudou =
      idsAnterioresRef.current != null && idsAnterioresRef.current !== idsConcatenados;
    idsAnterioresRef.current = idsConcatenados;
    if (inicioValida && listaMudou && secaoAtiva !== inicioValida) {
      setSecaoAtiva(inicioValida);
    }
  }, [idsConcatenados, secoes, secaoInicialId, secaoAtiva]);

  const indiceSecaoAtiva = useMemo(
    () => secoes.findIndex((s) => s.id === secaoAtiva),
    [secoes, secaoAtiva],
  );

  useEffect(() => {
    if (!aoMudarIndiceEtapa) return;
    if (indiceSecaoAtiva < 0) return;
    aoMudarIndiceEtapa(indiceSecaoAtiva, secoes.length);
  }, [aoMudarIndiceEtapa, indiceSecaoAtiva, secoes.length]);

  useEffect(() => {
    if (!secaoAtiva || !onSecaoAtivaChange) return;
    onSecaoAtivaChange(secaoAtiva);
  }, [secaoAtiva, onSecaoAtivaChange]);

  /**
   * Validação: sempre alinhar a aba lateral à seção do primeiro erro (ordem do layout no pai).
   * Deve reexecutar quando `secaoAtiva !== secaoParaAtivar` — o usuário pode ter mudado de
   * seção manualmente com erros ainda pendentes; o ref antigo “já ativei essa seção” impedia
   * remontar o conteúdo e quebrava o foco em `[data-campo-chave]` (MCP `padroes/ui` §8).
   *
   * Em modo etapas, expande também `indiceEtapaMaxDesbloqueado` até o índice da seção com erro
   * para não “prender” o usuário em uma etapa posterior inacessível.
   */
  useLayoutEffect(() => {
    if (!secaoParaAtivar) return;
    const idx = secoes.findIndex((s) => s.id === secaoParaAtivar);
    if (idx < 0) return;
    if (secaoAtiva !== secaoParaAtivar) {
      setSecaoAtiva(secaoParaAtivar);
    }
    if (ehEtapas) {
      setIndiceEtapaMaxDesbloqueado((atual) => (idx > atual ? idx : atual));
    }
  }, [secaoParaAtivar, secaoAtiva, idsConcatenados, secoes, ehEtapas]);

  /** Após alinhar `secaoParaAtivar`, foca o primeiro campo habilitado da seção visível. */
  useLayoutEffect(() => {
    const idFrame = window.requestAnimationFrame(() => {
      focarPrimeiroCampoHabilitado(secaoConteudoRef.current);
    });
    return () => window.cancelAnimationFrame(idFrame);
  }, [secaoAtiva]);

  const tentarSelecionarEtapa = useCallback(
    (id: string) => {
      if (!ehEtapas) {
        setSecaoAtiva(id);
        return;
      }
      const idx = secoes.findIndex((s) => s.id === id);
      if (idx < 0) return;
      if (idx > indiceEtapaMaxDesbloqueado) {
        setMensagemErroEtapa(t("etapas.etapaBloqueada"));
        return;
      }
      setMensagemErroEtapa(null);
      setSecaoAtiva(id);
    },
    [ehEtapas, secoes, indiceEtapaMaxDesbloqueado, t],
  );

  const acoesEtapasRef = useRef<{
    avancarEtapa: () => void;
    tentarSelecionarEtapa: (id: string) => void;
  }>({
    avancarEtapa: () => {},
    tentarSelecionarEtapa: () => {},
  });

  const avancarEtapa = useCallback(() => {
    if (!ehEtapas) return;
    if (indiceSecaoAtiva < 0) return;
    const atualId = secoes[indiceSecaoAtiva]?.id;
    if (!atualId) return;
    const erro = validarEtapaAntesDeAvancar?.(atualId) ?? null;
    if (erro) {
      setMensagemErroEtapa(erro);
      return;
    }
    setMensagemErroEtapa(null);
    const ultimaEtapa = indiceSecaoAtiva >= secoes.length - 1;
    if (ultimaEtapa && onConcluirEtapas) {
      onConcluirEtapas();
      return;
    }
    const proxIndice = Math.min(indiceSecaoAtiva + 1, secoes.length - 1);
    setIndiceEtapaMaxDesbloqueado((atual) => (proxIndice > atual ? proxIndice : atual));
    const proxId = secoes[proxIndice]?.id;
    if (proxId) {
      setSecaoAtiva(proxId);
      onAposAvancarEtapas?.(atualId, proxId);
    }
  }, [
    ehEtapas,
    indiceSecaoAtiva,
    secoes,
    validarEtapaAntesDeAvancar,
    onConcluirEtapas,
    onAposAvancarEtapas,
  ]);

  useLayoutEffect(() => {
    acoesEtapasRef.current = { avancarEtapa, tentarSelecionarEtapa };
  }, [avancarEtapa, tentarSelecionarEtapa]);

  useLayoutEffect(() => {
    if (!controleEtapasExternoRef) return;
    if (!ehEtapas) {
      controleEtapasExternoRef.current = null;
      return;
    }
    const api: LigaFormularioEtapasControle = {
      avancar: () => acoesEtapasRef.current.avancarEtapa(),
      tentarIrParaSecao: (secaoId: string) =>
        acoesEtapasRef.current.tentarSelecionarEtapa(secaoId),
    };
    controleEtapasExternoRef.current = api;
    return () => {
      controleEtapasExternoRef.current = null;
    };
  }, [ehEtapas, controleEtapasExternoRef]);

  /**
   * Avanço automático na fronteira do wizard: quando a etapa atual está na lista
   * e o validador libera, vai para a próxima aba (nunca na última — não dispara Salvar).
   */
  useEffect(() => {
    if (!ehEtapas) return;
    const ids = secaoIdsAvancoAutomaticoEtapas;
    if (!ids?.length || !validarEtapaAntesDeAvancar) return;
    if (indiceSecaoAtiva < 0) return;
    if (indiceSecaoAtiva !== indiceEtapaMaxDesbloqueado) return;

    const atualId = secoes[indiceSecaoAtiva]?.id;
    if (!atualId || !ids.includes(atualId)) return;

    const ultimaEtapa = indiceSecaoAtiva >= secoes.length - 1;
    if (ultimaEtapa) return;

    const erro = validarEtapaAntesDeAvancar(atualId);
    if (erro != null) return;

    const proxIndice = indiceSecaoAtiva + 1;
    if (proxIndice >= secoes.length) return;
    const proxId = secoes[proxIndice]?.id;
    if (!proxId) return;

    const raf = window.requestAnimationFrame(() => {
      setMensagemErroEtapa(null);
      setIndiceEtapaMaxDesbloqueado((atual) => (proxIndice > atual ? proxIndice : atual));
      setSecaoAtiva(proxId);
      onAposAvancarEtapas?.(atualId, proxId);
    });
    return () => window.cancelAnimationFrame(raf);
    // `secoes` muda de referência a cada render do pai — não listar aqui para não
    // cancelar o rAF antes do avanço; `idsConcatenados` cobre mudança real de abas.
    // eslint-disable-next-line react-hooks/exhaustive-deps -- secoes só leitura via closure
  }, [
    ehEtapas,
    secaoIdsAvancoAutomaticoEtapas,
    validarEtapaAntesDeAvancar,
    indiceSecaoAtiva,
    indiceEtapaMaxDesbloqueado,
    idsConcatenados,
    onAposAvancarEtapas,
  ]);

  const voltarEtapa = useCallback(() => {
    if (!ehEtapas) return;
    if (indiceSecaoAtiva <= 0) return;
    setMensagemErroEtapa(null);
    const antId = secoes[indiceSecaoAtiva - 1]?.id;
    if (antId) setSecaoAtiva(antId);
  }, [ehEtapas, indiceSecaoAtiva, secoes]);

  const mostrarTopoFormulario = !semTituloTopo || Boolean(barraAcoes);
  const ehUltimaEtapa = ehEtapas && indiceSecaoAtiva === secoes.length - 1;
  const rodapeConcluir = Boolean(ehUltimaEtapa && onConcluirEtapas);
  const ehPrimeiraEtapa = ehEtapas && indiceSecaoAtiva <= 0;
  const mensagemAlertaTopo = mensagemErroGlobal ?? (ehEtapas ? mensagemErroEtapa : null);
  const ariaAbasTopo = t("abasTopo.abasAria");

  return (
    <div className="liga-formulario">
      {mostrarTopoFormulario ? (
        <header
          className={
            semTituloTopo
              ? "liga-formulario-topo liga-formulario-topo--so-acoes"
              : "liga-formulario-topo"
          }
        >
          {!semTituloTopo ? (
            <div
              className={
                tituloComBarraVerde
                  ? "liga-formulario-topo-textos liga-formulario-topo-textos--barra-listagem"
                  : "liga-formulario-topo-textos"
              }
            >
              {tituloComBarraVerde ? (
                <span className="liga-formulario-barra-verde" aria-hidden="true" />
              ) : null}
              <div
                className={
                  tituloComBarraVerde
                    ? "liga-formulario-topo-textos-inner"
                    : "liga-formulario-topo-textos-inner liga-formulario-topo-textos-inner--solto"
                }
              >
                <h1 className="liga-formulario-titulo">
                  {iconeTitulo ? (
                    <i
                      className={`pi ${iconeTitulo} liga-formulario-titulo-icone`}
                      aria-hidden="true"
                    />
                  ) : null}
                  {subtituloAgrupadoAoTitulo ? (
                    <span className="liga-formulario-titulo-coluna-texto">
                      <span className="liga-formulario-titulo-nome">{titulo}</span>
                      {subtitulo ? (
                        <span className="liga-formulario-subtitulo-interno">{subtitulo}</span>
                      ) : null}
                    </span>
                  ) : (
                    titulo
                  )}
                  {sufixoTitulo ?? null}
                </h1>
                {subtitulo && !subtituloAgrupadoAoTitulo ? (
                  <p className="liga-formulario-subtitulo">{subtitulo}</p>
                ) : null}
              </div>
            </div>
          ) : null}
          {barraAcoes ? (
            <div className="liga-formulario-acoes-topo">{barraAcoes}</div>
          ) : null}
        </header>
      ) : null}

      {abaixoDoTopo ? (
        <div className="liga-formulario-abaixo-topo">{abaixoDoTopo}</div>
      ) : null}

      {ehEtapas ? (
        <div
          className="liga-home-abas-faixa liga-formulario-etapas-faixa"
          aria-label={t("etapas.abasAria")}
        >
          <div className="liga-home-abas-faixa-linha">
            <div
              className="liga-home-abas-lista"
              role="tablist"
              aria-label={t("etapas.abasAria")}
            >
              {secoes.map((secao, i) => {
                const ativa = secao.id === secaoAtiva;
                const concluida = i < indiceEtapaMaxDesbloqueado;
                const bloqueada = i > indiceEtapaMaxDesbloqueado;
                const tituloEtapa = `${i + 1}. ${secao.titulo}`;
                return (
                  <div
                    key={secao.id}
                    className={
                      bloqueada
                        ? "liga-formulario-etapa-wrap liga-formulario-etapa-wrap--bloqueada"
                        : concluida
                          ? "liga-formulario-etapa-wrap liga-formulario-etapa-wrap--concluida"
                          : "liga-formulario-etapa-wrap"
                    }
                    aria-disabled={bloqueada ? "true" : undefined}
                  >
                    <LigaAba
                      icone={secao.icone}
                      titulo={tituloEtapa}
                      ativa={ativa}
                      fechavel={false}
                      ariaFechar=""
                      aoAtivar={() => tentarSelecionarEtapa(secao.id)}
                      aoFechar={() => {}}
                    />
                  </div>
                );
              })}
            </div>
          </div>
        </div>
      ) : null}

      {ehAbasTopo ? (
        <div
          className="liga-home-abas-faixa liga-formulario-etapas-faixa"
          aria-label={ariaAbasTopo}
        >
          <div className="liga-home-abas-faixa-linha">
            <div className="liga-home-abas-lista" role="tablist" aria-label={ariaAbasTopo}>
              {secoes.map((secao) => {
                const ativa = secao.id === secaoAtiva;
                return (
                  <div key={secao.id} className="liga-formulario-etapa-wrap">
                    <LigaAba
                      icone={secao.icone}
                      titulo={secao.titulo}
                      ativa={ativa}
                      fechavel={false}
                      ariaFechar=""
                      aoAtivar={() => setSecaoAtiva(secao.id)}
                      aoFechar={() => {}}
                    />
                  </div>
                );
              })}
            </div>
          </div>
        </div>
      ) : null}

      {mensagemAlertaTopo ? (
        <Message
          severity="error"
          text={mensagemAlertaTopo}
          className="liga-formulario-alerta-erro w-full"
          role="alert"
        />
      ) : null}

      <div
        className={
          ehFaixaHorizontal
            ? "liga-formulario-layout liga-formulario-layout--etapas"
            : "liga-formulario-layout"
        }
      >
        {ehSidebar ? (
          <nav
            className="liga-formulario-sidebar"
            aria-label={t("nav.aria")}
          >
            <ul className="liga-formulario-sidebar-lista">
              {secoes.map((secao) => {
                const selecionada = secao.id === secaoAtiva;
                return (
                  <li key={secao.id}>
                    <button
                      type="button"
                      className={
                        selecionada
                          ? "liga-formulario-nav-item liga-formulario-nav-item-ativo"
                          : "liga-formulario-nav-item"
                      }
                      onClick={() => setSecaoAtiva(secao.id)}
                      aria-current={selecionada ? "true" : undefined}
                    >
                      <i className={`pi ${secao.icone} liga-formulario-nav-icone`} aria-hidden />
                      <span className="liga-formulario-nav-texto">{secao.titulo}</span>
                    </button>
                  </li>
                );
              })}
            </ul>
          </nav>
        ) : null}

        <div className="liga-formulario-main">
          {ativo ? (
            <>
              <div className="liga-formulario-cartao">
                <div className="liga-formulario-secao-cabecalho">
                  <span className="liga-formulario-barra-verde" aria-hidden="true" />
                  <div className="liga-formulario-secao-cabecalho-textos">
                    {ativo.conteudoAoLadoDoTituloSecao ? (
                      <div className="liga-formulario-secao-titulo-linha">
                        <h2 className="liga-formulario-secao-titulo">{ativo.titulo}</h2>
                        <div className="liga-formulario-secao-ao-lado-titulo">
                          {ativo.conteudoAoLadoDoTituloSecao}
                        </div>
                      </div>
                    ) : (
                      <h2 className="liga-formulario-secao-titulo">{ativo.titulo}</h2>
                    )}
                    {ativo.descricao ? (
                      <p className="liga-formulario-secao-descricao">{ativo.descricao}</p>
                    ) : null}
                  </div>
                  {ativo.acoesCabecalho ? (
                    <div className="liga-formulario-secao-cabecalho-acoes">
                      {ativo.acoesCabecalho}
                    </div>
                  ) : null}
                </div>
                <div ref={secaoConteudoRef} className="liga-formulario-secao-conteudo">
                  {ativo.conteudo}
                </div>
                {ehEtapas ? (
                  <div className="liga-formulario-etapas-rodape">
                    <Button
                      type="button"
                      label={t("etapas.voltar")}
                      icon="pi pi-chevron-left"
                      outlined
                      onClick={voltarEtapa}
                      disabled={ehPrimeiraEtapa}
                    />
                    <Button
                      type="button"
                      id={
                        rodapeConcluir
                          ? LIGA_FORMULARIO_ETAPAS_BOTAO_CONCLUIR_ID
                          : LIGA_FORMULARIO_ETAPAS_BOTAO_AVANCAR_ID
                      }
                      label={rodapeConcluir ? t("etapas.concluir") : t("etapas.avancar")}
                      icon={rodapeConcluir ? "pi pi-check" : "pi pi-chevron-right"}
                      iconPos="right"
                      onClick={avancarEtapa}
                      disabled={
                        ehEtapas &&
                        (ehUltimaEtapa
                          ? !onConcluirEtapas || Boolean(concluirEtapasDesabilitado)
                          : false)
                      }
                      loading={rodapeConcluir && concluirEtapasCarregando}
                    />
                  </div>
                ) : null}
              </div>
              {temLegendaCamposObrigatorios ? (
                <p className="liga-formulario-legenda-obrigatorio-fora" role="note">
                  <span className="liga-formulario-legenda-obrigatorio-fora-asterisco" aria-hidden="true">
                    *
                  </span>{" "}
                  <span>{t("legendaAsteriscoCampoObrigatorio")}</span>
                </p>
              ) : null}
            </>
          ) : null}
        </div>
      </div>
    </div>
  );
}
