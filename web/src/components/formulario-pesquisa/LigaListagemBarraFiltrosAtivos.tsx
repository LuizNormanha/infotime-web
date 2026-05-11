"use client";

import type { Dispatch, SetStateAction } from "react";
import {
  useCallback,
  useEffect,
  useLayoutEffect,
  useRef,
  useState,
} from "react";
import type { useTranslations } from "next-intl";
import { Button } from "primereact/button";
import { Chip } from "primereact/chip";
import { OverlayPanel } from "primereact/overlaypanel";

import type { LigaColunaListagem, LigaFiltroRefinadoValor } from "./liga-listagem.types";
import { rotuloChipFiltroRefinado } from "./liga-listagem-filtro-refinado";

const GAP_APROX_PX = 7;
/** Largura mínima reservada ao botão de overflow (ícone pi-ellipsis-h). */
const ELLIPSIS_BTN_MIN_PX = 46;
/** Margens horizontais do botão (alinha ao CSS margin-inline ~0.28rem × 2). */
const ELLIPSIS_MARGEM_TOTAL_APROX_PX = 9;
/** Folga para mandar chips ao ⋯ antes do flex encolher o campo de busca (prioridade: ⋯ → depois input). */
const LARGURA_UTIL_RESERVA_PX = 36;
/** Se a faixa de chips (overflow:hidden + justify-end) tiver qualquer excesso de largura, reduz chips até caber — evita cortar o início do rótulo. */
const CHIPS_RUN_OVERFLOW_MIN_DELTA_PX = 1;
/** Limite para enumerar subconjuntos (2^n); acima disso usa apenas prefixo contíguo. */
const MAX_ENUM_FILTROS_PARA_SUBCONJUNTO = 18;
/** Folga extra no cálculo para alinhar ao layout real (flex/gaps) e evitar expandir de novo após clamp por overflow. */
const FOLGA_SUBCONJUNTO_PX = 24;

function indicesIniciaisTodos(n: number): number[] {
  return n <= 0 ? [] : Array.from({ length: n }, (_, i) => i);
}

function subsetWidthAndLimparIndices(
  indicesAsc: number[],
  n: number,
  chipWidths: number[],
  containerWidth: number,
  limparWidth: number,
  gapPx: number,
  ellipsisW: number,
): { fits: boolean; limparInline: boolean } {
  const k = indicesAsc.length;
  const hiddenCount = n - k;
  let chipsSum = 0;
  if (k > 0) {
    chipsSum =
      indicesAsc.reduce((s, i) => s + chipWidths[i], 0) +
      gapPx * Math.max(0, k - 1);
  }
  const ell = hiddenCount > 0 ? ellipsisW + gapPx : 0;

  let total = chipsSum + ell;
  let limparInline = false;
  if (total + gapPx + limparWidth <= containerWidth) {
    total += gapPx + limparWidth;
    limparInline = true;
  }
  return { fits: total <= containerWidth, limparInline };
}

/** Maximiza quantidade de chips na barra; empate: prefere esconder filtros mais largos (ex.: Nome longo), mantendo os curtos (CPF, Situação). */
function computeMelhorIndicesInline(
  containerWidth: number,
  chipWidths: number[],
  limparWidth: number,
  gapPx: number,
  ellipsisW: number,
): { indices: number[]; limparInline: boolean } {
  const cw = Math.max(0, containerWidth - FOLGA_SUBCONJUNTO_PX);
  const n = chipWidths.length;
  if (n === 0) {
    return {
      indices: [],
      limparInline: limparWidth <= cw,
    };
  }
  if (cw <= 8) {
    return { indices: [], limparInline: false };
  }
  if (n > MAX_ENUM_FILTROS_PARA_SUBCONJUNTO) {
    return computeIndicesPrefixoFallback(
      cw,
      chipWidths,
      limparWidth,
      gapPx,
      ellipsisW,
    );
  }

  const maxMask = 1 << n;
  let bestIndices: number[] = [];
  let bestPop = -1;
  let bestHiddenWidthSum = Infinity;
  let bestLimparInline = false;

  for (let mask = 0; mask < maxMask; mask++) {
    const indices: number[] = [];
    for (let i = 0; i < n; i++) {
      if (mask & (1 << i)) indices.push(i);
    }
    const r = subsetWidthAndLimparIndices(
      indices,
      n,
      chipWidths,
      cw,
      limparWidth,
      gapPx,
      ellipsisW,
    );
    if (!r.fits) continue;

    const pop = indices.length;
    let hiddenWidthSum = 0;
    for (let i = 0; i < n; i++) {
      if (!(mask & (1 << i))) hiddenWidthSum += chipWidths[i];
    }

    if (
      pop > bestPop ||
      (pop === bestPop && hiddenWidthSum < bestHiddenWidthSum)
    ) {
      bestIndices = indices;
      bestPop = pop;
      bestHiddenWidthSum = hiddenWidthSum;
      bestLimparInline = r.limparInline;
    }
  }

  return { indices: bestIndices, limparInline: bestLimparInline };
}

