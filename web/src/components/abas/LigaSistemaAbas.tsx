"use client";

import { createPortal } from "react-dom";
import type { MouseEvent as ReactMouseEvent } from "react";
import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
} from "react";
import { useTranslations } from "next-intl";
import "./liga-sistema-abas.css";

import { TelaAtivaContext } from "@/contexts/TelaAtivaContext";
import { LigaAba } from "@/components/abas/LigaAba";
import { LigaMensagemPopUp } from "@/components/ui/dialogo/LigaMensagemPopUp";
import { LigaClienteInfotimePainel } from "@/components/cliente/LigaClienteInfotimePainel";
import { useSessaoAtual } from "@/hooks/useSessaoAtual";

/** Aba do shell da home (cadastros serão recriados para o DDL InfoTIME). */
export type LigaAbaHome = {
  id: string;
  tituloExplicito?: string;
  tituloKey: string;
  icone: string;
  fechavel: boolean;
  conteudoKey: string;
  sorotecaCadastroSlug?: string;
};

type LigaSistemaAbasProps = {
  abas: LigaAbaHome[];
  abaAtivaId: string;
  aoAtivarAba: (id: string) => void;
  aoFecharAba: (id: string) => void;
  aoFecharTodasAbas: () => void;
};

type TipoPainelAtivoDebug = "listagem" | "formulario";
type EventoPainelAtivoDebug = { tipo?: TipoPainelAtivoDebug; nomeTabela?: string };

/** Slug da tela ativa para BFF/layout (apenas telas já existentes). */
export function resolverSlugTela(conteudoKey: string): string | null {
  if (conteudoKey === "dashboard") return "";
  return null;
}

function AbaAjudaEstatica({
  aba,
  chave,
}: {
  aba: LigaAbaHome;
  chave: "ajudaDocumentacao" | "ajudaSuporte";
}) {
  const t = useTranslations("home");
  const subtitulo = t(`conteudo.${chave}.subtitulo`);
  return (
    <div className="liga-home-modulo-vazio">
      <header className="liga-home-modulo-cabecalho">
        <div className="liga-home-modulo-titulo-linha">
          <span className="liga-home-modulo-barra-verde" aria-hidden="true" />
          <h1 className="liga-home-modulo-titulo-principal">
            <i className={`pi ${aba.icone} liga-home-modulo-titulo-icone`} aria-hidden="true" />
            {t(`conteudo.${chave}.titulo`)}
          </h1>
        </div>
        {subtitulo ? <p className="liga-home-modulo-subtitulo">{subtitulo}</p> : null}
      </header>
      <div className="liga-home-conteudo-area-vazia">{t(`conteudo.${chave}.vazio`)}</div>
    </div>
  );
}

