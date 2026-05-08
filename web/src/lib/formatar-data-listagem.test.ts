import { describe, expect, it } from "vitest";

import {
  ehValorTipoDataListagem,
  formatarApenasDiaListagemPtBr,
  formatarDataHoraListagemPtBr,
} from "./formatar-data-listagem";

describe("formatar-data-listagem", () => {
  it("formata só dia YYYY-MM-DD como dd/MM/yyyy", () => {
    expect(formatarDataHoraListagemPtBr("2025-01-01")).toBe("01/01/2025");
    expect(formatarApenasDiaListagemPtBr("2025-12-31")).toBe("31/12/2025");
  });

  it("detecta tipo data em string ISO com T", () => {
    expect(ehValorTipoDataListagem("2025-01-01T10:34:00.000Z")).toBe(true);
  });

  it("ISO com hora vira dd/MM/yyyy HH:mm em fuso local (componentes fixos com mock de Date)", () => {
    const s = "2025-06-15T12:30:00.000Z";
    const out = formatarDataHoraListagemPtBr(s);
    expect(out).toMatch(/^\d{2}\/\d{2}\/2025 \d{2}:\d{2}$/);
    expect(out).not.toContain("T");
    expect(out).not.toContain("Z");
  });

  it("não trata número como data", () => {
    expect(ehValorTipoDataListagem(20250101)).toBe(false);
    expect(formatarDataHoraListagemPtBr(20250101)).toBe("20250101");
  });
});