/** Apenas prefixo [0..v); fallback quando há muitos filtros (sem enumerar 2^n). */
function computeIndicesPrefixoFallback(
  containerWidthComFolga: number,
  chipWidths: number[],
  limparWidth: number,
  gapPx: number,
  ellipsisW: number,
): { indices: number[]; limparInline: boolean } {
  const n = chipWidths.length;
  for (let v = n; v >= 0; v--) {
    const indices =
      v === 0 ? [] : Array.from({ length: v }, (_, i) => i);
    const r = subsetWidthAndLimparIndices(
      indices,
      n,
      chipWidths,
      containerWidthComFolga,
      limparWidth,
      gapPx,
      ellipsisW,
    );
    if (r.fits) {
      return { indices, limparInline: r.limparInline };
    }
  }
  return { indices: [], limparInline: false };
}

type TListagem = ReturnType<typeof useTranslations<"home">>;

type Props = {
  colunas: LigaColunaListagem[];
  filtrosAtivosLista: [string, LigaFiltroRefinadoValor][];
  setFiltrosRefinado: Dispatch<
    SetStateAction<Record<string, LigaFiltroRefinadoValor | undefined>>
  >;
  t: TListagem;
};

export function LigaListagemBarraFiltrosAtivos({
  colunas,
  filtrosAtivosLista,
  setFiltrosRefinado,
  t,
}: Props) {
  const containerRef = useRef<HTMLDivElement | null>(null);
  const chipsRunRef = useRef<HTMLDivElement | null>(null);
  const medicaoRef = useRef<HTMLDivElement | null>(null);
  const ellipsisMedicaoRef = useRef<HTMLButtonElement | null>(null);
  const overlayRef = useRef<OverlayPanel | null>(null);
  /** Re-medir quando Prime Chip ainda não tinha largura (offsetWidth 0). */
  const medicaoRetryRef = useRef(0);
  /** Últimas larguras medidas por índice de `filtrosAtivosLista` (para clamp por overflow). */
  const chipWidthsMedicaoRef = useRef<number[]>([]);

  const nFiltros = filtrosAtivosLista.length;
  const [inlineIndices, setInlineIndices] = useState<number[]>(() =>
    indicesIniciaisTodos(nFiltros),
  );
  const [limparInline, setLimparInline] = useState(true);

  const recalcularRef = useRef<(() => void) | null>(null);
  const recalcular = useCallback(() => {
    const wrap = containerRef.current;
    const med = medicaoRef.current;
    if (!wrap || !med || filtrosAtivosLista.length === 0) {
      const n = filtrosAtivosLista.length;
      setInlineIndices(indicesIniciaisTodos(n));
      setLimparInline(true);
      return;
    }

    const cw = Math.max(0, wrap.clientWidth - LARGURA_UTIL_RESERVA_PX);
    const slots = med.querySelectorAll<HTMLElement>(
      "[data-liga-filtro-medicao-chip]",
    );
    const chipWidths: number[] = [];
    for (let i = 0; i < slots.length; i++) {
      chipWidths.push(slots[i].offsetWidth);
    }
    const limparEl = med.querySelector<HTMLElement>(
      "[data-liga-filtro-medicao-limpar]",
    );
    const limparW = limparEl?.offsetWidth ?? 0;
    const slotsOk = slots.length === filtrosAtivosLista.length;
    const temChipSemLargura =
      !slotsOk ||
      chipWidths.some((w) => w < 1) ||
      limparW < 1;

    if (temChipSemLargura) {
      if (medicaoRetryRef.current < 32) {
        medicaoRetryRef.current += 1;
        requestAnimationFrame(() => {
          recalcularRef.current?.();
        });
        return;
      }
      medicaoRetryRef.current = 0;
      setInlineIndices([]);
      setLimparInline(false);
      return;
    }
    medicaoRetryRef.current = 0;
    chipWidthsMedicaoRef.current = chipWidths.slice();

    const ellW =
      Math.max(
        ellipsisMedicaoRef.current?.offsetWidth ?? ELLIPSIS_BTN_MIN_PX,
        ELLIPSIS_BTN_MIN_PX,
      ) + ELLIPSIS_MARGEM_TOTAL_APROX_PX;

    const { indices: idx, limparInline: li } = computeMelhorIndicesInline(
      cw,
      chipWidths,
      limparW,
      GAP_APROX_PX,
      ellW,
    );

    setInlineIndices(idx);
    setLimparInline(li);
  }, [filtrosAtivosLista]);

  useLayoutEffect(() => {
    recalcularRef.current = recalcular;
  }, [recalcular]);

  useEffect(() => {
    medicaoRetryRef.current = 0;
  }, [filtrosAtivosLista]);

  useLayoutEffect(() => {
    recalcular();
  }, [recalcular]);

  useLayoutEffect(() => {
    const runEl = chipsRunRef.current;
    if (!runEl || filtrosAtivosLista.length === 0) return;
    const delta =
      runEl.scrollWidth - runEl.clientWidth;
    const chipsOverflow = delta > CHIPS_RUN_OVERFLOW_MIN_DELTA_PX;
    const inlineCount = inlineIndices.length;
    const reduzirChipVisivel = chipsOverflow && inlineCount > 0;
    if (reduzirChipVisivel) {
      setInlineIndices((prev) => {
        if (prev.length === 0) return prev;
        const widths = chipWidthsMedicaoRef.current;
        let worstIdx = prev[0];
        let worstW = widths[worstIdx] ?? 0;
        for (const i of prev) {
          const w = widths[i] ?? 0;
          if (w > worstW) {
            worstW = w;
            worstIdx = i;
          }
        }
        return prev.filter((i) => i !== worstIdx);
      });
    }
  }, [inlineIndices, filtrosAtivosLista.length]);

  useLayoutEffect(() => {
    const wrap = containerRef.current;
    const med = medicaoRef.current;
    if (!wrap || typeof ResizeObserver === "undefined") return;
    const ro = new ResizeObserver(() => recalcular());
    ro.observe(wrap);
    if (med) ro.observe(med);
    return () => ro.disconnect();
  }, [recalcular]);

  const inlineSet = new Set(inlineIndices);
  const hidden = filtrosAtivosLista.filter((_, i) => !inlineSet.has(i));
  /** Chips que não cabem OU Limpar inline indisponível — sempre precisamos do ⋯ nesse caso. */
  const precisaMenuOverflow = hidden.length > 0 || !limparInline;

  const removerCampo = (campo: string) => {
    setFiltrosRefinado((prev) => ({ ...prev, [campo]: undefined }));
    overlayRef.current?.hide();
  };

  const limparTodos = () => {
    setFiltrosRefinado({});
    overlayRef.current?.hide();
  };

  if (filtrosAtivosLista.length === 0) return null;

  return (
    <div className="liga-listagem-barra-grupo-filtros-ativos">
      <div ref={containerRef} className="liga-listagem-barra-filtros-inline">
        <div ref={medicaoRef} className="liga-listagem-filtros-medicao" aria-hidden>
          {filtrosAtivosLista.map(([campo, fv]) => {
            const col = colunas.find((c) => c.campo === campo);
            if (!col) return null;
            return (
              <span
                key={`m-${campo}`}
                data-liga-filtro-medicao-chip
                className="liga-listagem-filtro-medicao-slot"
              >
                <Chip
                  label={rotuloChipFiltroRefinado(col, fv)}
                  removable
                  onRemove={() => true}
                />
              </span>
            );
          })}
          <span data-liga-filtro-medicao-limpar className="liga-listagem-filtro-medicao-limpar">
            <Button
              type="button"
              outlined
              icon="pi pi-filter-slash"
              label={t("listagem.comum.limparFiltros")}
              className="p-button-sm liga-listagem-filtros-limpar-btn"
              tabIndex={-1}
            />
          </span>
          <button
            ref={ellipsisMedicaoRef}
            type="button"
            className="liga-listagem-filtros-ellipsis-medicao"
            tabIndex={-1}
            aria-hidden
          >
            <i className="pi pi-ellipsis-h" aria-hidden />
          </button>
        </div>

        <div
          className="liga-listagem-barra-filtros-visiveis"
          role="toolbar"
          aria-label={t("listagem.comum.filtrosAtivosAria")}
        >
          <div
            ref={chipsRunRef}
            className="liga-listagem-barra-filtros-chips-run"
          >
            {filtrosAtivosLista.map(([campo, fv], i) => {
              if (!inlineSet.has(i)) return null;
              const col = colunas.find((c) => c.campo === campo);
              if (!col) return null;
              return (
                <Chip
                  key={campo}
                  label={rotuloChipFiltroRefinado(col, fv)}
                  removable
                  onRemove={() => {
                    setFiltrosRefinado((prev) => ({
                      ...prev,
                      [campo]: undefined,
                    }));
                    return true;
                  }}
                />
              );
            })}
          </div>

          {precisaMenuOverflow ? (
            <>
              <Button
                type="button"
                icon="pi pi-ellipsis-h"
                className="liga-listagem-filtros-ellipsis p-button-text p-button-sm"
                aria-label={t("listagem.comum.filtrosAtivosOverflowAbrir")}
                aria-haspopup="dialog"
                onClick={(e) => overlayRef.current?.toggle(e)}
              />
              <OverlayPanel
                ref={overlayRef}
                className="liga-listagem-filtros-overflow-panel"
                dismissable
              >
                <div className="liga-listagem-filtros-overflow-conteudo">
                  {hidden.length > 0 ? (
                    <>
                      <p className="liga-listagem-filtros-overflow-titulo">
                        {t("listagem.comum.filtrosAtivosOverflowTitulo")}
                      </p>
                      <ul className="liga-listagem-filtros-overflow-lista">
                        {hidden.map(([campo, fv]) => {
                          const col = colunas.find((c) => c.campo === campo);
                          if (!col) return null;
                          return (
                            <li key={campo}>
                              <span className="liga-listagem-filtros-overflow-rotulo">
                                {rotuloChipFiltroRefinado(col, fv)}
                              </span>
                              <button
                                type="button"
                                className="liga-listagem-filtros-overflow-remover"
                                aria-label={t("listagem.comum.filtrosAtivosOverflowRemover")}
                                onClick={() => removerCampo(campo)}
                              >
                                <i className="pi pi-times" aria-hidden />
                              </button>
                            </li>
                          );
                        })}
                      </ul>
                    </>
                  ) : null}
                  {!limparInline ? (
                    <Button
                      type="button"
                      outlined
                      icon="pi pi-filter-slash"
                      label={t("listagem.comum.limparFiltros")}
                      className="p-button-sm liga-listagem-filtros-limpar-btn liga-listagem-filtros-overflow-limpar"
                      onClick={limparTodos}
                    />
                  ) : null}
                </div>
              </OverlayPanel>
            </>
          ) : null}

          {limparInline ? (
            <Button
              type="button"
              outlined
              icon="pi pi-filter-slash"
              label={t("listagem.comum.limparFiltros")}
              className="p-button-sm liga-listagem-filtros-limpar-btn"
              onClick={() => setFiltrosRefinado({})}
            />
          ) : null}
        </div>
      </div>
    </div>
  );
}
