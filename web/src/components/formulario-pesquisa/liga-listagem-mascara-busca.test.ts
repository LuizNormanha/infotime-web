import { describe, expect, it } from "vitest";

import type { LigaColunaListagem } from "./liga-listagem.types";
import {
  cpfDigitosVerificadoresValidos,
  cnpjDigitosVerificadoresValidos,
  validarTermoBuscaMascara,
} from "./liga-listagem-mascara-busca";

describe("cpfDigitosVerificadoresValidos", () => {
  it("aceita CPF com dígitos verificadores corretos", () => {
    expect(cpfDigitosVerificadoresValidos("39053344705")).toBe(true);
  });
  it("rejeita sequência repetida", () => {
    expect(cpfDigitosVerificadoresValidos("11111111111")).toBe(false);
  });
  it("rejeita último dígito incorreto", () => {
    expect(cpfDigitosVerificadoresValidos("39053344706")).toBe(false);
  });
});

describe("cnpjDigitosVerificadoresValidos", () => {
  it("aceita CNPJ válido", () => {
    expect(cnpjDigitosVerificadoresValidos("11222333000181")).toBe(true);
  });
  it("rejeita último dígito incorreto", () => {
    expect(cnpjDigitosVerificadoresValidos("11222333000182")).toBe(false);
  });
});

describe("validarTermoBuscaMascara", () => {
  const colCpf: LigaColunaListagem = {
    campo: "cpf",
    cabecalho: "CPF",
    campoConsulta: "cpf",
  };

  it("permite busca parcial em CPF", () => {
    expect(validarTermoBuscaMascara(colCpf, "390").ok).toBe(true);
  });

  it("permite CPF com 11 dígitos mesmo quando DV seria inválido (busca legado)", () => {
    const r = validarTermoBuscaMascara(colCpf, "390.533.447-06");
    expect(r.ok).toBe(true);
  });

  it("rejeita mais de 11 dígitos numéricos em CPF", () => {
    const r = validarTermoBuscaMascara(colCpf, "390533447061");
    expect(r.ok).toBe(false);
  });

  const colData: LigaColunaListagem = {
    campo: "data_nascimento",
    cabecalho: "Nascimento",
    formatoDataListagem: "data",
  };

  it("exige data completa para campo data", () => {
    const r = validarTermoBuscaMascara(colData, "12/05/");
    expect(r.ok).toBe(false);
  });

  it("rejeita data inexistente no calendário", () => {
    const r = validarTermoBuscaMascara(colData, "31/02/2020");
    expect(r.ok).toBe(false);
  });

  it("aceita data válida", () => {
    expect(validarTermoBuscaMascara(colData, "15/03/1990").ok).toBe(true);
  });
});
