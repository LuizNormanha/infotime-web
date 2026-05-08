"use client";

import { useCallback, useMemo, useRef, useState } from "react";
import { useTranslations } from "next-intl";
import "./liga-menu-cascata.css";
import "./liga-menu-drawer.css";

import { LigaLogoMarca } from "../../imagem/LigaLogoMarca";
import { LigaMenuItem } from "./LigaMenuItem";
import { normalizarMenu } from "./liga-menu-arvore";
import { iconeMenuItem } from "./liga-menu-icones";
import { rotuloItemMenu } from "./liga-menu-rotulo";
import { LigaMenuListaCascata } from "./LigaMenuListaCascata";
import { LigaMenuPesquisa } from "./LigaMenuPesquisa";
import type { LigaMenuEstruturaIds, LigaMenuId } from "./liga-menu-tipos";

export type { LigaMenuEntrada, LigaMenuEstruturaIds, LigaMenuId } from "./liga-menu-tipos";
export { ICONE_MENU_ITEM, iconeMenuItem } from "./liga-menu-icones";

type LigaMenuDrawerProps = {
  menuIds: LigaMenuEstruturaIds;
  modoDrawer: boolean;
  mobileAberto: boolean;
  emailUsuario: string | null;
  aoFecharMobile: () => void;
  aoSelecionarItem: (menuId: string) => void;
  aoSair: () => void;
};

export function LigaMenuDrawer({
  menuIds,
  modoDrawer,
  mobileAberto,
  emailUsuario,
  aoFecharMobile,
  aoSelecionarItem,
  aoSair,
}: LigaMenuDrawerProps) {
  const t = useTranslations("home");
  const rotuloItem = useCallback(
    (id: LigaMenuId) => rotuloItemMenu(id, (chave) => t(chave)),
    [t],
  );
  const [raizesExpandidas, setRaizesExpandidas] = useState<Set<LigaMenuId>>(
    () => new Set(),
  );
  const refAside = useRef<HTMLElement>(null);

  const arvoreMenu = useMemo(() => normalizarMenu(menuIds), [menuIds]);

  const classesAside = [
    "liga-home-sidebar",
    modoDrawer ? "modo-drawer" : "",
    mobileAberto ? "mobile-aberta" : "",
  ]
    .filter(Boolean)
    .join(" ");

  function alternarRaiz(id: LigaMenuId) {
    setRaizesExpandidas((prev) => {
      const n = new Set(prev);
      if (n.has(id)) n.delete(id);
      else n.add(id);
      return n;
    });
  }

  return (
    <aside ref={refAside} className={classesAside}>
      <div className="liga-home-sidebar-topo">
        <LigaLogoMarca />
      </div>

      <LigaMenuPesquisa
        variant="drawer"
        menuIds={menuIds}
        aoSelecionarItem={aoSelecionarItem}
      />

      <nav className="liga-home-menu" aria-label={t("menu.aria")}>
        {arvoreMenu.map((no) => {
          const possuiFilhos = no.filhos.length > 0;
          const raizAberta = raizesExpandidas.has(no.id);

          return (
            <div key={no.id} className="liga-home-menu-bloco">
              <LigaMenuItem
                id={no.id}
                rotulo={rotuloItem(no.id)}
                icone={iconeMenuItem(no.id)}
                possuiFilhos={possuiFilhos}
                aberto={raizAberta}
                aoClicar={() => {
                  if (possuiFilhos) {
                    alternarRaiz(no.id);
                    return;
                  }
                  aoSelecionarItem(no.id);
                }}
              />
              {possuiFilhos && raizAberta ? (
                <div className="liga-home-menu-sub-arvore">
                  <LigaMenuListaCascata
                    variant="inline"
                    filhos={no.filhos}
                    rotuloItem={rotuloItem}
                    aoClicarFolha={(id) => {
                      aoSelecionarItem(id);
                    }}
                  />
                </div>
              ) : null}
            </div>
          );
        })}
      </nav>

      <button
        type="button"
        className="liga-home-botao-fechar-mobile"
        onClick={aoFecharMobile}
        aria-label={t("topbar.fecharMenu")}
      >
        <i className="pi pi-times" aria-hidden="true" />
      </button>

      <div className="liga-menu-rodape">
        <div className="liga-menu-rodape-usuario">
          <span className="liga-menu-rodape-avatar">
            <i className="pi pi-user" aria-hidden="true" />
          </span>
          <span className="liga-menu-rodape-email" title={emailUsuario ?? ""}>
            {emailUsuario ?? ""}
          </span>
        </div>
        <button
          type="button"
          className="liga-menu-rodape-sair"
          onClick={aoSair}
          title={t("topbar.sair")}
          aria-label={t("topbar.sair")}
        >
          <i className="pi pi-sign-out" aria-hidden="true" />
          <span>{t("topbar.sair")}</span>
        </button>
      </div>
    </aside>
  );
}
