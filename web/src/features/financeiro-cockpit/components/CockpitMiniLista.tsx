"use client";

import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Tag } from "primereact/tag";

import "../liga-cockpit.css";

import type { CockpitMiniItem } from "../types";

const fmtBrl = new Intl.NumberFormat("pt-BR", { style: "currency", currency: "BRL" });

export type CockpitMiniListaProps = {
  titulo: string;
  itens: CockpitMiniItem[];
  variante: "receber" | "pagar";
  tipo: "hoje" | "atraso";
  totalQtd: number;
  onVerTodos: () => void;
  onItemClick: (id: string) => void;
  carregando?: boolean;
};

function SkeletonLinhas() {
  return (
    <>
      {[0, 1, 2].map((i) => (
        <div
          key={i}
          style={{
            height: 44,
            borderRadius: 6,
            marginBottom: 6,
            background: "var(--liga-fundo-pagina)",
            opacity: 0.85,
          }}
        />
      ))}
    </>
  );
}

export function CockpitMiniLista({
  titulo,
  itens,
  variante,
  tipo,
  totalQtd,
  onVerTodos,
  onItemClick,
  carregando,
}: CockpitMiniListaProps) {
  const t = useTranslations("home.financeiroGestaoIntegrada");
  const vazioMsg = tipo === "hoje" ? t("vazioListaHoje") : t("vazioListaAtraso");

  const textoDiasAtraso = (n: number) =>
    n === 1 ? t("umDiaAtraso") : t("variosDiasAtraso", { n });

  const badge = (item: CockpitMiniItem) => {
    if (tipo === "atraso" && item.diasAtraso != null) {
      return (
        <Tag
          severity="danger"
          value={textoDiasAtraso(item.diasAtraso)}
          style={{ marginTop: 4 }}
        />
      );
    }
    if (tipo === "hoje" && variante === "receber") {
      return (
        <Tag severity="success" value={t("badgeHoje")} style={{ marginTop: 4 }} />
      );
    }
    if (tipo === "hoje" && variante === "pagar") {
      return (
        <Tag severity="warning" value={t("badgeHoje")} style={{ marginTop: 4 }} />
      );
    }
    return null;
  };

  const sublinha = (item: CockpitMiniItem) => {
    if (tipo === "atraso" && item.diasAtraso != null) {
      return textoDiasAtraso(item.diasAtraso);
    }
    if (item.dataPrevisao) {
      return new Intl.DateTimeFormat("pt-BR", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(new Date(`${item.dataPrevisao}T12:00:00`));
    }
    return "";
  };

  return (
    <div className="liga-cockpit-mini-card">
      <div className="liga-cockpit-mini-header">
        <span className="liga-cockpit-mini-titulo">{titulo}</span>
        <Button
          type="button"
          size="small"
          outlined
          label={t("verTodos")}
          icon="pi pi-external-link"
          iconPos="right"
          onClick={onVerTodos}
        />
      </div>

      {carregando ? (
        <SkeletonLinhas />
      ) : itens.length === 0 ? (
        <div
          style={{
            textAlign: "center",
            padding: "1rem 0",
            color: "var(--liga-texto-secundario)",
          }}
        >
          <i className="pi pi-check-circle" style={{ fontSize: "1.5rem" }} aria-hidden />
          <p style={{ margin: "0.5rem 0 0" }}>{vazioMsg}</p>
        </div>
      ) : (
        itens.map((item) => (
          <div
            key={item.id}
            className="liga-cockpit-mini-linha"
            role="button"
            tabIndex={0}
            onClick={() => onItemClick(item.id)}
            onKeyDown={(ev) => {
              if (ev.key === "Enter" || ev.key === " ") {
                ev.preventDefault();
                onItemClick(item.id);
              }
            }}
          >
            <div className="liga-cockpit-mini-esq">
              <div className="liga-cockpit-mini-nome">{item.nomeAgente}</div>
              <div className="liga-cockpit-mini-meta">{sublinha(item)}</div>
            </div>
            <div className="liga-cockpit-mini-dir">
              <div
                className={
                  variante === "receber"
                    ? "liga-cockpit-mini-valor-receber"
                    : "liga-cockpit-mini-valor-pagar"
                }
              >
                {fmtBrl.format(item.valorPrevisao)}
              </div>
              {badge(item)}
            </div>
          </div>
        ))
      )}

      {!carregando && totalQtd > 5 ? (
        <div className="liga-cockpit-mini-footer">{t("maisLancamentos", { n: totalQtd - 5 })}</div>
      ) : null}
    </div>
  );
}
