"use client";

import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useRef,
  useState,
} from "react";
import { useTranslations } from "next-intl";
import "./liga-topbar-home.css";

import { LigaLogoMarca } from "../../imagem/LigaLogoMarca";
import { useTemaLiga } from "../home/LigaProvedorApp";
import { LigaMenuPesquisa } from "../menu/LigaMenuPesquisa";
import { LigaBarraMenuTopo } from "./LigaBarraMenuTopo";
import type { LigaMenuEstruturaIds } from "../menu/liga-menu-tipos";

type LigaTopbarHomeProps = {
  menuIds: LigaMenuEstruturaIds;
  itemAtivoId: string;
  aoSelecionarItem: (menuId: string) => void;
  aoSair: () => void;
  aoAbrirMenuMobile: () => void;
  emailUsuario: string | null;
  /** Viewport estreito: sempre menu sanduíche */
  viewportEstreito: boolean;
  /** Menu em drawer / sanduíche (viewport estreito ou barra transbordou) */
  usarDrawer: boolean;
  /** Mostrar itens na barra (false = só medir fora da tela / drawer) */
  exibirBarraNoTopo: boolean;
  /** true = menu horizontal não cabe na faixa reservada */
  onMenuHorizontalTransbordou: (transbordou: boolean) => void;
};

export function LigaTopbarHome({
  menuIds,
  itemAtivoId,
  aoSelecionarItem,
  aoSair,
  aoAbrirMenuMobile,
  emailUsuario,
  viewportEstreito,
  usarDrawer,
  exibirBarraNoTopo,
  onMenuHorizontalTransbordou,
}: LigaTopbarHomeProps) {
  const t = useTranslations("home");
  const { tema, alternarTema } = useTemaLiga();
  const refSlotMenu = useRef<HTMLDivElement>(null);
  const refNavMedir = useRef<HTMLElement>(null);
  const refMenuConta = useRef<HTMLDivElement>(null);
  const [sinalFecharPainelMenu, setSinalFecharPainelMenu] = useState(0);
  const [menuContaAberto, setMenuContaAberto] = useState(false);

  const medirTransbordo = useCallback(() => {
    if (viewportEstreito) {
      onMenuHorizontalTransbordou(false);
      return;
    }
    const slot = refSlotMenu.current;
    const nav = refNavMedir.current;
    if (!slot || !nav || slot.clientWidth < 48) return;
    const excede = nav.scrollWidth > slot.clientWidth + 2;
    onMenuHorizontalTransbordou(excede);
  }, [viewportEstreito, onMenuHorizontalTransbordou]);

  useLayoutEffect(() => {
    medirTransbordo();
  }, [medirTransbordo, menuIds, itemAtivoId]);

  useEffect(() => {
    const slot = refSlotMenu.current;
    if (!slot || typeof ResizeObserver === "undefined") return;
    const ro = new ResizeObserver(() => medirTransbordo());
    ro.observe(slot);
    return () => ro.disconnect();
  }, [medirTransbordo]);

  useEffect(() => {
    window.addEventListener("resize", medirTransbordo);
    return () => window.removeEventListener("resize", medirTransbordo);
  }, [medirTransbordo]);

  useEffect(() => {
    if (!menuContaAberto) return;
    function fecharSeFora(ev: MouseEvent) {
      const alvo = ev.target as Node;
      if (refMenuConta.current?.contains(alvo)) return;
      setMenuContaAberto(false);
    }
    function fecharEscape(ev: KeyboardEvent) {
      if (ev.key === "Escape") setMenuContaAberto(false);
    }
    document.addEventListener("mousedown", fecharSeFora);
    document.addEventListener("keydown", fecharEscape);
    return () => {
      document.removeEventListener("mousedown", fecharSeFora);
      document.removeEventListener("keydown", fecharEscape);
    };
  }, [menuContaAberto]);

  const mostrarBarraHorizontal = !viewportEstreito;

  return (
    <header
      className={`liga-home-topbar ${usarDrawer ? "liga-home-topbar--drawer" : ""}`}
    >
      <div className="liga-home-topbar-esquerda">
        <button
          type="button"
          className="liga-home-botao-menu-mobile"
          onClick={aoAbrirMenuMobile}
          aria-label={t("topbar.abrirMenu")}
        >
          <i className="pi pi-bars" aria-hidden="true" />
        </button>

        <div className="liga-home-topbar-marca">
          <LigaLogoMarca />
        </div>

        <div ref={refSlotMenu} className="liga-home-topbar-slot-menu">
          {mostrarBarraHorizontal && exibirBarraNoTopo ? (
            <LigaBarraMenuTopo
              ref={refNavMedir}
              menuIds={menuIds}
              itemAtivoId={itemAtivoId}
              fecharPainelSinal={sinalFecharPainelMenu}
              aoSelecionarItem={aoSelecionarItem}
            />
          ) : null}
        </div>
      </div>

      {mostrarBarraHorizontal && !exibirBarraNoTopo ? (
        <LigaBarraMenuTopo
          ref={refNavMedir}
          medicaoSomente
          menuIds={menuIds}
          itemAtivoId={itemAtivoId}
          fecharPainelSinal={sinalFecharPainelMenu}
          aoSelecionarItem={aoSelecionarItem}
        />
      ) : null}

      <div className="liga-home-topbar-busca">
        <LigaMenuPesquisa
          variant="topbar"
          menuIds={menuIds}
          aoSelecionarItem={aoSelecionarItem}
          aoFecharMenusRaiz={() =>
            setSinalFecharPainelMenu((n) => n + 1)
          }
        />
      </div>

      <div className="liga-home-topbar-acoes" ref={refMenuConta}>
        <div className="liga-topbar-conta-wrap">
          <button
            type="button"
            className="liga-topbar-avatar-gatilho"
            aria-label={t("topbar.menuConta")}
            aria-expanded={menuContaAberto}
            aria-haspopup="true"
            onClick={() => setMenuContaAberto((v) => !v)}
          >
            <i className="pi pi-user" aria-hidden="true" />
          </button>
          {menuContaAberto ? (
            <div
              className="liga-topbar-menu-conta"
              role="menu"
              aria-label={t("topbar.menuConta")}
            >
              <div className="liga-topbar-menu-conta-usuario">
                <span className="liga-topbar-menu-conta-avatar" aria-hidden="true">
                  <i className="pi pi-user" />
                </span>
                <span className="liga-topbar-menu-conta-email" title={emailUsuario ?? ""}>
                  {emailUsuario ?? "—"}
                </span>
              </div>
              <button
                type="button"
                className="liga-topbar-menu-conta-acao"
                role="menuitem"
                aria-label={
                  tema === "light"
                    ? t("topbar.alternarParaEscuro")
                    : t("topbar.alternarParaClaro")
                }
                onClick={() => {
                  alternarTema();
                }}
              >
                <i
                  className={`pi ${tema === "light" ? "pi-moon" : "pi-sun"}`}
                  aria-hidden="true"
                />
                <span>
                  {tema === "light" ? t("topbar.modoEscuro") : t("topbar.modoClaro")}
                </span>
              </button>
              <button
                type="button"
                className="liga-topbar-menu-conta-sair"
                role="menuitem"
                onClick={() => {
                  setMenuContaAberto(false);
                  aoSair();
                }}
              >
                <i className="pi pi-sign-out" aria-hidden="true" />
                <span>{t("topbar.sair")}</span>
              </button>
            </div>
          ) : null}
        </div>
      </div>
    </header>
  );
}
