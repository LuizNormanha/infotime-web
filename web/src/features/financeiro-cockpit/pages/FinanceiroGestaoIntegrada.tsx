"use client";

import { useRouter } from "next/navigation";
import { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Dropdown } from "primereact/dropdown";
import { useCallback, useMemo, useState } from "react";

import { usePermissaoPerfilTelaAtiva } from "@/hooks/usePermissaoPerfilTelaAtiva";
import { solicitarAbrirPainelFinanceiro } from "@/lib/navegacao/financeiro-abas-home";

import { useCockpit } from "../api/useCockpit";
import "../liga-cockpit.css";
import { CockpitDistribuicao } from "../components/CockpitDistribuicao";
import { CockpitFluxoChart } from "../components/CockpitFluxoChart";
import { CockpitKpiCard } from "../components/CockpitKpiCard";
import { CockpitMiniLista } from "../components/CockpitMiniLista";

export type ModoNavegacaoFinanceiroCockpit = "abas" | "rotas";

export type FinanceiroGestaoIntegradaProps = {
  /** `abas` = home (abre Contas a pagar/receber como abas); `rotas` = `/financeiro` no router. */
  modoNavegacao?: ModoNavegacaoFinanceiroCockpit;
};

export function FinanceiroGestaoIntegrada({
  modoNavegacao = "rotas",
}: FinanceiroGestaoIntegradaProps) {
  const t = useTranslations("home.financeiroGestaoIntegrada");
  const router = useRouter();
  const { data, isLoading, isError, refetch } = useCockpit();
  const permRec = usePermissaoPerfilTelaAtiva("contas-receber");
  const permPag = usePermissaoPerfilTelaAtiva("contas-pagar");

  const [periodo, setPeriodo] = useState("mes");
  const opcoesPeriodo = useMemo(
    () => [
      { label: t("periodoMes"), value: "mes" },
      { label: t("periodo30"), value: "30" },
      { label: t("periodoTrimestre"), value: "trim" },
    ],
    [t],
  );

  const mesAnoAtual = useMemo(
    () =>
      new Intl.DateTimeFormat("pt-BR", { month: "long", year: "numeric" }).format(new Date()),
    [],
  );

  const emAbas = modoNavegacao === "abas";

  const irReceber = useCallback(
    (rotas: () => void, abas: () => void) => {
      if (emAbas) abas();
      else rotas();
    },
    [emAbas],
  );

  const irPagar = useCallback(
    (rotas: () => void, abas: () => void) => {
      if (emAbas) abas();
      else rotas();
    },
    [emAbas],
  );

  if (isError) {
    return (
      <div style={{ padding: "1rem 0" }}>
        <p style={{ color: "#f87171" }}>{t("erroCarregar")}</p>
        <Button type="button" label={t("tentarNovamente")} onClick={() => void refetch()} />
      </div>
    );
  }

  const d = data;

  return (
    <div>
      <div
        style={{
          display: "flex",
          alignItems: "center",
          justifyContent: "space-between",
          flexWrap: "wrap",
          gap: 12,
          marginBottom: 20,
        }}
      >
        <div>
          <h1 style={{ margin: 0, fontSize: "1.35rem" }}>{t("titulo")}</h1>
          <p style={{ margin: "6px 0 0", color: "var(--liga-texto-secundario)" }}>
            {t("subtituloPrefixo")} · {mesAnoAtual}
          </p>
        </div>
        <div style={{ display: "flex", flexWrap: "wrap", gap: 8, alignItems: "center" }}>
          <div style={{ minWidth: 200 }}>
            <label htmlFor="cockpit-periodo" style={{ display: "block", fontSize: 12, marginBottom: 4 }}>
              {t("periodoLabel")}
            </label>
            <Dropdown
              inputId="cockpit-periodo"
              value={periodo}
              options={opcoesPeriodo}
              onChange={(e) => setPeriodo(String(e.value))}
              optionLabel="label"
              optionValue="value"
            />
          </div>
          {permRec.permissoesCarregadas && permRec.permissoes.incluir ? (
            <Button
              type="button"
              label={t("novaReceita")}
              icon="pi pi-plus"
              onClick={() =>
                irReceber(
                  () => router.push("/financeiro/receber/novo"),
                  () => solicitarAbrirPainelFinanceiro("contas-receber", { abrir: "novo" }),
                )
              }
            />
          ) : null}
          {permPag.permissoesCarregadas && permPag.permissoes.incluir ? (
            <Button
              type="button"
              label={t("novaDespesa")}
              icon="pi pi-plus"
              outlined
              onClick={() =>
                irPagar(
                  () => router.push("/financeiro/pagar/novo"),
                  () => solicitarAbrirPainelFinanceiro("contas-pagar", { abrir: "novo" }),
                )
              }
            />
          ) : null}
        </div>
      </div>

      <div className="liga-cockpit-kpi-grid">
        <CockpitKpiCard
          label={t("kpiReceberHoje")}
          valor={d?.receberHoje.total ?? 0}
          qtd={d?.receberHoje.qtd ?? 0}
          variante="success"
          carregando={isLoading}
          onClick={() =>
            irReceber(
              () => router.push("/financeiro/receber?venceHoje=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-receber", {
                  abrir: "lista",
                  listagemExtra: { venceHoje: "true" },
                }),
            )
          }
        />
        <CockpitKpiCard
          label={t("kpiReceberAtraso")}
          valor={d?.receberAtraso.total ?? 0}
          qtd={d?.receberAtraso.qtd ?? 0}
          variante="danger"
          carregando={isLoading}
          onClick={() =>
            irReceber(
              () => router.push("/financeiro/receber?atrasado=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-receber", {
                  abrir: "lista",
                  listagemExtra: { atrasado: "true" },
                }),
            )
          }
        />
        <CockpitKpiCard
          label={t("kpiPagarHoje")}
          valor={d?.pagarHoje.total ?? 0}
          qtd={d?.pagarHoje.qtd ?? 0}
          variante="warning"
          carregando={isLoading}
          onClick={() =>
            irPagar(
              () => router.push("/financeiro/pagar?venceHoje=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-pagar", {
                  abrir: "lista",
                  listagemExtra: { venceHoje: "true" },
                }),
            )
          }
        />
        <CockpitKpiCard
          label={t("kpiPagarAtraso")}
          valor={d?.pagarAtraso.total ?? 0}
          qtd={d?.pagarAtraso.qtd ?? 0}
          variante="danger"
          carregando={isLoading}
          onClick={() =>
            irPagar(
              () => router.push("/financeiro/pagar?atrasado=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-pagar", {
                  abrir: "lista",
                  listagemExtra: { atrasado: "true" },
                }),
            )
          }
        />
        <CockpitKpiCard
          label={t("kpiSaldo30")}
          valor={d?.saldoPrevisto30d ?? 0}
          qtd={0}
          variante="info"
          carregando={isLoading}
          subtextoFixo={t("kpiSubSaldo")}
        />
      </div>

      <div className="liga-cockpit-duas-colunas">
        <Card title={t("fluxoTitulo")}>
          {isLoading || !d ? (
            <div className="liga-cockpit-kpi-skeleton" style={{ height: 180 }} aria-hidden />
          ) : (
            <CockpitFluxoChart dados={d.fluxo14dias} />
          )}
        </Card>
        <Card title={t("distribuicaoTitulo")}>
          {isLoading || !d ? (
            <div className="liga-cockpit-kpi-skeleton" style={{ height: 180 }} aria-hidden />
          ) : (
            <CockpitDistribuicao dados={d.distribuicao} />
          )}
        </Card>
      </div>

      <div className="liga-cockpit-duas-colunas" style={{ marginBottom: 0 }}>
        <CockpitMiniLista
          titulo={t("miniReceberHoje")}
          itens={d?.miniReceberHoje ?? []}
          variante="receber"
          tipo="hoje"
          totalQtd={d?.receberHoje.qtd ?? 0}
          onVerTodos={() =>
            irReceber(
              () => router.push("/financeiro/receber?venceHoje=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-receber", {
                  abrir: "lista",
                  listagemExtra: { venceHoje: "true" },
                }),
            )
          }
          onItemClick={(id) =>
            irReceber(
              () => router.push(`/financeiro/receber/${encodeURIComponent(id)}`),
              () =>
                solicitarAbrirPainelFinanceiro("contas-receber", {
                  abrir: "edicao",
                  idEdicao: id,
                }),
            )
          }
          carregando={isLoading}
        />
        <CockpitMiniLista
          titulo={t("miniReceberAtraso")}
          itens={d?.miniReceberAtraso ?? []}
          variante="receber"
          tipo="atraso"
          totalQtd={d?.receberAtraso.qtd ?? 0}
          onVerTodos={() =>
            irReceber(
              () => router.push("/financeiro/receber?atrasado=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-receber", {
                  abrir: "lista",
                  listagemExtra: { atrasado: "true" },
                }),
            )
          }
          onItemClick={(id) =>
            irReceber(
              () => router.push(`/financeiro/receber/${encodeURIComponent(id)}`),
              () =>
                solicitarAbrirPainelFinanceiro("contas-receber", {
                  abrir: "edicao",
                  idEdicao: id,
                }),
            )
          }
          carregando={isLoading}
        />
        <CockpitMiniLista
          titulo={t("miniPagarHoje")}
          itens={d?.miniPagarHoje ?? []}
          variante="pagar"
          tipo="hoje"
          totalQtd={d?.pagarHoje.qtd ?? 0}
          onVerTodos={() =>
            irPagar(
              () => router.push("/financeiro/pagar?venceHoje=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-pagar", {
                  abrir: "lista",
                  listagemExtra: { venceHoje: "true" },
                }),
            )
          }
          onItemClick={(id) =>
            irPagar(
              () => router.push(`/financeiro/pagar/${encodeURIComponent(id)}`),
              () =>
                solicitarAbrirPainelFinanceiro("contas-pagar", {
                  abrir: "edicao",
                  idEdicao: id,
                }),
            )
          }
          carregando={isLoading}
        />
        <CockpitMiniLista
          titulo={t("miniPagarAtraso")}
          itens={d?.miniPagarAtraso ?? []}
          variante="pagar"
          tipo="atraso"
          totalQtd={d?.pagarAtraso.qtd ?? 0}
          onVerTodos={() =>
            irPagar(
              () => router.push("/financeiro/pagar?atrasado=true"),
              () =>
                solicitarAbrirPainelFinanceiro("contas-pagar", {
                  abrir: "lista",
                  listagemExtra: { atrasado: "true" },
                }),
            )
          }
          onItemClick={(id) =>
            irPagar(
              () => router.push(`/financeiro/pagar/${encodeURIComponent(id)}`),
              () =>
                solicitarAbrirPainelFinanceiro("contas-pagar", {
                  abrir: "edicao",
                  idEdicao: id,
                }),
            )
          }
          carregando={isLoading}
        />
      </div>
    </div>
  );
}
