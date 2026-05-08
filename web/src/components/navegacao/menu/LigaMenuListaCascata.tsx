"use client";

import "./liga-menu-cascata.css";

import { useCallback, useEffect, useLayoutEffect, useRef, useState } from "react";

import { iconeMenuItem } from "./liga-menu-icones";
import type { LigaNoMenu } from "./liga-menu-arvore";
import type { LigaMenuId } from "./liga-menu-tipos";

export type LigaMenuListaCascataVariant = "flyout" | "inline";

export type LigaMenuListaCascataProps = {
  filhos: LigaNoMenu[];
  profundidade?: number;
  rotuloItem: (id: LigaMenuId) => string;
  aoClicarFolha: (id: LigaMenuId) => void;
  /** flyout: submenus à direita (barra superior), abertos por clique. inline: acordeão no drawer / mobile */
  variant?: LigaMenuListaCascataVariant;
  /** Incrementado ao rolar o painel do menu no topo: fecha submenus flyout abertos neste nível. */
  scrollEpoch?: number;
};

function aplicarPosicaoSubmenuFlyout(
  btn: HTMLElement,
  sub: HTMLElement,
  profundidade: number,
) {
  const r = btn.getBoundingClientRect();
  const margin = 8;
  let left = r.right - 2;
  let top = r.top;

  sub.style.visibility = "hidden";
  sub.style.left = `${left}px`;
  sub.style.top = `${top}px`;

  const sw = sub.offsetWidth;
  const sh = sub.offsetHeight;
  const vw = window.innerWidth;
  const vh = window.innerHeight;

  if (left + sw > vw - margin) {
    left = Math.max(margin, r.left - sw - 2);
  }
  if (top + sh > vh - margin) {
    top = Math.max(margin, vh - margin - sh);
  }
  if (top < margin) top = margin;

  sub.style.left = `${left}px`;
  sub.style.top = `${top}px`;
  sub.style.visibility = "";
  sub.style.zIndex = String(102 + Math.min(profundidade, 40));
}

type CascataLinhaPaiInlineProps = {
  filho: LigaNoMenu;
  profundidade: number;
  rotuloItem: (id: LigaMenuId) => string;
  aoClicarFolha: (id: LigaMenuId) => void;
};

function CascataLinhaPaiInline({
  filho,
  profundidade,
  rotuloItem,
  aoClicarFolha,
}: CascataLinhaPaiInlineProps) {
  const [subAberto, setSubAberto] = useState(false);

  return (
    <li
      className="liga-menu-cascata-item liga-menu-cascata-item--pai liga-menu-cascata-item--inline-pai"
      role="none"
    >
      <button
        type="button"
        className="liga-menu-cascata-linha liga-menu-cascata-linha--inline"
        aria-expanded={subAberto}
        onClick={() => setSubAberto((v) => !v)}
      >
        <i className={`pi ${iconeMenuItem(filho.id)}`} aria-hidden />
        <span>{rotuloItem(filho.id)}</span>
        <i
          className={`pi ${subAberto ? "pi-chevron-up" : "pi-chevron-down"} liga-menu-cascata-chevron-inline`}
          aria-hidden
        />
      </button>
      {subAberto ? (
        <div className="liga-menu-cascata-sub liga-menu-cascata-sub--inline" role="group">
          <LigaMenuListaCascata
            filhos={filho.filhos}
            profundidade={profundidade + 1}
            rotuloItem={rotuloItem}
            aoClicarFolha={aoClicarFolha}
            variant="inline"
          />
        </div>
      ) : null}
    </li>
  );
}

type CascataLinhaPaiFlyoutProps = {
  filho: LigaNoMenu;
  profundidade: number;
  rotuloItem: (id: LigaMenuId) => string;
  aoClicarFolha: (id: LigaMenuId) => void;
  scrollEpoch?: number;
  aberto: boolean;
  aoAlternar: () => void;
};