export function LigaSistemaAbas({
  abas,
  abaAtivaId,
  aoAtivarAba,
  aoFecharAba,
  aoFecharTodasAbas,
}: LigaSistemaAbasProps) {
  const t = useTranslations("home");
  const sessao = useSessaoAtual();

  const abaAtiva =
    abas.find((aba) => aba.id === abaAtivaId) ??
    abas.find((aba) => aba.id === "dashboard") ??
    abas[0];

  const abaRefs = useRef<Record<string, HTMLDivElement | null>>({});
  const refMenuContexto = useRef<HTMLDivElement>(null);
  const [posMenuContexto, setPosMenuContexto] = useState<{ x: number; y: number } | null>(null);
  const [dialogoFecharTodas, setDialogoFecharTodas] = useState(false);
  const [mostrarModalDebugTela, setMostrarModalDebugTela] = useState(false);
  const [tipoPainelAtivoDebug, setTipoPainelAtivoDebug] =
    useState<TipoPainelAtivoDebug>("listagem");
  const [nomeTabelaListagemDebug, setNomeTabelaListagemDebug] = useState<string | null>(null);

  const temAbasFechaveis = useMemo(() => abas.some((a) => a.fechavel), [abas]);

  const abrirMenuContextoAbas = (evento: ReactMouseEvent<HTMLDivElement>) => {
    if (!temAbasFechaveis) return;
    evento.preventDefault();
    const margem = 8;
    const wAproxMenu = 200;
    const hAproxMenu = 88;
    let x = evento.clientX;
    let y = evento.clientY;
    if (typeof window !== "undefined") {
      x = Math.min(x, window.innerWidth - wAproxMenu - margem);
      y = Math.min(y, window.innerHeight - hAproxMenu - margem);
      x = Math.max(margem, x);
      y = Math.max(margem, y);
    }
    setPosMenuContexto({ x, y });
  };

  useEffect(() => {
    if (!posMenuContexto) return;
    const fecharMenu = () => setPosMenuContexto(null);
    const onKey = (ev: KeyboardEvent) => {
      if (ev.key === "Escape") fecharMenu();
    };
    const onMouseDown = (ev: globalThis.MouseEvent) => {
      if (refMenuContexto.current?.contains(ev.target as Node)) return;
      fecharMenu();
    };
    document.addEventListener("keydown", onKey);
    document.addEventListener("mousedown", onMouseDown);
    return () => {
      document.removeEventListener("keydown", onKey);
      document.removeEventListener("mousedown", onMouseDown);
    };
  }, [posMenuContexto]);

  useEffect(() => {
    const onPainelAtivo = (ev: Event) => {
      const detalhe = (ev as CustomEvent<EventoPainelAtivoDebug>).detail;
      if (!detalhe?.tipo) return;
      setTipoPainelAtivoDebug(detalhe.tipo);
      if (detalhe.tipo === "listagem") {
        setNomeTabelaListagemDebug(detalhe.nomeTabela?.trim() || null);
      }
    };
    window.addEventListener("liga:debug-painel-ativo", onPainelAtivo as EventListener);
    return () => {
      window.removeEventListener("liga:debug-painel-ativo", onPainelAtivo as EventListener);
    };
  }, []);

  const listaScrollRef = useRef<HTMLDivElement>(null);
  const [scrollAbas, setScrollAbas] = useState({
    mostrarNavegacao: false,
    podeEsquerda: false,
    podeDireita: false,
  });

  const sincronizarScrollAbas = useCallback(() => {
    const el = listaScrollRef.current;
    if (!el) return;
    const { scrollLeft, scrollWidth, clientWidth } = el;
    const max = scrollWidth - clientWidth;
    const mostrarNavegacao = max > 4;
    setScrollAbas({
      mostrarNavegacao,
      podeEsquerda: mostrarNavegacao && scrollLeft > 4,
      podeDireita: mostrarNavegacao && scrollLeft < max - 4,
    });
  }, []);

  useLayoutEffect(() => {
    sincronizarScrollAbas();
  }, [abas, sincronizarScrollAbas]);

  useEffect(() => {
    const el = listaScrollRef.current;
    if (!el) return;
    const ro = new ResizeObserver(() => sincronizarScrollAbas());
    ro.observe(el);
    el.addEventListener("scroll", sincronizarScrollAbas, { passive: true });
    return () => {
      ro.disconnect();
      el.removeEventListener("scroll", sincronizarScrollAbas);
    };
  }, [sincronizarScrollAbas]);

  const rolarAbas = (direcao: -1 | 1) => {
    const el = listaScrollRef.current;
    if (!el) return;
    const passo = Math.max(100, Math.round(el.clientWidth * 0.4));
    el.scrollBy({ left: passo * direcao, behavior: "smooth" });
  };

  useEffect(() => {
    const alvo = abaRefs.current[abaAtivaId];
    if (!alvo) return;
    alvo.scrollIntoView({ behavior: "smooth", inline: "center", block: "nearest" });
  }, [abaAtivaId]);

  function renderConteudo(aba: LigaAbaHome) {
    if (aba.conteudoKey === "emBreve") {
      return (
        <div className="liga-home-modulo-vazio">
          <header className="liga-home-modulo-cabecalho">
            <div className="liga-home-modulo-titulo-linha">
              <span className="liga-home-modulo-barra-verde" aria-hidden="true" />
              <h1 className="liga-home-modulo-titulo-principal">
                <i className={`pi ${aba.icone} liga-home-modulo-titulo-icone`} aria-hidden="true" />
                {aba.tituloExplicito ?? t("conteudo.emBreve.titulo")}
              </h1>
            </div>
          </header>
          <div className="liga-home-conteudo-area-vazia">{t("conteudo.emBreve.vazio")}</div>
        </div>
      );
    }
    if (aba.conteudoKey === "ajudaDocumentacao") {
      return <AbaAjudaEstatica aba={aba} chave="ajudaDocumentacao" />;
    }
    if (aba.conteudoKey === "ajudaSuporte") {
      return <AbaAjudaEstatica aba={aba} chave="ajudaSuporte" />;
    }
    if (aba.conteudoKey === "cadastroClienteInfotime") {
      return (
        <LigaClienteInfotimePainel idTenacidade={sessao.idTenacidade} />
      );
    }
    if (aba.conteudoKey === "dashboard") {
      const subtitulo = t("conteudo.dashboard.subtitulo");
      return (
        <div className="liga-home-modulo-vazio">
          <header className="liga-home-modulo-cabecalho">
            <div className="liga-home-modulo-titulo-linha">
              <span className="liga-home-modulo-barra-verde" aria-hidden="true" />
              <h1 className="liga-home-modulo-titulo-principal">
                <i className={`pi ${aba.icone} liga-home-modulo-titulo-icone`} aria-hidden="true" />
                {t("conteudo.dashboard.titulo")}
              </h1>
            </div>
            {subtitulo ? <p className="liga-home-modulo-subtitulo">{subtitulo}</p> : null}
          </header>
          <div className="liga-home-conteudo-area-vazia">{t("conteudo.dashboard.vazio")}</div>
        </div>
      );
    }
    const titulo = aba.tituloExplicito ?? aba.tituloKey;
    return (
      <div className="liga-home-modulo-vazio">
        <header className="liga-home-modulo-cabecalho">
          <div className="liga-home-modulo-titulo-linha">
            <span className="liga-home-modulo-barra-verde" aria-hidden="true" />
            <h1 className="liga-home-modulo-titulo-principal">
              <i className={`pi ${aba.icone} liga-home-modulo-titulo-icone`} aria-hidden="true" />
              {titulo}
            </h1>
          </div>
        </header>
        <div className="liga-home-conteudo-area-vazia">
          Conteúdo desta tela será implementado no InfoTIME conforme o DDL do produto.
        </div>
      </div>
    );
  }

  const infoDebugAbaAtiva = null;

  useEffect(() => {
    const tela = abaAtiva ? resolverSlugTela(abaAtiva.conteudoKey) : null;
    window.dispatchEvent(
      new CustomEvent("liga:tela-ativa", {
        detail: { tela: tela ?? undefined },
      }),
    );
  }, [abaAtiva]);

  const slugTelaAtiva = useMemo(
    () => (abaAtiva ? resolverSlugTela(abaAtiva.conteudoKey) : null),
    [abaAtiva],
  );

  return (
    <TelaAtivaContext.Provider value={slugTelaAtiva}>
      <section className="liga-home-abas-area">
        <div className="liga-home-abas-faixa">
          <div className="liga-home-abas-faixa-linha">
            {scrollAbas.mostrarNavegacao ? (
              <button
                type="button"
                className="liga-home-abas-scroll-btn"
                disabled={!scrollAbas.podeEsquerda}
                aria-label={t("abas.rolarAnterior")}
                onClick={() => rolarAbas(-1)}
              >
                <i className="pi pi-chevron-left" aria-hidden="true" />
              </button>
            ) : null}
            <div
              ref={listaScrollRef}
              className="liga-home-abas-lista"
              role="tablist"
              aria-label={t("abas.aria")}
            >
              {abas.map((aba) => (
                <LigaAba
                  key={aba.id}
                  setRef={(el: HTMLDivElement | null) => {
                    abaRefs.current[aba.id] = el;
                  }}
                  icone={aba.icone}
                  titulo={aba.tituloExplicito ?? t(`abas.${aba.tituloKey}`)}
                  ativa={aba.id === abaAtivaId}
                  fechavel={aba.fechavel}
                  ariaFechar={`${t("abas.fechar")} ${aba.tituloExplicito ?? t(`abas.${aba.tituloKey}`)}`}
                  aoAtivar={() => aoAtivarAba(aba.id)}
                  aoFechar={() => aoFecharAba(aba.id)}
                  aoMenuContexto={abrirMenuContextoAbas}
                />
              ))}
            </div>
            {scrollAbas.mostrarNavegacao ? (
              <button
                type="button"
                className="liga-home-abas-scroll-btn"
                disabled={!scrollAbas.podeDireita}
                aria-label={t("abas.rolarProxima")}
                onClick={() => rolarAbas(1)}
              >
                <i className="pi pi-chevron-right" aria-hidden="true" />
              </button>
            ) : null}
          </div>
        </div>

        <div className="liga-home-conteudo">
          {abas.map((aba) => {
            const visivel = aba.id === abaAtivaId;
            const slugPainel = resolverSlugTela(aba.conteudoKey);
            return (
              <div
                key={aba.id}
                className={
                  visivel
                    ? "liga-home-painel-aba liga-home-painel-aba-visivel"
                    : "liga-home-painel-aba"
                }
                aria-hidden={!visivel}
                data-liga-aba-id={aba.id}
              >
                <TelaAtivaContext.Provider value={slugPainel}>
                  {renderConteudo(aba)}
                </TelaAtivaContext.Provider>
              </div>
            );
          })}
        </div>

        {posMenuContexto && typeof document !== "undefined"
          ? createPortal(
              <div
                ref={refMenuContexto}
                className="liga-home-abas-menu-contexto"
                style={{ left: posMenuContexto.x, top: posMenuContexto.y }}
                role="menu"
                aria-label={t("abas.fecharTodasMenu")}
              >
                {sessao.podeVerSecaoAuditoriaFormulario ? (
                  <button
                    type="button"
                    role="menuitem"
                    className="liga-home-abas-menu-contexto-item"
                    onClick={() => {
                      setPosMenuContexto(null);
                      setMostrarModalDebugTela(true);
                    }}
                  >
                    Mostrar informacoes da aba
                  </button>
                ) : null}
                <button
                  type="button"
                  role="menuitem"
                  className="liga-home-abas-menu-contexto-item"
                  onClick={() => {
                    setPosMenuContexto(null);
                    setDialogoFecharTodas(true);
                  }}
                >
                  {t("abas.fecharTodasMenu")}
                </button>
              </div>,
              document.body,
            )
          : null}

        <LigaMensagemPopUp
          aberto={dialogoFecharTodas}
          titulo={t("abas.fecharTodasTitulo")}
          mensagem={t("abas.fecharTodasMensagem")}
          rotuloCancelar={t("abas.cancelar")}
          rotuloConfirmar={t("abas.fecharTodasConfirmar")}
          aoFechar={() => setDialogoFecharTodas(false)}
          aoConfirmar={() => {
            setDialogoFecharTodas(false);
            aoFecharTodasAbas();
          }}
        />

        {mostrarModalDebugTela ? (
          <div className="liga-home-abas-debug-overlay" role="dialog" aria-modal="true">
            <div className="liga-home-abas-debug-modal">
              <header className="liga-home-abas-debug-cabecalho">
                <h3>Informacao da aba ativa</h3>
              </header>
              <div className="liga-home-abas-debug-corpo">
                {!infoDebugAbaAtiva ? (
                  <p>
                    A aba ativa nao usa listagem/formulario padrao (templates InfoTIME em construcao).
                  </p>
                ) : null}
                {abaAtiva ? (
                  <p>
                    <strong>Painel ativo:</strong> {tipoPainelAtivoDebug}
                    {nomeTabelaListagemDebug ? (
                      <>
                        {" "}
                        / <code>{nomeTabelaListagemDebug}</code>
                      </>
                    ) : null}
                  </p>
                ) : null}
              </div>
              <footer className="liga-home-abas-debug-rodape">
                <button type="button" onClick={() => setMostrarModalDebugTela(false)}>
                  Fechar
                </button>
              </footer>
            </div>
          </div>
        ) : null}
      </section>
    </TelaAtivaContext.Provider>
  );
}
