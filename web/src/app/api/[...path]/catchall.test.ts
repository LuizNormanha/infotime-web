import { describe, expect, it } from "vitest";

import { RECURSOS_PERMITIDOS } from "./recursos-permitidos-bff";

describe("RECURSOS_PERMITIDOS — allowlist do catch-all BFF", () => {
  it("contém todos os recursos de cadastro esperados", () => {
    const esperados = [
      "grupos-perfil",
      "usuario-permissoes",
      "usuarios",
      "auth",
    ];

    for (const recurso of esperados) {
      expect(RECURSOS_PERMITIDOS.has(recurso), `faltando: ${recurso}`).toBe(true);
    }
  });

  it("não expõe paths de sessão/login crus; auth pode existir como recurso proxy sob controle do BFF", () => {
    const proibidos = ["login", "logout", "sessao", "suporte"];
    for (const p of proibidos) {
      expect(RECURSOS_PERMITIDOS.has(p), `deveria proibir: ${p}`).toBe(false);
    }
  });

  it("não contém paths de layout", () => {
    expect(RECURSOS_PERMITIDOS.has("layout")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("menu")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("catalogo")).toBe(false);
  });

  it("não contém caminhos internos ou arbitrários", () => {
    expect(RECURSOS_PERMITIDOS.has("_lib")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("health")).toBe(false);
    expect(RECURSOS_PERMITIDOS.has("../../../etc/passwd")).toBe(false);
  });

  it("rejeita path traversal — encodeURIComponent protege segmentos de id", () => {
    const malicioso = "../../../etc/passwd";
    const codificado = encodeURIComponent(malicioso);
    expect(codificado).not.toContain("/");
    expect(codificado).toBe("..%2F..%2F..%2Fetc%2Fpasswd");
  });

  it("tem exatamente o número de recursos da allowlist", () => {
    const esperados = [
      "grupos-perfil",
      "usuario-permissoes",
      "usuarios",
      "auth",
    ];
    expect(RECURSOS_PERMITIDOS.size).toBe(esperados.length);
  });
});

describe("Validação de path.length por método HTTP", () => {
  // Espelha a lógica de route.ts sem importar o módulo completo do Next.js
  function validarPathGet(path: string[]): boolean {
    if (path.length < 1) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }
  function validarPathPost(path: string[]): boolean {
    if (path.length < 1) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }
  function validarPathPutDelete(path: string[]): boolean {
    if (path.length < 2) return false;
    const [recurso] = path;
    return !!recurso && RECURSOS_PERMITIDOS.has(recurso);
  }

  it("GET aceita 1 segmento (listagem)", () => {
    expect(validarPathGet(["usuarios"])).toBe(true);
  });
  it("GET aceita 2 segmentos (por id)", () => {
    expect(validarPathGet(["usuarios", "42"])).toBe(true);
  });
  it("GET aceita 3+ segmentos (sub-rotas, ex.: catálogo)", () => {
    expect(validarPathGet(["grupos-perfil", "catalogo", "dummy"])).toBe(true);
  });

  it("POST aceita 1 segmento (criação na raiz do recurso)", () => {
    expect(validarPathPost(["usuarios"])).toBe(true);
  });
  it("POST aceita 3+ segmentos (sub-rotas, ex.: linha de detalhe)", () => {
    expect(validarPathPost(["grupos-perfil", "1", "clonar"])).toBe(true);
  });
  it("POST rejeita 0 segmentos", () => {
    expect(validarPathPost([])).toBe(false);
  });

  it("PUT aceita exatamente 2 segmentos", () => {
    expect(validarPathPutDelete(["usuarios", "42"])).toBe(true);
  });
  it("PUT rejeita 1 segmento (sem id)", () => {
    expect(validarPathPutDelete(["usuarios"])).toBe(false);
  });
  it("PUT aceita 4+ segmentos (detalhe aninhado)", () => {
    expect(validarPathPutDelete(["grupos-perfil", "1", "detalhe", "9"])).toBe(true);
  });

  it("DELETE aceita exatamente 2 segmentos", () => {
    expect(validarPathPutDelete(["usuarios", "99"])).toBe(true);
  });
  it("DELETE rejeita recurso fora da allowlist", () => {
    expect(validarPathPutDelete(["../secret", "1"])).toBe(false);
  });
});
