"use client";

import { useLayoutEffect, useRef, type ReactNode } from "react";

/**
 * Iguala a largura dos `.liga-padrao-badge` descendentes à do maior (ex.: tipo + situação no título).
 */
export function LigaPadraoBadgeGrupoIgualLargura({
  children,
  className,
  deps,
}: {
  children: ReactNode;
  className?: string;
  /** Valores que, ao mudar, recalculam a largura (rótulos, ids, etc.). */
  deps: readonly unknown[];
}) {
  const ref = useRef<HTMLSpanElement>(null);
  const depKey = deps.map(String).join("\0");

  useLayoutEffect(() => {
    const root = ref.current;
    if (!root) return;

    const medirEaplicar = () => {
      const badges = root.querySelectorAll<HTMLElement>(".liga-padrao-badge");
      badges.forEach((b) => {
        b.style.minWidth = "";
      });
      let max = 0;
      badges.forEach((b) => {
        max = Math.max(max, b.getBoundingClientRect().width);
      });
      if (max <= 0) return;
      const px = `${Math.ceil(max)}px`;
      badges.forEach((b) => {
        b.style.minWidth = px;
      });
    };

    /** Dois frames: layout/fontes estáveis antes de medir. */
    const aplicar = () => {
      requestAnimationFrame(() => {
        requestAnimationFrame(medirEaplicar);
      });
    };

    const ro = new ResizeObserver(() => {
      aplicar();
    });
    ro.observe(root);
    aplicar();

    return () => {
      ro.disconnect();
      root.querySelectorAll<HTMLElement>(".liga-padrao-badge").forEach((b) => {
        b.style.minWidth = "";
      });
    };
  }, [depKey]);

  return (
    <span ref={ref} className={className}>
      {children}
    </span>
  );
}
