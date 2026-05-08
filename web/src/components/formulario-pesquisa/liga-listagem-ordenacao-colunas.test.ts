import { describe, expect, it } from "vitest";

import { ordenarColunasListagemCrud } from "./liga-listagem-ordenacao-colunas";
import type { LigaColunaListagem } from "./liga-listagem.types";

describe("ordenarColunasListagemCrud", () => {
  it("move a coluna do campo chavePrimaria para o final", () => {
    const colunas: LigaColunaListagem[] = [
      { campo: "id", cabecalho: "Id" },
      { campo: "nome", cabecalho: "Nome" },
    ];
    const r = ordenarColunasListagemCrud(colunas, "id");
    expect(r.map((c) => c.campo)).toEqual(["nome", "id"]);
  });

  it("colunas colunaChavePrimaria vão ao final após as demais", () => {
    const colunas: LigaColunaListagem[] = [
      { campo: "id", cabecalho: "Id" },
      { campo: "nome", cabecalho: "Nome" },
      { campo: "id_seq", cabecalho: "Seq", colunaChavePrimaria: true },
    ];
    const r = ordenarColunasListagemCrud(colunas, "id");
    expect(r.map((c) => c.campo)).toEqual(["nome", "id", "id_seq"]);
  });
});
