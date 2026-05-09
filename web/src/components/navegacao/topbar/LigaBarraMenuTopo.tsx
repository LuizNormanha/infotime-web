"use client";

import type { ForwardedRef } from "react";
import {
  forwardRef,
  useCallback,
  useEffect,
  useLayoutEffect,
  useMemo,
  useRef,
  useState,
} from "react";
import { createPortal } from "react-dom";
import { useTranslations } from "next-intl";
import "./liga-barra-menu-topo.css";

import { LigaMenuListaCascata } from "../menu/LigaMenuListaCascata";
import {
  descendenteAtivo,
  normalizarMenu,
  type LigaNoMenu,
} from "../menu/liga-menu-arvore";
import { iconeMenuItem } from "../menu/liga-menu-icones";
import { rotuloItemMenu } from "../menu/liga-menu-rotulo";
import type { LigaMenuEstruturaIds, LigaMenuId } from "../menu/liga-menu-tipos";

type PainelTopo = {
  id: LigaMenuId;
  left: number;
  top: number;
  minWidth: number;
  filhos: LigaNoMenu[];
};

function ajustarPainelTopo(
  left: number,
  top: number,
  larguraAprox = 340,
): { left: number; top: number } {
  const margem = 8;
  const vw = typeof window !== "undefined" ? window.innerWidth : 1200;
  const vh = typeof window !== "undefined" ? window.innerHeight : 800;
  let l = left;
  if (l + larguraAprox > vw - margem) {
    l = Math.max(margem, vw - larguraAprox - margem);
  }
  let t = top;
  if (t > vh - 100) {
    t = Math.max(margem, vh - 420);
  }
  return { left: l, top: t };
}

export type LigaBarraMenuTopoProps = {
  menuIds: LigaMenuEstruturaIds;
  itemAtivoId: string;
  aoSelecionarItem: (menuId: string) => void;
  /** Incrementado pela busca do menu para fechar o painel suspenso */
  fecharPainelSinal?: number;
  /** Só mede a largura da linha (fora da tela); sem pop-ups */
  medicaoSomente?: boolean;
};

