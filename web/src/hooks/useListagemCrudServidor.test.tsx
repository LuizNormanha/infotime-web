/**
 * @vitest-environment jsdom
 */
import { renderHook, waitFor } from "@testing-library/react";
import { afterEach, describe, expect, it, vi } from "vitest";

import { useListagemCrudServidor, normalizarRespostaListagemJson } from "./useListagemCrudServidor";

describe("useListagemCrudServidor", () => {
  afterEach(() => {
    vi.restoreAllMocks();
    vi.unstubAllGlobals();
  });

  it("normaliza total em string e total ausente com dados na página", () => {
    expect(
      normalizarRespostaListagemJson({ dados: [{ a: 1 }], total: "7" }),
    ).toEqual({ dados: [{ a: 1 }], total: 7 });
    expect(normalizarRespostaListagemJson({ dados: [{ a: 1 }, { b: 2 }] })).toEqual({
      dados: [{ a: 1 }, { b: 2 }],
      total: 2,
    });
  });

  it("carrega listagem no servidor com query padrão (cargaInicial, pagina, tamanhoPagina)", async () => {
    const fetchMock = vi.fn().mockResolvedValue(
      new Response(JSON.stringify({ dados: [{ id: "1" }], total: 1 }), {
        status: 200,
      }),
    );
    vi.stubGlobal("fetch", fetchMock);

    const { result } = renderHook(() =>
      useListagemCrudServidor({
        resourcePath: "/api/foo",
        campoPesquisaInicial: "nome",
      }),
    );

    await waitFor(() => {
      expect(result.current.carregando).toBe(false);
    });

    expect(fetchMock).toHaveBeenCalled();
    const url = String(fetchMock.mock.calls[0][0]);
    expect(url).toContain("/api/foo?");
    expect(url).toContain("cargaInicial=primeiraPagina");
    expect(url).toContain("pagina=0");
    expect(url).toContain("tamanhoPagina=10");
    expect(result.current.registros).toEqual([{ id: "1" }]);
    expect(result.current.servidor?.fonteListagem).toBe("servidor");
  });

  it("carrega listagem quando total vem como string numérica", async () => {
    const fetchMock = vi.fn().mockResolvedValue(
      new Response(JSON.stringify({ dados: [{ id: "1" }, { id: "2" }], total: "2" }), {
        status: 200,
      }),
    );
    vi.stubGlobal("fetch", fetchMock);

    const { result } = renderHook(() =>
      useListagemCrudServidor({
        resourcePath: "/api/foo",
        campoPesquisaInicial: "nome",
      }),
    );

    await waitFor(() => {
      expect(result.current.carregando).toBe(false);
    });

    expect(result.current.registros).toHaveLength(2);
    expect(result.current.servidor?.paginacaoServidor.totalRegistros).toBe(2);
  });

  it("em modo seleção usa todos=1", async () => {
    const fetchMock = vi.fn().mockResolvedValue(
      new Response(JSON.stringify({ dados: [], total: 0 }), { status: 200 }),
    );
    vi.stubGlobal("fetch", fetchMock);

    const { result } = renderHook(() =>
      useListagemCrudServidor({
        resourcePath: "/api/foo",
        campoPesquisaInicial: "nome",
        modoSelecao: true,
      }),
    );

    await waitFor(() => {
      expect(result.current.carregando).toBe(false);
    });

    const url = String(fetchMock.mock.calls[0][0]);
    expect(url).toContain("todos=1");
    expect(result.current.servidor).toBeUndefined();
  });
});
