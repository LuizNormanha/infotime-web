"use client";

import "./liga-menu-pesquisa.css";

import { useCallback, useMemo, useState } from "react";
import { useTranslations } from "next-intl";
import {
  AutoComplete,
  type AutoCompleteCompleteEvent,
} from "primereact/autocomplete";

import {
  listarItensMenuPesquisaveis,
  normalizarTextoMenu,
  type LigaItemMenuPesquisavel,
} from "./liga-menu-itens-pesquisa";
import { rotuloItemMenu } from "./liga-menu-rotulo";
import type { LigaMenuEstruturaIds, LigaMenuId } from "./liga-menu-tipos";

const MAX_SUGESTOES = 30;

type LigaMenuPesquisaProps = {
  menuIds: LigaMenuEstruturaIds;
  aoSelecionarItem: (menuId: string) => void;
  /** Ex.: fechar painel suspenso da barra superior após escolher */
  aoFecharMenusRaiz?: () => void;
  variant: "topbar" | "drawer";
};

export function LigaMenuPesquisa({
  menuIds,
  aoSelecionarItem,
  aoFecharMenusRaiz,
  variant,
}: LigaMenuPesquisaProps) {
  const t = useTranslations("home.menuPesquisa");
  const th = useTranslations("home");

  const itensBase = useMemo(() => {
    return listarItensMenuPesquisaveis(menuIds, (id: LigaMenuId) =>
      rotuloItemMenu(id, (chave) => th(chave)),
    );
  }, [menuIds, th]);

  const [texto, setTexto] = useState("");
  const [sugestoes, setSugestoes] = useState<LigaItemMenuPesquisavel[]>([]);

  const filtrar = useCallback(
    (ev: AutoCompleteCompleteEvent) => {
      const q = normalizarTextoMenu(ev.query.trim());
      if (!q) {
        setSugestoes([]);
        return;
      }
      const filtrados = itensBase.filter((it) => it.termoNorm.includes(q));
      setSugestoes(filtrados.slice(0, MAX_SUGESTOES));
    },
    [itensBase],
  );

  const aoSelecionar = useCallback(
    (ev: { value: unknown }) => {
      const item = ev.value;
      if (!item || typeof item !== "object" || !("menuId" in item)) return;
      const mi = item as LigaItemMenuPesquisavel;
      aoSelecionarItem(mi.menuId);
      setTexto("");
      setSugestoes([]);
      aoFecharMenusRaiz?.();
    },
    [aoFecharMenusRaiz, aoSelecionarItem],
  );

  const wrapClass =
    variant === "topbar"
      ? "liga-menu-pesquisa liga-menu-pesquisa--topbar"
      : "liga-menu-pesquisa liga-menu-pesquisa--drawer";

  return (
    <div className={wrapClass}>
      <div className="liga-menu-pesquisa-inner">
        <AutoComplete
          value={texto}
          suggestions={sugestoes}
          completeMethod={filtrar}
          onChange={(e) => {
            const v = e.value;
            if (v != null && typeof v === "object" && "menuId" in v) return;
            setTexto(typeof v === "string" ? v : String(v ?? ""));
          }}
          onSelect={aoSelecionar}
          minLength={1}
          placeholder={t("placeholder")}
          aria-label={t("aria")}
          className="liga-menu-pesquisa-autocomplete w-full"
          inputClassName="liga-menu-pesquisa-input p-inputtext-sm"
          panelClassName="liga-menu-pesquisa-panel"
          itemTemplate={(item: LigaItemMenuPesquisavel) => (
            <div className="liga-menu-pesquisa-item">
              <span className="liga-menu-pesquisa-item-label">{item.label}</span>
              <span
                className="liga-menu-pesquisa-item-caminho"
                title={item.caminho}
              >
                {item.caminho}
              </span>
            </div>
          )}
        />
        <div className="liga-menu-pesquisa-sufixo">
          {texto ? (
            <button
              type="button"
              className="liga-menu-pesquisa-limpar"
              aria-label={t("limpar")}
              onClick={(e) => {
                e.preventDefault();
                e.stopPropagation();
                setTexto("");
                setSugestoes([]);
              }}
            >
              <i className="pi pi-times" aria-hidden />
            </button>
          ) : null}
          <span className="liga-menu-pesquisa-lupa" aria-hidden>
            <i className="pi pi-search" />
          </span>
        </div>
      </div>
    </div>
  );
}