export const LigaBarraMenuTopo = forwardRef<HTMLElement, LigaBarraMenuTopoProps>(
  function LigaBarraMenuTopo(
    {
      menuIds,
      itemAtivoId,
      aoSelecionarItem,
      fecharPainelSinal,
      medicaoSomente = false,
    },
    refExterno,
  ) {
    const t = useTranslations("home");
    const rotuloItem = useCallback(
      (id: LigaMenuId) => rotuloItemMenu(id, (chave) => t(chave)),
      [t],
    );
    const [painelTopo, setPainelTopo] = useState<PainelTopo | null>(null);
    const [epochRolagemMenu, setEpochRolagemMenu] = useState(0);
    const refBarra = useRef<HTMLElement>(null);
    const refPainelPortal = useRef<HTMLDivElement>(null);
    const refUltimoFecharSinal = useRef(0);
    /** `undefined` = ainda não houve commit; depois guarda o último `painelTopo?.id` (null se fechado). */
    const refPainelTopoIdSig = useRef<string | null | undefined>(undefined);

    const arvoreMenu = useMemo(() => normalizarMenu(menuIds), [menuIds]);

    /**
     * Folhas promovidas diretamente na barra (ex.: «Clientes» = `cadastros-clientes`).
     * O mesmo id pode existir na árvore DST sob um pai (ex.: Comercial); nesse caso o destino
     * real é a folha da barra — o pai não deve ficar com o mesmo destaque «ativo».
     */
    const idsItemFolhaNaRaiz = useMemo(
      () =>
        new Set(
          arvoreMenu
            .filter((n) => n.filhos.length === 0)
            .map((n) => n.id),
        ),
      [arvoreMenu],
    );

    /** Evita :hover “preso” em alguns browsers após fechar o painel em portal (sem alterar estado React). */
    function limparHoverPresoNaBarra(nav: HTMLElement | null) {
      if (!nav || typeof window === "undefined") return;
      const ae = document.activeElement;
      if (ae && nav.contains(ae) && ae instanceof HTMLElement) {
        ae.blur();
      }
      const prevPe = nav.style.pointerEvents;
      nav.style.pointerEvents = "none";
      requestAnimationFrame(() => {
        nav.style.pointerEvents = prevPe;
      });
    }

    useLayoutEffect(() => {
      if (medicaoSomente) return;
      const idAtual = painelTopo?.id ?? null;
      const anterior = refPainelTopoIdSig.current;
      refPainelTopoIdSig.current = idAtual;
      if (anterior === undefined) {
        return;
      }
      if (anterior === idAtual) {
        return;
      }
      limparHoverPresoNaBarra(refBarra.current);
    }, [painelTopo, medicaoSomente]);

    function combinarRef(el: HTMLElement | null) {
      refBarra.current = el;
      const ext = refExterno as ForwardedRef<HTMLElement>;
      if (typeof ext === "function") ext(el);
      else if (ext) ext.current = el;
    }

    useEffect(() => {
      setPainelTopo(null);
    }, [itemAtivoId]);

    useEffect(() => {
      if (fecharPainelSinal == null) return;
      if (fecharPainelSinal === refUltimoFecharSinal.current) return;
      refUltimoFecharSinal.current = fecharPainelSinal;
      setPainelTopo(null);
    }, [fecharPainelSinal]);

    useEffect(() => {
      function fecharSeFora(evento: MouseEvent) {
        const alvo = evento.target as Node;
        if (refPainelPortal.current?.contains(alvo)) return;
        if (refBarra.current?.contains(alvo)) return;
        setPainelTopo(null);
      }
      if (painelTopo && !medicaoSomente) {
        document.addEventListener("mousedown", fecharSeFora);
        return () => document.removeEventListener("mousedown", fecharSeFora);
      }
    }, [painelTopo, medicaoSomente]);

    function abrirPainelTopo(no: LigaNoMenu, ancora: HTMLElement) {
      const r = ancora.getBoundingClientRect();
      const minWidth = Math.max(220, r.width);
      const pos = ajustarPainelTopo(r.left, r.bottom + 4);
      setPainelTopo({
        id: no.id,
        left: pos.left,
        top: pos.top,
        minWidth,
        filhos: no.filhos,
      });
    }

    const classesNav = [
      "liga-barra-menu-topo",
      medicaoSomente ? "liga-barra-menu-topo--medicao" : "",
    ]
      .filter(Boolean)
      .join(" ");

    if (medicaoSomente) {
      return (
        <nav
          ref={combinarRef}
          className={classesNav}
          aria-hidden
        >
          {arvoreMenu.map((no) => {
            const possuiFilhos = no.filhos.length > 0;
            if (possuiFilhos) {
              return (
                <div key={no.id} className="liga-barra-menu-topo-raiz">
                  <span className="liga-barra-menu-topo-gatilho">
                    <i className={`pi ${iconeMenuItem(no.id)}`} aria-hidden />
                    <span>{rotuloItem(no.id)}</span>
                    <i className="pi pi-chevron-down liga-barra-menu-topo-chevron" aria-hidden />
                  </span>
                </div>
              );
            }
            return (
              <div key={no.id} className="liga-barra-menu-topo-raiz">
                <span className="liga-barra-menu-topo-gatilho liga-barra-menu-topo-gatilho--folha">
                  <i className={`pi ${iconeMenuItem(no.id)}`} aria-hidden />
                  <span>{rotuloItem(no.id)}</span>
                </span>
              </div>
            );
          })}
        </nav>
      );
    }

    return (
      <>
        <nav
          ref={combinarRef}
          className={classesNav}
          aria-label={t("menu.aria")}
        >
          {arvoreMenu.map((no) => {
            const possuiFilhos = no.filhos.length > 0;
            const painelAberto = painelTopo?.id === no.id;
            const ativa =
              Boolean(itemAtivoId) &&
              descendenteAtivo(no, itemAtivoId) &&
              !painelAberto &&
              !idsItemFolhaNaRaiz.has(itemAtivoId);

            if (possuiFilhos) {
              return (
                <div key={no.id} className="liga-barra-menu-topo-raiz">
                  <button
                    type="button"
                    className={`liga-barra-menu-topo-gatilho ${painelAberto ? "aberta" : ""} ${ativa ? "ativa" : ""}`}
                    aria-expanded={painelAberto}
                    aria-haspopup="true"
                    onClick={(evento) => {
                      const el = evento.currentTarget;
                      if (painelAberto) {
                        setPainelTopo(null);
                      } else {
                        abrirPainelTopo(no, el);
                      }
                    }}
                  >
                    <i className={`pi ${iconeMenuItem(no.id)}`} aria-hidden />
                    <span>{rotuloItem(no.id)}</span>
                    <i
                      className={`pi ${painelAberto ? "pi-chevron-up" : "pi-chevron-down"} liga-barra-menu-topo-chevron`}
                      aria-hidden
                    />
                  </button>
                </div>
              );
            }

            const ativaFolha =
              itemAtivoId &&
              (no.id === itemAtivoId || descendenteAtivo(no, itemAtivoId));

            return (
              <div key={no.id} className="liga-barra-menu-topo-raiz">
                <button
                  type="button"
                  className={`liga-barra-menu-topo-gatilho liga-barra-menu-topo-gatilho--folha ${ativaFolha ? "ativa" : ""}`}
                  onClick={() => {
                    aoSelecionarItem(no.id);
                    setPainelTopo(null);
                  }}
                >
                  <i className={`pi ${iconeMenuItem(no.id)}`} aria-hidden />
                  <span>{rotuloItem(no.id)}</span>
                </button>
              </div>
            );
          })}
        </nav>

        {painelTopo && typeof document !== "undefined"
          ? createPortal(
              <div
                ref={refPainelPortal}
                className="liga-menu-cascata-painel-raiz liga-menu-cascata-painel-raiz--barra-topo"
                style={{
                  left: painelTopo.left,
                  top: painelTopo.top,
                  minWidth: painelTopo.minWidth,
                }}
                onScroll={() => setEpochRolagemMenu((n) => n + 1)}
              >
                <LigaMenuListaCascata
                  filhos={painelTopo.filhos}
                  rotuloItem={rotuloItem}
                  scrollEpoch={epochRolagemMenu}
                  aoClicarFolha={(id) => {
                    aoSelecionarItem(id);
                    setPainelTopo(null);
                  }}
                />
              </div>,
              document.body,
            )
          : null}
      </>
    );
  },
);
