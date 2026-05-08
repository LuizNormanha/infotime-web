import { describe, expect, it } from "vitest";

import {
  montarSearchParamsListagemPadrao,
  serializarFiltrosRefinadoParaQuery,
} from "./listagem-servidor-query";

describe("serializarFiltrosRefinadoParaQuery", () => {
  it("retorna undefined quando não há filtros", () => {
    expect(serializarFiltrosRefinadoParaQuery({})).toBeUndefined();
  });

  it("serializa apenas entradas definidas", () => {
    const json = serializarFiltrosRefinadoParaQuery({
      nome: { tipo: "texto", contem: "x" },
      outro: undefined,
    });
    expect(json).toBe(JSON.stringify({ nome: { tipo: "texto", contem: "x" } }));
  });
});

describe("montarSearchParamsListagemPadrao", () => {
  it("define cargaInicial, pagina e tamanhoPagina", () => {
    const p = montarSearchParamsListagemPadrao({
      pagina: 1,
      tamanhoPagina: 20,
    });
    expect(p.get("cargaInicial")).toBe("primeiraPagina");
    expect(p.get("pagina")).toBe("1");
    expect(p.get("tamanhoPagina")).toBe("20");
  });

  it("inclui q e campoPesquisa quando há termo e campo", () => {
    const p = montarSearchParamsListagemPadrao({
      pagina: 0,
      tamanhoPagina: 10,
      termoBusca: "  ab ",
      campoPesquisa: "nome",
    });
    expect(p.get("q")).toBe("ab");
    expect(p.get("campoPesquisa")).toBe("nome");
  });

  it("omite q quando termo vazio", () => {
    const p = montarSearchParamsListagemPadrao({
      pagina: 0,
      tamanhoPagina: 10,
      termoBusca: "",
      campoPesquisa: "nome",
    });
    expect(p.has("q")).toBe(false);
  });

  it("anexa filtroRefinado quando JSON definido", () => {
    const p = montarSearchParamsListagemPadrao({
      pagina: 0,
      tamanhoPagina: 10,
      filtroRefinadoJson: '{"x":{"tipo":"texto","contem":"a"}}',
    });
    expect(p.get("filtroRefinado")).toBe('{"x":{"tipo":"texto","contem":"a"}}');
  });
});
