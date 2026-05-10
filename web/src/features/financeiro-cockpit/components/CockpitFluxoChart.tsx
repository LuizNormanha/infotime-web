"use client";

import type { CockpitFluxoDia } from "../types";

function rotuloDia(iso: string): string {
  const [y, m, d] = iso.split("-").map((x) => parseInt(x, 10));
  if (!y || !m || !d) return iso;
  const dt = new Date(y, m - 1, d);
  return new Intl.DateTimeFormat("pt-BR", { day: "2-digit", month: "2-digit" }).format(dt);
}

export function CockpitFluxoChart({ dados }: { dados: CockpitFluxoDia[] }) {
  const max = Math.max(1, ...dados.flatMap((d) => [d.entradas, d.saidas]));

  return (
    <div
      style={{
        display: "flex",
        alignItems: "flex-end",
        gap: 6,
        height: 180,
        paddingTop: 8,
      }}
      role="img"
      aria-label="Fluxo previsto 14 dias"
    >
      {dados.map((d) => {
        const hEnt = (d.entradas / max) * 120;
        const hSai = (d.saidas / max) * 120;
        return (
          <div
            key={d.data}
            style={{
              flex: 1,
              minWidth: 0,
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
              height: "100%",
            }}
          >
            <div
              title={`${rotuloDia(d.data)} — entradas / saídas`}
              style={{
                flex: 1,
                width: "100%",
                display: "flex",
                flexDirection: "column",
                justifyContent: "flex-end",
                alignItems: "center",
                gap: 1,
              }}
            >
              <div
                style={{
                  width: "78%",
                  height: Math.max(2, hEnt),
                  background: "#22c55e",
                  borderRadius: "3px 3px 0 0",
                }}
              />
              <div
                style={{
                  width: "78%",
                  height: Math.max(2, hSai),
                  background: "#ef4444",
                  borderRadius: "0 0 3px 3px",
                }}
              />
            </div>
            <span
              style={{
                fontSize: 10,
                color: "var(--liga-texto-secundario)",
                marginTop: 4,
              }}
            >
              {rotuloDia(d.data)}
            </span>
          </div>
        );
      })}
    </div>
  );
}