function CascataLinhaPaiFlyout({
  filho,
  profundidade,
  rotuloItem,
  aoClicarFolha,
  scrollEpoch,
  aberto,
  aoAlternar,
}: CascataLinhaPaiFlyoutProps) {
  const refBtn = useRef<HTMLButtonElement>(null);
  const refSub = useRef<HTMLDivElement>(null);

  const reposicionar = useCallback(() => {
    const btn = refBtn.current;
    const sub = refSub.current;
    if (!btn || !sub) return;
    aplicarPosicaoSubmenuFlyout(btn, sub, profundidade);
  }, [profundidade]);

  useLayoutEffect(() => {
    if (!aberto) return;
    reposicionar();
  }, [aberto, reposicionar]);

  useEffect(() => {
    if (!aberto) return;
    const onResize = () => reposicionar();
    window.addEventListener("resize", onResize);
    return () => window.removeEventListener("resize", onResize);
  }, [aberto, reposicionar]);

  return (
    <li
      className={`liga-menu-cascata-item liga-menu-cascata-item--pai ${aberto ? "liga-menu-cascata-item--pai--flyout-aberto" : ""}`}
      role="none"
    >
      <button
        ref={refBtn}
        type="button"
        className="liga-menu-cascata-linha"
        role="menuitem"
        aria-haspopup="true"
        aria-expanded={aberto}
        tabIndex={0}
        onClick={(ev) => {
          ev.preventDefault();
          ev.stopPropagation();
          aoAlternar();
        }}
      >
        <i className={`pi ${iconeMenuItem(filho.id)}`} aria-hidden />
        <span>{rotuloItem(filho.id)}</span>
        <i
          className={`pi ${aberto ? "pi-angle-down" : "pi-angle-right"} liga-menu-cascata-seta`}
          aria-hidden
        />
      </button>
      {aberto ? (
        <div
          ref={refSub}
          className="liga-menu-cascata-sub liga-menu-cascata-sub--flyout-fixed"
          role="menu"
        >
          <LigaMenuListaCascata
            filhos={filho.filhos}
            profundidade={profundidade + 1}
            rotuloItem={rotuloItem}
            aoClicarFolha={aoClicarFolha}
            variant="flyout"
            scrollEpoch={scrollEpoch}
          />
        </div>
      ) : null}
    </li>
  );
}

export function LigaMenuListaCascata({
  filhos,
  profundidade = 0,
  rotuloItem,
  aoClicarFolha,
  variant = "flyout",
  scrollEpoch,
}: LigaMenuListaCascataProps) {
  const entradas = filhos;
  const [submenuAbertoId, setSubmenuAbertoId] = useState<string | null>(null);

  useEffect(() => {
    if (scrollEpoch === undefined) return;
    setSubmenuAbertoId(null);
  }, [scrollEpoch]);

  if (variant === "inline") {
    return (
      <ul
        className={`liga-menu-cascata-lista liga-menu-cascata-lista--inline liga-menu-cascata-lista--nivel-${profundidade}`}
        role="list"
      >
        {entradas.map((filho) => {
          const comFilhos = filho.filhos.length > 0;

          if (comFilhos) {
            return (
              <CascataLinhaPaiInline
                key={filho.id}
                filho={filho}
                profundidade={profundidade}
                rotuloItem={rotuloItem}
                aoClicarFolha={aoClicarFolha}
              />
            );
          }

          return (
            <li key={filho.id} className="liga-menu-cascata-item" role="none">
              <button
                type="button"
                className="liga-menu-cascata-linha liga-menu-cascata-linha--inline"
                onClick={() => aoClicarFolha(filho.id)}
              >
                <i className={`pi ${iconeMenuItem(filho.id)}`} aria-hidden />
                <span>{rotuloItem(filho.id)}</span>
              </button>
            </li>
          );
        })}
      </ul>
    );
  }

  return (
    <ul
      className={`liga-menu-cascata-lista liga-menu-cascata-lista--nivel-${profundidade}`}
      role="menu"
    >
      {entradas.map((filho) => {
        const comFilhos = filho.filhos.length > 0;

        if (comFilhos) {
          return (
            <CascataLinhaPaiFlyout
              key={filho.id}
              filho={filho}
              profundidade={profundidade}
              rotuloItem={rotuloItem}
              aoClicarFolha={aoClicarFolha}
              scrollEpoch={scrollEpoch}
              aberto={submenuAbertoId === filho.id}
              aoAlternar={() =>
                setSubmenuAbertoId((cur) => (cur === filho.id ? null : filho.id))
              }
            />
          );
        }

        return (
          <li key={filho.id} className="liga-menu-cascata-item" role="none">
            <button
              type="button"
              className="liga-menu-cascata-linha"
              role="menuitem"
              onClick={() => aoClicarFolha(filho.id)}
            >
              <i className={`pi ${iconeMenuItem(filho.id)}`} aria-hidden />
              <span>{rotuloItem(filho.id)}</span>
            </button>
          </li>
        );
      })}
    </ul>
  );
}
